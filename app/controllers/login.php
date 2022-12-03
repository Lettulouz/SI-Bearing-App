<?php
class Login extends Controller
{
    public function index(){
        $this->view('login/index');
    }

    
    public function validate(){

        //$DB = new DataBase();
        //$wynik = $DB->select("SELECT * FROM `book`");

        $login = "Admin";
        $haslo = "Admin123";
        
        echo "<script src='" . APPPATH . "/scripts/login.js" .  "'></script>";
        echo "<script>testFunction()</script>";
        if(isset($_POST['loginButton'])){
        }
        if(isset($_POST['emailOrLogin'])){
            $test = $_POST['emailOrLogin'];
        }
        if(isset($_POST['password'])){
            $test = $_POST['password'];
        }
        $this->view('login/index');
    }
}
?>