<?php
class Manager extends Controller
{
    public function index(){
        $this->view('manager/index', []);
    }
}