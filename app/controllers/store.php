<?php
class Store extends Controller
{
    /*
    public function index(){
        $message = "Witaj świecie";
        $this->view('home/index', ['message' => $message]);
    }
    */

    public function index($limit1=1){
        if(isset($_POST['itemID'])){
            if(!isset($_SESSION['cartItems']))
                $_SESSION['cartItems']=array();
            array_push($_SESSION['cartItems'], $_POST['itemID']);
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

        if(isset($_POST['page'])){
            $limit1 = $_POST['page'];
        }

        
        if($limit1 < 1)
            $limit1 = 1;

        $page = $limit1;
        $limit1--;
        $limit1 *= 32;


        $table = array();

        $query="SELECT COUNT(*) as c FROM items";
        $numberOfItems = $db->query($query);
        $numberOfItems = $numberOfItems->fetch(PDO::FETCH_ASSOC);
        $numberOfItems = $numberOfItems['c'];

        $numberOfPages = intdiv($numberOfItems, 32) + 1;

        $query_m="SELECT id, name FROM manufacturers;";
        $manufacturer = $db->query($query_m);
        $manufacturer = $manufacturer->fetchAll(PDO::FETCH_ASSOC);

        $query_categ="SELECT id, name FROM categories;";
        $categories = $db->query($query_categ);
        $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

        $query_catalog="SELECT id, name FROM catalog;";
        $catalogs = $db->query($query_catalog);
        $catalogs = $catalogs->fetchAll(PDO::FETCH_ASSOC);



        // pobiera do tablicy id producetnów
        $i = 0;
        foreach($manufacturer as $manufacturers)
        {
            $table[$i] = $manufacturers['id'];
            $i++;
        }
        

        if (isset($_POST['checkBoxVarManufacturers'])) 
        {
            $table = $_POST['checkBoxVarManufacturers']; 
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

        $query="SELECT i.name, i.id as itemID, price, m.name as 'name2'
            FROM items i 
            INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
            INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
            WHERE i.name LIKE '%".$search."%' 
            AND m.id IN (".$id_manufacturer.")
            ORDER BY i.id ASC
            LIMIT :limit1, 32 ";

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

        $query="SELECT COUNT(i.id) AS c
        FROM items i 
        INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
        INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
        WHERE i.name LIKE '%".$search."%' 
        AND m.id IN (".$id_manufacturer.")
        ORDER BY i.id ASC";
        $numberOfItems = $db->prepare($query);
        $numberOfItems -> execute();
        $numberOfItems = $numberOfItems->fetch(PDO::FETCH_ASSOC);
        if(!empty($numberOfItems))
            $numberOfItems = $numberOfItems['c'];
        if(!empty($numberOfItems))
            $numberOfPages = intdiv($numberOfItems, 32) + 1;

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

        
        $this->view('store/index', ['itemsArray'=>$result, 'search' => $search, 'limit1' => $page, 
            'manufacturerArray' => $manufacturer, 'last'=> $endofitems,
            'test' => $id_manufacturer, 'siteFooter' => $siteFooter, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name,
        'categArray'=>$categories, 'catalogsArray'=>$catalogs, 'numberOfPages' => $numberOfPages, 'numberOfItems' => $numberOfItems]); // ten 'test' to do wywalenia na koniec
            
    }

    public function cart(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);

        $itemsInCart = NULL;
        if(isset($_SESSION['cartItems'])){
            $query="SELECT d.title, d.description, i.name, i.id as itemID, m.name as 'name2', i.price as itemPrice
                FROM items i 
                LEFT JOIN descriptions d ON d.id_item=i.id
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                WHERE i.id IN (".implode(', ',$_SESSION['cartItems']).")";

            
            
            $itemsInCart = $db->query($query);
            $itemsInCart = $itemsInCart->fetchAll(PDO::FETCH_ASSOC);
        }
        
        $this->view('store/cart', ['siteFooter' => $siteFooter, 'itemsArray'=>$itemsInCart, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]);
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

    public function item($id){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);
        
        $this->view('store/item', ['id' => $id, 'siteFooter' => $siteFooter, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]);
    }

}

?>