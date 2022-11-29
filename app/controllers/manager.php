<?php
class Manager extends Controller
{
    public function index(){
        $this->view('manager/index', []);
    }

    public function add_item(){
        $this->view('manager/add_item', []);
    }

    public function add_attribute(){
        $this->view('manager/add_attribute', []);
    }

    public function add_catalog(){
        $this->view('manager/add_catalog', []);
    }
}
?>