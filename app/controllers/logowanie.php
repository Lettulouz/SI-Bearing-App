<?php
class Logowanie extends Controller
{
    public function index($login = '', $haslo = '')
    {
        if(isset($_POST['login']))
        $login = $_POST['login'];

        if(isset($_POST['haslo']))
        $haslo = $_POST['haslo'];

        $this->view('logowanie/index', ['login' => $login, 'haslo' => $haslo]);
    }
}
?>