<?php
class Register extends Controller
{
    public function index(){
        $this->view('register/index', []);
    }

    public function validate(){
        
        header("Location:" . ROOT . "/admin");
        $this->view('register/index', []);
    }

}
?>
