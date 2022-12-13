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
        $limit1 = 1;

        if(isset($_POST['search']))
            $search = $_POST['search'];

        if(isset($_POST['limit1']))
            $limit1 = $_POST['limit1'];

        if($limit1 < 1)
            $limit1 = 1;

        $przechowanie = $limit1;
        $limit1--;
        $limit2 = $limit1 + 1;
        $limit1 *= 8;
        $limit2 *= 8;

        $query="SELECT title, description, name
        FROM items i LEFT JOIN descriptions d ON d.id_item=i.id
            WHERE name LIKE '%".$search."%' LIMIT ".$limit1.",".$limit2." ";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('home/index', ['itemsArray'=>$result, 'search' => $search, 'limit1' => $przechowanie]);
    }



}

?>