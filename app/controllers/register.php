<?php

use PHPMailer\PHPMailer\PHPMailer;
class Register extends Controller
{
    private $errorMessage = "";
    private $inputError = false;
    private $serverError = false;
    private $check = true;
    private $emailInput = "";
    private $ifUserExist = "";
    private $ifEmailExist = "";
    private $ifLoginExist = "";
    private $passwordInput = "";
    private $nameInput = "";
    private $surnameInput = "";
    private $loginInput = "";
    private $errorName = "";
    private $errorSurname = "";
    private $errorLogin = "";
    private $errorEmail = "";
    private $errorPassword = "";

    public function index(){
        header("Location:" . ROOT . "/register/validate");
    }

    public function success_page($sid){     
        if(isset($_SESSION['success_page'])){
            $path = $_SESSION['success_page'];
            unset($_SESSION['success_page']);
            if($sid==1){
                $firstLine = "Dodano użytkownika";
                $secondLine = "pomyślnie!";
            }
            $this->view('success_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            header("Refresh: 2; url=" . ROOT );
        }
        else header("Location:" . ROOT . "");
    }
    
    public function validate(){
        unset($_SESSION['loggedUser']);
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);

        $this->serverError = false;
        $this->inputError = false;
        $this->check = true;
        $this->emailInput = "";
        $this->ifUserExist = "";
        $this->passwordInput = "";
        $this->nameInput = "";
        $this->surnameInput = "";
        $this->loginInput = "";

        if(!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['login']) || !isset($_POST['email']) || !isset($_POST['password'])){
            $this->view('register/index', ['errorPassword' => $this->errorMessage, 'errorLogin' => $this->errorMessage, 
            'errorEmail' => $this->errorMessage, 'emailInput' => $this->emailInput, 'nameInput' => $this->nameInput, 
            'surnameInput' => $this->surnameInput, 'loginInput' => $this->loginInput, 'passwordInput' => $this->passwordInput, 
            'serverError' => $this->serverError, 'errorName' => '', 'errorSurname' => '', 'siteFooter' => $siteFooter]);
            return;
        }

        if(isset($_SESSION['nameInput'])) $this->nameInput = $_SESSION['nameInput'];
        if(isset($_SESSION['surnameInput'])) $this->surnameInput = $_SESSION['surnameInput'];
        if(isset($_SESSION['loginInput'])) $this->loginInput = $_SESSION['loginInput'];
        if(isset($_SESSION['emailInput'])) $this->emailInput = $_SESSION['emailInput'];
        
        $this->nameInput = $_POST['name'];
        $this->surnameInput = $_POST['surname'];
        $this->loginInput = strtolower($_POST['login']);
        $this->emailInput = strtolower($_POST['email']);
        $this->passwordInput = $_POST['password'];

        if(($this->check = $this->verifyName($this->nameInput)) == false){
            $this->errorDuringValidation("*Nieprawidłowe imie");
            $this->errorName = $this->errorMessage;
        }

        if(($this->check = $this->verifyName($this->surnameInput)) == false){
            $this->errorDuringValidation("*Nieprawidłowe nazwisko");
            $this->errorSurname = $this->errorMessage;
        }
            
        if(($this->check = $this->verifyLogin($this->loginInput)) == false){
            $this->errorDuringValidation("*Nieprawidłowy login");
            $this->errorLogin = $this->errorMessage;
        }

        if(($this->check = $this->verifyEmail($this->emailInput)) == false){
            $this->errorDuringValidation("*Nieprawidłowy login");
            $this->errorEmail = $this->errorMessage;
        }

        if(($this->check = $this->verifyPassword()) == false){
            $this->errorDuringValidation("*Zła długość hasła");
            $this->errorPassword = $this->errorMessage;
        }

        require_once dirname(__FILE__,2) . '/core/database.php';
        if($this->check==true)
        {
            $this->checkIfUserExists($db);
        }

        $_SESSION['errorPassword'] = $this->errorPassword;
        $_SESSION['errorLogin'] = $this->errorLogin;
        $_SESSION['errorEmail'] = $this->errorEmail;
        $_SESSION['errorSurname'] = $this->errorSurname;
        $_SESSION['errorName'] = $this->errorName;

        if($this->check==true){
            $this->insertUser($db);
            $_SESSION['success_page'] = "validate";
            header("Location:" . ROOT . "/admin/success_page/1");
        }
        
