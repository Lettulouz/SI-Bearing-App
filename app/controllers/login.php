<?php

class Login extends Controller
{
    private $errorMessage = "";
    private $serverError = false;
    private $check = true;
    private $emailOrLoginInput = "";
    private $ifUserExist = "";
    private $passwordInput = "";
    private $userRole = "";


    public function index(){
        header("Location:" . ROOT . "/login/validate");
    }

    
    public function validate(){
        $this->errorMessage = "";
        $this->serverError = false;
        $this->inputError = false;
        $this->check = true;
        $this->emailOrLoginInput = "";
        $this->ifUserExist = "";
        $this->passwordInput = "";
        $this->userRole = "";


        if(!isset($_POST['emailOrLogin']) || !isset($_POST['password'])){
            $this->view('login/index', ['errorPassword' => $this->errorMessage, 'emailOrLoginInput' => $this->emailOrLoginInput, 'serverError' => $this->serverError]);
            return;
        }
        

        isset($_SESSION['emailOrLoginInput']) ? $this->emailOrLoginInput = $_SESSION['emailOrLoginInput'] : $this->emailOrLoginInput = "";

        $this->emailOrLoginInput = strtolower($_POST['emailOrLogin']);
        $this->passwordInput = $_POST['password'];

        $this->checkIfEmailAsLoginOption() ? $this->emailVerificationFunction() : $this->loginVerificationFunction();
        if($this->check == true) $this->checkPassword();

        $_SESSION['errorPassword'] = $this->errorMessage;

        $this->view('login/index', ['errorPassword' => $this->errorMessage, 'emailOrLoginInput' => $this->emailOrLoginInput, 'serverError' => $this->serverError]);

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
    private function emailVerificationFunction(){
        $this->verifyEmail($this->emailOrLoginInput)
        ? $this->checkIfUserExists(true) 
        : $this->errorDuringValidation("*Dane dostarczone do serwera nie zgadzają się z danymi klienta");
    }

    /** Grouping function to check if login is valid
     * 
     */
    private function loginVerificationFunction(){
        $this->verifyLogin($this->emailOrLoginInput)
        ? $this->checkIfUserExists(false) 
        : $this->errorDuringValidation("*Dane dostarczone do serwera nie zgadzają się z danymi klienta");
    }

    /** Function that checks if given user exists in DB
     * 
     */
    private function checkIfUserExists($email){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $_SESSION['emailOrLoginInput'] =  $this->emailOrLoginInput;
        $email 
        ? $userQuery = $db->prepare('SELECT id, password, role FROM users WHERE email = :emailorlogin') 
        : $userQuery = $db->prepare('SELECT id, password, role FROM users WHERE login = :emailorlogin');
        $userQuery->bindValue(':emailorlogin', $this->emailOrLoginInput, PDO::PARAM_STR);
        $userQuery->execute();

        

        $this->ifUserExist = $userQuery->fetch(PDO::FETCH_ASSOC);
        $this->ifUserExist ? ($this->userRole = $this->ifUserExist['role']) : $this->errorDuringValidation("*Podano błędny email lub hasło");
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
            : $this->errorDuringValidation("*Podano błędny email lub hasło");
        }
        else{
            $this->errorDuringValidation("*Dane dostarczone do serwera nie zgadzają się z danymi klienta");
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
        if($this->userRole == "admin")
            header("Location:" . ROOT . "/admin");
        else if($this->userRole == "contentmanager")
            header("Location:" . ROOT . "/manager");
        else if($this->userRole == "user")
            header("Location:" . ROOT . "/home");
    }
}
?>