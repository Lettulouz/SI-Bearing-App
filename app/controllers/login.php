<?php
class Login extends Controller
{
    public function index(){
        if(isset($_SESSION['errorEmailOrLogin'])){
            $errorEmailOrLogin = $_SESSION['errorEmailOrLogin'];
        }
        else{
            $errorEmailOrLogin = "";
        }
        $errorEmailOrLogin = "";
        $this->view('login/index', ['errorEmailOrLogin' => $errorEmailOrLogin]);
    }

    
    public function validate(){
        //$DB = new DataBase();
        //$wynik = $DB->select("SELECT * FROM `book`");
        $login = "admin";
        echo "<script src='" . APPPATH . "/scripts/login.js" .  "'></script>";

        if(isset($_POST['emailOrLogin'])){
            $emailOrLoginInput = $_POST['emailOrLogin'];
            $errorEmailOrLogin = "";

            if(str_contains($emailOrLoginInput, '@')){
                if($emailOrLoginInput != $login){
                    $errorEmailOrLogin = "*Podano błędny email lub hasło";
                    $_SESSION['errorEmailOrLogin'] = $errorEmailOrLogin;
                }
                else{
                    unset($_SESSION['errorEmailOrLogin']);
                    $_SESSION['loggedUser'] = "admin";
                    echo "<script> window.location.assign('" . ROOT . "/admin') </script>";
                }
            }
            else{
                if($emailOrLoginInput != $login){
                    $errorEmailOrLogin = "*Podano błędny login lub hasło";
                    $_SESSION['errorEmailOrLogin'] = $errorEmailOrLogin;
                }
                else{
                    unset($_SESSION['errorEmailOrLogin']);
                    $_SESSION['loggedUser'] = "admin";
                    echo "<script> window.location.assign('" . ROOT . "/admin') </script>";
                }
            }
            
        }
        $this->view('login/index', ['errorEmailOrLogin' => $errorEmailOrLogin]);
        //echo "<script> window.location.assign('" . ROOT . "/login') </script>";
    }

    private function onValidateButtonClick(){
        $login = "Admin";
        $haslo = "Admin123";
        if(isset($_POST['emailOrLogin'])){
            $test = $_POST['emailOrLogin'];
            if($test != $login){
                
            }
        }
        if(isset($_POST['password'])){
            $test = $_POST['password'];
        }
        return;
    }

}
?>