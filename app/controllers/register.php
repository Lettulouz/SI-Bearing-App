<?php
error_reporting(-1);
ini_set('display_errors', 'On');
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
        'serverError' => $this->serverError, 'errorName' => '', 'errorSurname' => '']);
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
        'serverError' => $this->serverError, 'errorName' => $this->errorName, 'errorSurname' => $this->errorSurname]);
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

    private function insertUser($db){
        $commandString = $db->prepare("INSERT INTO users (name, lastName, login, email, password, role) VALUES (:name, :surname, :login, :email, :password, 'user')");
        $commandString->bindValue(":name", $this->nameInput, PDO::PARAM_STR);
        $commandString->bindValue(":surname", $this->surnameInput, PDO::PARAM_STR);
        $commandString->bindValue(":login", $this->loginInput, PDO::PARAM_STR);
        $commandString->bindValue(":email", $this->emailInput, PDO::PARAM_STR);
        $commandString->bindValue(":password", hash('sha256', $this->passwordInput), PDO::PARAM_STR);
        $commandString->execute();
    } 
}
?>