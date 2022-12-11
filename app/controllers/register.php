<?php

class Register extends Controller
{
    private $errorMessage = "";
    private $inputError = false;
    private $serverError = false;
    private $check = true;
    private $emailInput = "";
    private $ifUserExist = "";
    private $passwordInput = "";
    private $nameInput = "";
    private $surnameInput = "";
    private $loginInput = "";

    public function index(){
        header("Location:" . ROOT . "/register/validate");
    }
    
    public function validate(){

        $this->serverError = false;
        $this->inputError = false;
        $this->check = true;
        $this->emailInput = "";
        $this->ifUserExist = "";
        $this->passwordInput = "";
        $this->nameInput = "";
        $this->surnameInput = "";
        $this->loginInput = "";

        echo "<script src='" . APPPATH . "/scripts/register.js" .  "'></script>";

        isset($_SESSION['nameInput']) ? $this->nameInput = $_SESSION['nameInput'] : $this->nameInput = "";
        isset($_SESSION['surnameInput']) ? $this->surnameInput = $_SESSION['surnameInput'] : $this->surnameInput = "";
        isset($_SESSION['loginInput']) ? $this->loginInput = $_SESSION['loginInput'] : $this->loginInput = "";
        isset($_SESSION['emailInput']) ? $this->emailInput = $_SESSION['emailInput'] : $this->emailInput = "";
        

        isset($_POST['name']) ? $this->nameInput = $_POST['name'] : $this->nameInput = "";        
        isset($_POST['surname']) ? $this->surnameInput = $_POST['surname'] : $this->surnameInput = "";        
        isset($_POST['login']) ? $this->loginInput = $_POST['login'] : $this->loginInput = "";        
        isset($_POST['email']) ? $this->emailInput = $_POST['email'] : $this->emailInput = "";        
        isset($_POST['password']) ? $this->passwordInput = $_POST['password'] : $this->passwordInput = "";

        if(!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['login']) || !isset($_POST['email']) || !isset($_POST['password'])){
            $this->view('register/index', ['errorPassword' => $this->errorMessage, 'errorLogin' => $this->errorMessage, 'errorEmail' => $this->errorMessage, 'emailInput' => $this->emailInput, 'nameInput' => $this->nameInput, 'surnameInput' => $this->surnameInput, 'loginInput' => $this->loginInput, 'passwordInput' => $this->passwordInput, 'serverError' => $this->serverError]);
            return;
        }

        if($this->verifyEmail($this->emailInput) == false)
            $this->errorDuringValidation("*Nieprawidłowy adres email");

        if($this->verifyLogin($this->loginInput) == false)
            $this->errorDuringValidation("*Nieprawidłowy login");

        if($this->verifyPassword() == false)
            $this->errorDuringValidation("*Zła długość hasła");

        if($this->verifyEmail($this->emailInput) == true && $this->verifyLogin($this->loginInput) == true && $this->verifyPassword() == true)
         {
            $this->checkIfUserExists();
        }
        
            $_SESSION['errorPassword'] = $this->errorMessage;
            $_SESSION['errorLogin'] = $this->errorMessage;
            $_SESSION['errorEmail'] = $this->errorMessage;

        $this->view('register/index', ['errorPassword' => $this->errorMessage, 'errorLogin' => $this->errorMessage, 'errorEmail' => $this->errorMessage, 'emailInput' => $this->emailInput, 'nameInput' => $this->nameInput, 'surnameInput' => $this->surnameInput, 'loginInput' => $this->loginInput, 'passwordInput' => $this->passwordInput, 'serverError' => $this->serverError]);
        
        if($this->check==true)
            $this->insertUser();
    }

    private function checkIfUserExists(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $_SESSION['loginInput'] =  $this->loginInput;
        $_SESSION['emailInput'] =  $this->emailInput;
        $userQuery1 = $db->prepare('SELECT id FROM users WHERE email = :email');
        $userQuery2 = $db->prepare('SELECT id FROM users WHERE login = :login');
        $userQuery1->bindValue(':email', $this->emailInput, PDO::PARAM_STR);
        $userQuery2->bindValue(':login', $this->loginInput, PDO::PARAM_STR);
        $userQuery1->execute();
        $userQuery2->execute();

        $this->ifUserExist = $userQuery1->fetch(PDO::FETCH_ASSOC) || $userQuery2->fetch(PDO::FETCH_ASSOC);
        if($this->ifUserExist) $this->errorDuringValidation("*Użytkownik o takim emailu/loginie już istnieje");
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
        $regex  = '/^[a-z]+$/';
        if(!preg_match($regex, $login)){
            return false;
        }
        $regex  = '/^[a-z0-9]+$/';
        if(preg_match($regex, $login)){
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

    private function insertUser(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $commandString = "INSERT INTO users (name, surname, login, email, password) VALUES (?,?,?,?,?)";
        $db->exec($commandString);
        //$userQuery= $db->prepare($commandString);
        //$userQuery->execute([$this->name, $this->surname, $this->login, $this->email, $this->password]);
    }
}
?>