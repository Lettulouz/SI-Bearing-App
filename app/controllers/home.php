<?php
class Home extends Controller
{
    /*
    public function index(){
        $message = "Witaj świecie";
        $this->view('home/index', ['message' => $message]);
    }
    */

    public function index(){
        require_once dirname(__FILE__,2) . '/core/database.php';

        $query="SELECT i.name as itemName, m.name as manufacturerName, amount, price
        FROM items i INNER JOIN manufactures m ON i.id_manufacturer=m.id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('home/index', ['itemsArray'=>$result]);
    }



}

?>