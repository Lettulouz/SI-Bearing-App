<?php
class Login extends Controller
{
    public function index(){
        $this->view('login/index');
    }

    public function validate(){
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