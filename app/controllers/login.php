<?php

use PHPMailer\PHPMailer\PHPMailer;

class Login extends Controller
{
    private $errorMessage = "";
    private $serverError = false;
    private $check = true;
    private $emailOrLoginInput = "";
    private $ifUserExist = "";
    private $passwordInput = "";
    private $userRole = "";
    private $userId = "";
    private $authhash = "";


    public function index(){
        header("Location:" . ROOT . "/login/validate");
    }

    public function set_new_password($hash = 0){
        unset($_SESSION['loggedUser']);
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);
        $siteName = $this->getSiteName($db);

        $this->errorMessage = "";
        $this->serverError = false;
        $this->check = true;
        $this->emailOrLoginInput = "";
        $this->ifUserExist = "";
        $this->passwordInput = "";
        $this->userRole = "";
        $this->userId = "";
        
        if($hash != 0 ) {
            $this->authhash=$hash;
            $_SESSION['authhash'] = $hash;
        }
        else{
            if(isset($_SESSION['authhash'])){
                $this->authhash = $_SESSION['authhash'];
            }
        }
        
        $query = "SELECT id FROM users WHERE authhash=:authhash";
        $result = $db->prepare($query);
        $result->bindParam(':authhash', $this->authhash);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);

        if(!isset($result['id'])){
            $this->view('login/info_page', ['infoPage' => 3]);
            return;
        }

        if(!isset($_POST['password']) || !isset($_POST['repeatPassword'])){
            $this->view('login/set_new_password', ['errorPassword' => $this->errorMessage, 
            'serverError' => $this->serverError, 'siteFooter' => $siteFooter, 'siteName' => $siteName]);
            return;
        }
        
        $this->passwordInput = $_POST['password'];
        $repeatPasswordInput = $_POST['repeatPassword'];

        $passwordsFine = $this->verifyPassword();

        if($passwordsFine) $passwordsFine =  $this->comparePasswords($this->passwordInput, $repeatPasswordInput);

        if($passwordsFine)
        {
            $query = "SELECT id FROM users WHERE authhash=:authhash";
            $result = $db->prepare($query);
            $result->bindParam(':authhash', $this->authhash);
            $result->execute();
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if(isset($result['id'])){
                $passwordToDB = hash('sha256', $this->passwordInput);
                $query = "UPDATE users SET password=:password, authhash=NULL WHERE authhash=:authhash";
                $result = $db->prepare($query);
                $result->bindParam(':password', $passwordToDB);
                $result->bindParam(':authhash', $this->authhash);
                $result->execute();
                $this->view('login/info_page', ['infoPage' => 2]);
                return;
            }else{
                $this->view('login/info_page', ['infoPage' => 3]);
                return;
            }           
        }

        $_SESSION['errorPassword'] = $this->errorMessage;

        $this->view('login/set_new_password', ['errorPassword' => $this->errorMessage, 'serverError' => $this->serverError, 
        'siteFooter'=> $siteFooter, 'siteName' => $siteName]);
    }

    public function forgotten_password(){
        unset($_SESSION['loggedUser']);
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);       
        $siteName = $this->getSiteName($db);

        if(isset($_POST['forgottenPasswordSubmit'])){
            $email = $_POST['email'];
            $query = "SELECT id FROM users WHERE email=:email";
            $result = $db->prepare($query);
            $result->bindParam(':email', $email);
            $result->execute();
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if(isset($result['id'])){
                $id = $result['id'];
                $authhash=hash('sha256', $this->generateRandomString(10));
                $query = "UPDATE users SET authhash=:authhash WHERE id=:id";
                $result = $db->prepare($query);
                $result->bindParam(':id', $id);
                $result->bindParam(':authhash', $authhash);
                $result->execute();

                $path = PUBLICPATH;
                try{
                    $config = require_once dirname(__FILE__,2) . '/core/mailerconfig.php';
                    $mail = new PHPMailer();
    
                    $mail->isSMTP();
    
                    $mail->Host = $config['host'];
                    $mail->Port = $config['port'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->SMTPAuth = true;
    
                    $mail->Username = $config['username'];
                    $mail->Password = $config['password'];
    
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom($config['username'], 'Grontsmar');
                    $mail->addAddress($email);
                    $mail->addReplyTo($config['username'], 'Grontsmar');
    
                    $mail->isHTML(true);
                    $mail->Subject = 'Resetowanie has??a w sklepie Grontsmar';
                    $mail->Body = "<html>
                    <head>
                    <title> Resetowanie has??a w sklepie Grontsmar </title>
                    </head>
                    <body>
                    <h1> Dzie?? dobry!</h1>
                    <p> Dostajesz t?? wiadomo???? poniewa?? kto??, najprawdopodobniej Ty u??y?? opcji resetowania has??a w naszym serwisie, 
                    je??li jednak to nie by??e?? Ty skontaktuj si?? jak najszybciej z nami!</p>
                    <a href='$path/login/set_new_password/$authhash'>Link aktywacyjny</a>
                    <br>
                    <br>
                    <p> Powy??szy link jest wa??ny 48 godzin. </p>
                    </body>
                    </html>";
    
                    $mail->send();
                } catch(Exception $e){
                    echo "<script>alert('B????d wysy??ania maila!')</script>";
                }
            }
            $this->view('login/info_page', ['infoPage' => 1]);
            return;
        }
        $this->view('login/forgotten_password', ['siteFooter' => $siteFooter, 'siteName' => $siteName]);
    }
    
    public function validate(){
        unset($_SESSION['loggedUser']);
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);
        $siteName = $this->getSiteName($db);

        $this->errorMessage = "";
        $this->serverError = false;
        $this->check = true;
        $this->emailOrLoginInput = "";
        $this->ifUserExist = "";
        $this->passwordInput = "";
        $this->userRole = "";
        $this->userId = "";

        if(!isset($_POST['emailOrLogin']) || !isset($_POST['password'])){
            $this->view('login/index', ['errorPassword' => $this->errorMessage, 'emailOrLoginInput' => $this->emailOrLoginInput, 'serverError' => $this->serverError,
            'siteFooter' => $siteFooter, 'siteName' => $siteName]);
            return;
        }
        

        isset($_SESSION['emailOrLoginInput']) ? $this->emailOrLoginInput = $_SESSION['emailOrLoginInput'] : $this->emailOrLoginInput = "";

        $this->emailOrLoginInput = strtolower($_POST['emailOrLogin']);
        $this->passwordInput = $_POST['password'];

        $this->checkIfEmailAsLoginOption() ? $this->emailVerificationFunction($db) : $this->loginVerificationFunction($db);
        if($this->check == true) $this->checkPassword();

        $_SESSION['errorPassword'] = $this->errorMessage;

        $this->view('login/index', ['errorPassword' => $this->errorMessage, 'emailOrLoginInput' => $this->emailOrLoginInput, 
        'serverError' => $this->serverError, 'siteFooter' => $siteFooter, 'siteName' => $siteName]);

    }

    private function comparePasswords($password, $repeatPassword) {
        if($password == $repeatPassword){
            return true;
        }else{
            $this->errorDuringValidation("*Podane has??a nie s?? identyczne");
            return false;
        }
    }

    /** Function that generates random string
     * @param {int} length of wanted string
     * 
     * @return Returns generated string
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /** Function that checks if user used email or login
     * 
     */
    private function checkIfEmailAsLoginOption(){
        if(str_contains($this->emailOrLoginInput, '@')) return true; else return false; 
    }

    /** Grouping function to check if email is valid
     * 
     */
    private function emailVerificationFunction($db){
        $this->verifyEmail($this->emailOrLoginInput)
        ? $this->checkIfUserExists(true, $db) 
        : $this->errorDuringValidation("*Dane dostarczone do serwera nie zgadzaj?? si?? z danymi klienta");
    }

    /** Grouping function to check if login is valid
     * 
     */
    private function loginVerificationFunction($db){
        $this->verifyLogin($this->emailOrLoginInput)
        ? $this->checkIfUserExists(false, $db) 
        : $this->errorDuringValidation("*Dane dostarczone do serwera nie zgadzaj?? si?? z danymi klienta");
    }

    /** Function that checks if given user exists in DB
     * 
     */
    private function checkIfUserExists($email, $db){
        $_SESSION['emailOrLoginInput'] =  $this->emailOrLoginInput;
        $email 
        ? $userQuery = $db->prepare('SELECT id, name, password, role, temporary, active FROM users WHERE email = :emailorlogin') 
        : $userQuery = $db->prepare('SELECT id, name, password, role, temporary, active FROM users WHERE login = :emailorlogin');
        $userQuery->bindValue(':emailorlogin', $this->emailOrLoginInput, PDO::PARAM_STR);
        $userQuery->execute();

        $this->ifUserExist = $userQuery->fetch(PDO::FETCH_ASSOC);
        if(!empty($this->ifUserExist)){
            if($this->ifUserExist['temporary'] == true) $this->errorDuringValidation("*Konto nie zosta??o aktywowane, sprawd?? maila celem jego aktywacji");
            if($this->ifUserExist['role'] == 'none') $this->errorDuringValidation("*B????d");
            if($this->ifUserExist['active'] == 0) $this->errorDuringValidation("*B????d");
            if($this->ifUserExist) $_SESSION['loggedUser_name'] = $this->ifUserExist['name'];
            if($this->ifUserExist) $_SESSION['loggedUser_id'] = $this->ifUserExist['id'];
            if($this->ifUserExist) {
                $this->userRole = $this->ifUserExist['role'];
                $this->userId = $this->ifUserExist['id'];
            }
            else $this->errorDuringValidation("*Podano b????dny email lub has??o");
        }else{
            $this->errorDuringValidation("*B????d ????czenia z baz?? danych");
        }
    }

    /** Function that sets errors
     * 
     */
    private function errorDuringValidation($errorMessage){
        $this->errorMessage = $errorMessage;
        $this->serverError = true;
        $this->check = false;
    }

    /** Function that checks if given email meets the conditions
     * 
     */
    private function verifyEmail($email){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if(preg_match($regex, $email)){
            return true;
        }
        else return false;
    }

    /** Function that checks if given login meets the conditions
     * 
     */
    private function verifyLogin($login){
        $regex  = '/^[a-z0-9]+$/';
        if(preg_match($regex, $login)){
            if(strlen($login)<8 && strlen($login)>25)
                return false;
            return true;
        }
        else return false;
    }

    /** Grouping function to check if password is valid
     * 
     */
    private function checkPassword(){
        if($this->verifyPassword()){
            $this->comparePasswordWithDb() 
            ? $this->loginSuccessful()
            : $this->errorDuringValidation("*Podano b????dny email lub has??o");
        }
        else{
            $this->errorDuringValidation("*Dane dostarczone do serwera nie zgadzaj?? si?? z danymi klienta");
        }
    }

    /** Function that checks if given password meets the conditions
     * @return Returns boolean, password meets the conditions - true, else - false
     * 
     */
    private function verifyPassword(){
        $this->passwordInput = trim($this->passwordInput, " ");
        if(strlen($this->passwordInput) < 8){
            return false;
        }
        if(strlen($this->passwordInput) > 25){
            return false;
        }
        return true;
    }

    /** Function that checks if given password is the same with password in DB
     * @return Returns boolean, password is same as password in DB - true, else - false
     * 
     */
    private function comparePasswordWithDb(){
        if(hash('sha256', $this->passwordInput) == $this->ifUserExist['password'])
        return true;
        else return false;
    }

    /** Function that moves to after login page
     * 
     */
    private function loginSuccessful(){
        unset($_SESSION['errorMessage']);
        $_SESSION['loggedUser'] = $this->userRole;
        $_SESSION['idLoggedUser'] = $this->userId;
        if($this->userRole == "admin")
            header("Location:" . ROOT . "/admin");
        else if($this->userRole == "contentmanager")
            header("Location:" . ROOT . "/manager");
        else if($this->userRole == "shopservice")
            header("Location:" . ROOT . "/service");
        else if($this->userRole == "user")
            header("Location:" . ROOT . "/home");
    }

    private function getFooter($db){
        if(isset($_SESSION['siteFooter'])){
            $result = $_SESSION['siteFooter'];
        }else{
            $query = "SELECT * FROM footer";
            $result = $db->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['siteFooter'] = $result;
        }
        return $result;
    }

    private function getSiteName($db){
        if(isset($_SESSION['siteName'])){
            $result = $_SESSION['siteName'];
        }else{
            $query = "SELECT sitename FROM siteinfo LIMIT 1";
            $result = $db->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['siteName'] = $result;
        }
        return $result;
    }
}
?>