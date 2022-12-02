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

    public function list_of_products(){
        $this->view('manager/list_of_products_mng', []);
    }

    public function list_of_attributes(){
        $this->view('manager/list_of_attributes_mng', []);
    }

    public function list_of_catalogs(){
        $this->view('manager/list_of_catalogs_mng', []);
    }
}
?>