        $this->view('register/index', ['errorPassword' => $this->errorPassword, 'errorLogin' => $this->errorLogin, 
        'errorEmail' => $this->errorEmail, 'emailInput' => $this->emailInput, 'nameInput' => $this->nameInput, 
        'surnameInput' => $this->surnameInput, 'loginInput' => $this->loginInput, 'passwordInput' => $this->passwordInput, 
        'serverError' => $this->serverError, 'errorName' => $this->errorName, 'errorSurname' => $this->errorSurname, 'siteFooter' => $siteFooter]);
    }

    private function checkIfUserExists($db){
        $_SESSION['loginInput'] =  $this->loginInput;
        $_SESSION['emailInput'] =  $this->emailInput;
        
        $userQuery1 = $db->prepare('SELECT id FROM users WHERE email = :email');
        $userQuery2 = $db->prepare('SELECT id FROM users WHERE login = :login');
        $userQuery1->bindValue(':email', $this->emailInput, PDO::PARAM_STR);
        $userQuery2->bindValue(':login', $this->loginInput, PDO::PARAM_STR);
        $userQuery1->execute();
        $userQuery2->execute();

        $this->ifEmailExist = $userQuery1->fetch(PDO::FETCH_ASSOC);
        $this->ifLoginExist = $userQuery2->fetch(PDO::FETCH_ASSOC);

        if($this->ifEmailExist){
            $this->errorDuringValidation("*Użytkownik o takim emailu już istnieje");
            $this->errorEmail = $this->errorMessage;
        }
        if($this->ifLoginExist){
            $this->errorDuringValidation("*Użytkownik o takim loginie już istnieje");
            $this->errorLogin = $this->errorMessage;
        }
    }

    /** Function that sets errors
     * 
     */
    private function errorDuringValidation($errorMessage){
        $this->errorMessage = $errorMessage;
        //$this->serverError = true;
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

    /** Function that checks if given name meets the conditions
     * 
     */
    private function verifyName($name){
        $regex  = '/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/';
        if(preg_match($regex, $name)){
            return true;
        }
        else return false;
    }

    /** Function that checks if given login meets the conditions
     * 
     */
    private function verifyLogin($login){
        $regex  = '/^[a-z0-9]+$/';
        if(preg_match($regex, $login) && strlen($login)>=8){
            return true;
        }
        else return false;
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

    private function insertUser($db){
        $commandString = $db->prepare("INSERT INTO users (name, lastname, login, email, password, role, temporary) VALUES (:name, :surname, :login, :email, :password, 'user', '1')");
        $commandString->bindValue(":name", $this->nameInput, PDO::PARAM_STR);
        $commandString->bindValue(":surname", $this->surnameInput, PDO::PARAM_STR);
        $commandString->bindValue(":login", $this->loginInput, PDO::PARAM_STR);
        $commandString->bindValue(":email", $this->emailInput, PDO::PARAM_STR);
        $commandString->bindValue(":password", hash('sha256', $this->passwordInput), PDO::PARAM_STR);
        $commandString->execute();
        $query = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
        $result = $db->prepare($query);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $path = PUBLICPATH;
        try{
            $authhash = hash('sha256',$this->nameInput . $this->surnameInput . $this->emailInput . $this->loginInput . "user" . $result['id']);

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
            $mail->addAddress($this->emailInput);
            $mail->addReplyTo($config['username'], 'Grontsmar');

            $mail->isHTML(true);
            $mail->Subject = 'Założone konto w sklepie Grontsmar';
            $mail->Body = "<html>
            <head>
            <title> Założone konto w sklepie Grontsmar </title>
            </head>
            <body>
            <h1> Dzień dobry! </h1>
            <p> Wszystko wskazuje na to, że właśnie utworzyłeś konto w serwisie Grontsmar. Potwierdź je zanim wygaśnie! </p>
            <br>
            <a href='$path/userverify/$authhash'>Link aktywacyjny</a>
            <br>
            <br>
            <p> Masz 48h na aktywację konta, po tym czasie konto zostanie usunięte. </p>
            </body>
            </html>";

            //$mail->addAttachment('ścieżka');

            $mail->send();
        } catch(Exception $e){
            echo "<script>alert('Błąd wysyłania maila!')</script>";
        }
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
}
?>