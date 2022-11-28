<?php
class Logowanie extends Controller
{
    public function index(){
        $message = "czas się zalogować";
        $this->view('logowanie/index', ['message' => $message]);
    }
}
?>