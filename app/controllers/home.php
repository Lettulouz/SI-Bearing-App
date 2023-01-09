<?php
class Home extends Controller
{
    public function index(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = 
        $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);
        $siteName = $this->getSiteName($db);
        $query = "SELECT COUNT(id) as c FROM items";
        $result = $db->query($query);
        $itemsInDb = $result->fetch(PDO::FETCH_ASSOC);
        $itemsInDb = $itemsInDb['c'];

        $randNumbers = array();
        
        $randNumbers = $this->randomGen(0,$itemsInDb-1,4);
        
        $query = "SELECT id FROM items";
        $result = $db->query($query);
        $allItems = $result->fetchAll(PDO::FETCH_ASSOC);


        $inQuery = "(";

        for($i=0;$i<4;$i++){
            $inQuery .= $allItems[$randNumbers[$i]]['id'] . ",";
        }
        $inQuery = rtrim($inQuery, ",");
        $inQuery .= ")";

        $query= "SELECT i.id, i.name as name, price, m.name as manname
        FROM items i 
        INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
        INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
        WHERE i.id IN " . $inQuery;
        $result = $db->query($query);
        
        $selectedItems = $result->fetchAll(PDO::FETCH_ASSOC);
    
        $this->view('home/index', ['siteFooter' => $siteFooter, 'siteName' => $siteName, 
        'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name, 
        'selectedItems' => $selectedItems]);
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
    private function getSiteName($db){
        if(isset($_SESSION['siteName'])){
            $result = $_SESSION['siteName'];
        }else{
            $query = "SELECT sitename FROM siteinfo LIMIT 1";
            $result = $db->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['siteName'] = $result;
        }
        return $result;
    }

    private function randomGen($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
}