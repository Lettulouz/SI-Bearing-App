<?php
class Home extends Controller
{
    /*
    public function index(){
        $message = "Witaj świecie";
        $this->view('home/index', ['message' => $message]);
    }
    */

    public function index($limit1=1){
        if(isset($_POST['itemID'])){
            if(!isset($_SESSION['basketItems']))
                $_SESSION['basketItems']=array();
            array_push($_SESSION['basketItems'], $_POST['itemID']);
            empty($_POST['itemID']);
        }

        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false;   
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";

        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);


        $limit1=1;

        $search = '';
        $endofitems=0;
        if(isset($_POST['search']))
            $search = $_POST['search'];

        if(isset($_POST['limit1'])){
            $limit1 = $_POST['limit1'];
        }

        
        if($limit1 < 1)
            $limit1 = 1;

        $page = $limit1;
        $limit1--;
        $limit1 *= 8;


        $table = array();

        $query_m="SELECT id, name FROM manufacturers;";
        $manufacturer = $db->query($query_m);
        $manufacturer = $manufacturer->fetchAll(PDO::FETCH_ASSOC);



        // pobiera do tablicy id producetnów
        $i = 0;
        foreach($manufacturer as $manufacturers)
        {
            $table[$i] = $manufacturers['id'];
            $i++;
        }
        

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

        $query="SELECT d.title, d.description, i.name, i.id as itemID, m.name as 'name2'
            FROM items i 
            LEFT JOIN descriptions d ON d.id_item=i.id
            INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
            INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
            WHERE i.name LIKE '%".$search."%' 
            AND m.id IN (".$id_manufacturer.")
            ORDER BY i.id ASC
            LIMIT :limit1, 8 ";

        /* 
        // stare polecenie, jak baza się zmienie może się przydać
        $query="SELECT d.title, d.description, i.name, m.id, i.id as itemID, m.name as 'name2'
            FROM items i 
            LEFT JOIN descriptions d ON d.id_item=i.id 
            INNER JOIN manufacturers m ON i.id_manufacturer = m.id 
            WHERE i.name LIKE '%".$search."%' 
            AND m.id IN (".$id_manufacturer.")
            ORDER BY i.id ASC
            LIMIT :limit1,".$limit2." ";
        */

        $result = $db->prepare($query);
        $result->bindParam('limit1',$limit1);
        $result -> execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        $query2="SELECT d.title, d.description, i.name, i.id as ID, m.name as 'name2'
            FROM items i 
            LEFT JOIN descriptions d ON d.id_item=i.id
            INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
            INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
            WHERE i.name LIKE '%".$search."%' 
            AND m.id IN (".$id_manufacturer.")
            AND m.id IN (".$id_manufacturer.")
            ORDER BY i.id DESC LIMIT 1";

        
        $last = $db->query($query2);
        $last = $last->fetchAll(PDO::FETCH_ASSOC);
        $currentLast=end($result);

        if($currentLast!=false){
            if($currentLast['itemID']==$last[0]['ID']){
                $endofitems=1;
            }
        }
        if($currentLast==false){
            $limit1=0;
            $page=1;
            $result = $db->prepare($query);
            $result->bindParam('limit1',$limit1);
            $result -> execute();
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            $currentLast=end($result);
            if($currentLast!=false){
                if($currentLast['itemID']==$last[0]['ID']){
                    $endofitems=1;
                }
            }
            else{
                $endofitems=1;
            }
        }
        
        $this->view('home/index', ['itemsArray'=>$result, 'search' => $search, 'limit1' => $page, 
            'manufacturerArray' => $manufacturer, 'last'=> $endofitems,
            'test' => $id_manufacturer, 'siteFooter' => $siteFooter, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]); // ten 'test' to do wywalenia na koniec
            
    }

    public function basket(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);

        $query="SELECT d.title, d.description, i.name, i.id as itemID, m.name as 'name2', i.price as itemPrice
            FROM items i 
            LEFT JOIN descriptions d ON d.id_item=i.id
            INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
            INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
            WHERE i.id IN (".implode(', ',$_SESSION['basketItems']).")";

        
        
        $itemsInBacket = $db->query($query);
        $itemsInBacket = $itemsInBacket->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('home/basket', ['siteFooter' => $siteFooter, 'itemsArray'=>$itemsInBacket, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]);
    }

    private function getFooter($db){
        if(isset($_SESSION['siteFooter'])){
            $result = $_SESSION['siteFooter'];
        }else{
            $query = "SELECT * FROM footer";
            $result = $db->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['siteFooter'] = $result;
        }
        return $result;
    }

    public function item(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);
        
        $this->view('home/item', ['siteFooter' => $siteFooter, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]);
    }

}

?>