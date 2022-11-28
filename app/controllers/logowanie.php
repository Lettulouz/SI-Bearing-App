<?php
class Logowanie extends Controller
{
    public function index(){
        $message = "czas się zalogować";
        $this->view('home/index', ['message' => $message]);
    }
}
?>