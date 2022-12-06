<?php
class Login extends Controller
{
    public function index(){
        header("Location:" . ROOT . "/login/validate");
    }

    
    public function validate(){
        //$DB = new DataBase();
        //$wynik = $DB->select("SELECT * FROM `book`");
        $login = "admin";
        $password = "admin123";
        $check = 1;
        $emailOrLoginCheck = 0;
        $serverError = false;
        echo "<script src='" . APPPATH . "/scripts/login.js" .  "'></script>";

        if(isset($_SESSION['emailOrLoginInput'])){
            $emailOrLoginInput = $_SESSION['emailOrLoginInput'];
        }else{
            $emailOrLoginInput = "";
        }
        $errorPassword = "";
        $ifUserExist = "";

        if(isset($_POST['emailOrLogin'])){
            require_once dirname(__FILE__,2) . '/core/database.php';

            $emailOrLoginInput = strtolower($_POST['emailOrLogin']);
            $passwordInput = $_POST['password'];

            if(str_contains($emailOrLoginInput, '@')){
                if($this->verifyEmail($emailOrLoginInput)){
                    $_SESSION['emailOrLoginInput'] =  $emailOrLoginInput;
                    $userQuery = $db->prepare('SELECT id, password FROM users WHERE email = :email');
                    $userQuery->bindValue(':email', $emailOrLoginInput, PDO::PARAM_STR);
                    $userQuery->execute();

                    $ifUserExist = $userQuery->fetch(PDO::FETCH_ASSOC);

                    if(!$ifUserExist){
                        $errorPassword = "*Podano błędny email lub hasło";
                        $_SESSION['errorPassword'] = $errorPassword;
                        $check = 0;
                    }
                }
                else{
                    $errorPassword = "*Dane dostarczone do serwera nie zgadzają się z danymi klienta";
                    $serverError = true;
                    $_SESSION['errorPassword'] = $errorPassword;
                    $check = 0;
                }
            }
            else{
                if($this->verifyLogin($emailOrLoginInput)){
                    $_SESSION['emailOrLoginInput'] =  $emailOrLoginInput;
                    $userQuery = $db->prepare('SELECT id, password FROM users WHERE login = :login');
                    $userQuery->bindValue(':login', $emailOrLoginInput, PDO::PARAM_STR);
                    $userQuery->execute();

                    $ifUserExist = $userQuery->fetch(PDO::FETCH_ASSOC);
                    if(!$ifUserExist){
                        $errorPassword = "*Podano błędny login lub hasło";
                        $_SESSION['errorPassword'] = $errorPassword;
                        $check = 0;
                    }
                }
                else{
                    $errorPassword = "*Dane dostarczone do serwera nie zgadzają się z danymi klienta";
                    $serverError = true;
                    $_SESSION['errorPassword'] = $errorPassword;
                    $check = 0;
                }
            }
            if($check == 1){
                if($this->verifyPassword($passwordInput)){
                    $hashPassword = hash('sha256', $passwordInput);
                    if($hashPassword != $ifUserExist['password']){
                        $errorPassword = "*Podano błędny email lub hasło";
                        $serverError = true;
                        $_SESSION['errorPassword'] = $errorPassword;
                        $check = 0;
                    }
                }
                else{
                    $errorPassword = "*Dane dostarczone do serwera nie zgadzają się z danymi klienta";
                    $serverError = true;
                    $_SESSION['errorPassword'] = $errorPassword;
                    $check = 0;
                }
            }

            if($check == 1){
                unset($_SESSION['errorPassword']);
                $_SESSION['loggedUser'] = "admin";
                header("Location:" . ROOT . "/admin");
            }
            
        }

        $this->view('login/index', ['errorPassword' => $errorPassword, 'emailOrLoginInput' => $emailOrLoginInput, 'serverError' => $serverError]);

    }

    private function verifyEmail($email){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if(preg_match($regex, $email)){
            return true;
        }
        else return false;
    }

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

    private function verifyPassword($password){
        $password = trim($password, " ");
        if(strlen($password) < 8){
            return false;
        }
        if(strlen($password) > 25){
            return false;
        }
        return true;
    }
}
?>