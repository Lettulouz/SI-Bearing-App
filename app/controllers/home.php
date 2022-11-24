<?php
class Home extends Controller
{
    public function index(){
        $message = "Witaj świecie";
        $this->view('home/index', ['message' => $message]);
    }
}
?>