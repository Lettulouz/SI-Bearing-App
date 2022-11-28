<?php
class Logowanie extends Controller
{
    public function index()
    {
        $message = "czas się zalogować";
        $this->view('logowanie/index', ['message' => $message]);
    }

    public function test()
    {
        $message = "test";
        $this->view('logowanie/index', ['message' => $message]);
    }

    public function test2($login = '', $haslo = '')
    {
        $this->view('logowanie/index', ['login' => $login, 'haslo' => $haslo]);
    }
}
?>