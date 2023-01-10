<?php

class Logout extends Controller
{
    public function index(){
        unset($_SESSION['loggedUser']);
        unset($_SESSION['loggedUser_name']);
        unset($_SESSION['loggedUser_id']);
        $this->view('logout', []);
    }
}