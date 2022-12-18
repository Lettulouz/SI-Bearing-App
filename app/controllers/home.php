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

        $table = array();

        $query_m="SELECT id, name FROM manufactures;";
        $manufacturer = $db->query($query_m);
        $manufacturer = $manufacturer->fetchAll(PDO::FETCH_ASSOC);


        /* do destów przydawało się
        // pobiera do tablicy id producetnów
        $i = 0;
        foreach($manufacturer as $manufacturers)
        {
            $table[$i] = $manufacturers['id'];
            $i++;
        }
        */

        if (isset($_POST['checkboxvar'])) 
        {
            $table = $_POST['checkboxvar']; 
        }

        $id_manufacturer = '';
        // zamienia tablice w jednego stringa
        // wystarczy dostarczyć tablice wypełnioną id producenta i polecenie sql działa
        for($j = 0; $j < count($table); $j++)
        {
            if($j != 0)
            {
                $id_manufacturer = $id_manufacturer.', '.$table[$j];
            }
            else
            {
                $id_manufacturer = $id_manufacturer = $id_manufacturer.$table[$j];
            }
        }

        $query="SELECT d.title, d.description, i.name, m.id
            FROM items i 
            LEFT JOIN descriptions d ON d.id_item=i.id 
            INNER JOIN manufactures m ON i.id_manufacturer = m.id 
            WHERE i.name LIKE '%".$search."%' 
            AND m.id IN (".$id_manufacturer.")
            ORDER BY i.name ASC
            LIMIT ".$limit1.",".$limit2." ";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('home/index', ['itemsArray'=>$result, 'search' => $search, 'limit1' => $przechowanie, 
            'manufacturerArray' => $manufacturer,
            'test' => $id_manufacturer]); // ten 'test' to do wywalenia na koniec
    }



}

?>