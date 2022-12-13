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

        $search = '';

        if(isset($_POST['search']))
        {
            $search = $_POST['search'];
        }

        $query="SELECT title, description, name
        FROM items i INNER JOIN descriptions d ON d.id_item=i.id
            WHERE name LIKE '%".$search."%'";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('home/index', ['itemsArray'=>$result]);
    }



}

?>