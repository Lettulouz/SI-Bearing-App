<?php

use PHPMailer\PHPMailer\PHPMailer;

class Service extends Controller
{
    public function index(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "service"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        $this->view('service/index', []);
    }

    public function logout(){
        unset($_SESSION['loggedUser']);
        header("Location:" . ROOT . "/login");
    }
}