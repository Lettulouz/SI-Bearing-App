<?php
class Login extends Controller
{
    public function index(){
        $this->view('login/index');
    }

    
    public function validate(){
        //$DB = new DataBase();
        //$wynik = $DB->select("SELECT * FROM `book`");
        $login = "admin";
        echo "<script src='" . APPPATH . "/scripts/login.js" .  "'></script>";

        if(isset($_POST['emailOrLogin'])){
            $test = $_POST['emailOrLogin'];
            if($test != $login){
                echo "<script>setLoginError()</script>";
            }
            else{
            }
        }
        
        
        $this->view('login/index');
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