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

        $query="SELECT COUNT(*) as c FROM items";
        $numberOfItems = $db->query($query);
        $numberOfItems = $numberOfItems->fetch(PDO::FETCH_ASSOC);
        $numberOfItems = $numberOfItems['c'];

        $numberOfPages = intdiv($numberOfItems, 32) + 1;

        $query_m="SELECT id, name FROM manufacturers;";
        $manufacturers = $db->query($query_m);
        $manufacturers = $manufacturers->fetchAll(PDO::FETCH_ASSOC);

        $query_categ="SELECT id, name FROM categories;";
        $categories = $db->query($query_categ);
        $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

        $query_catalog="SELECT id, name FROM catalog;";
        $catalogs = $db->query($query_catalog);
        $catalogs = $catalogs->fetchAll(PDO::FETCH_ASSOC);

        $query_attributes="SELECT id, name, unit, isrange FROM attributes;";
        $attributes = $db->query($query_attributes);
        $attributes = $attributes->fetchAll(PDO::FETCH_ASSOC);

        //
        //   Producenci
        //
        $tableMan = array();
        // pobiera do tablicy id producetnów
        $i = 0;
        foreach($manufacturers as $manufacturer)
        {
            $tableMan[$i] = $manufacturer['id'];
            $i++;
        }
        

        if (isset($_POST['checkBoxVarManufacturers'])) 
        {
            $tableMan = $_POST['checkBoxVarManufacturers']; 
        }

        $id_manufacturer = '';
        // zamienia tablice w jednego stringa
        // wystarczy dostarczyć tablice wypełnioną id producenta i polecenie sql działa
        for($j = 0; $j < count($tableMan); $j++)
        {
            if($j != 0)
            {
                $id_manufacturer = $id_manufacturer.', '.$tableMan[$j];
            }
            else
            {
                $id_manufacturer = $id_manufacturer = $id_manufacturer.$tableMan[$j];
            }
        }

        //
        //   Kategorie
        //
        $tableCateg = array();
        $i = 0;
        foreach($categories as $category)
        {
            $tableCateg[$i] = $category['id'];
            $i++;
        }
        
        if (isset($_POST['checkBoxVarCategories'])) 
        {
            $tableCateg = $_POST['checkBoxVarCategories']; 
        }

        $id_category = '';
        // zamienia tablice w jednego stringa
        // wystarczy dostarczyć tablice wypełnioną id producenta i polecenie sql działa
        for($j = 0; $j < count($tableCateg); $j++)
        {
            if($j != 0)
            {
                $id_category = $id_category.', '.$tableCateg[$j];
            }
            else
            {
                $id_category = $id_category = $id_category.$tableCateg[$j];
            }
        }

        //
        //   Katalogi
        //
        $tableCatal = array();
        $i = 0;
        foreach($catalogs as $catalog)
        {
            $tableCatal[$i] = $catalog['id'];
            $i++;
        }

        if (isset($_POST['checkBoxVarCatalogs'])) 
        {
            $tableCatal = $_POST['checkBoxVarCatalogs']; 
        }

        $query="SELECT COUNT(*) as amount FROM catalog";
        $catalogsAmount = $db->query($query);
        $catalogsAmount = $catalogsAmount->fetch(PDO::FETCH_ASSOC);
        $catalogsAmount = $catalogsAmount['amount'];

        $catalogsAmount == sizeof($tableCatal) ? $querySwitch = true : $querySwitch = false;

        $id_catalog = '';
        // zamienia tablice w jednego stringa
        // wystarczy dostarczyć tablice wypełnioną id producenta i polecenie sql działa
        for($j = 0; $j < count($tableCatal); $j++)
        {
            if($j != 0)
            {
                $id_catalog = $id_catalog.', '.$tableCatal[$j];
            }
            else
            {
                $id_catalog = $id_catalog = $id_catalog.$tableCatal[$j];
            }
        }

       
        //
        //   Atrybuty
        //
        $tableAttr = array();
        $tableAttrValues = array();
        $i = 0;
        foreach($attributes as $attribute)
        {
            $tableAttr[$i] = $attribute['id'];
            $i++;
        }
        
        $attrQuery = '';
        $attrParamQuery = '';
        if (isset($_POST['checkBoxVarAttributes']) && isset($_POST['arrayOfAttrVal'])) 
        {
            $tableAttr = $_POST['checkBoxVarAttributes']; 
            $tableAttrValues = $_POST['arrayOfAttrVal'];
           
            // zamienia tablice w jednego stringa
            // wystarczy dostarczyć tablice wypełnioną id producenta i polecenie sql działa
            for($j = 0; $j < count($tableAttr); $j++)
            {
                $first = $tableAttrValues[$j];
                $second = $tableAttrValues[$j];
                $first = substr($first .'-', 0, strpos($first , '-'));
                $second = substr($second, (strpos($second, '-') ?: -1) + 1);
                $attrIdLoc = $tableAttr[$j];
                if(empty($first)){
                    $attrQuery .= "AND(aoi.id_attribute=:id_attribute$attrIdLoc && aoi.value<=:secondParam$attrIdLoc)";
                }else if(empty($second)){
                    $attrQuery .= "AND(aoi.id_attribute=:id_attribute$attrIdLoc && aoi.value>=:firstParam$attrIdLoc)";
                }else if(!empty($first) && !empty($second)){
                    $attrQuery .= "AND(aoi.id_attribute=:id_attribute$attrIdLoc && aoi.value>=:firstParam$attrIdLoc && aoi.value<=:secondParam$attrIdLoc)";
                }
            }
        }


        if (isset($_POST['checkBoxVarAttributes'])) 
        {
           //print_r($id_attribute);
           // die();
        }


        $searchEx = '%' . $search . '%';        
        if($querySwitch){
            $query="SELECT i.name, i.id as itemID, price, m.name as 'name2', i.amount, i.price as itemPrice
            FROM items i 
            INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
            INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
            INNER JOIN categoriesofitem coi ON i.id = coi.id_item
            INNER JOIN categories categ ON coi.id_category = categ.id
            INNER JOIN attributesofitems aoi ON i.id = aoi.id_item 
            INNER JOIN attributes attr ON aoi.id_attribute = attr.id 
            LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
            LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
            WHERE i.name LIKE :search 
            AND m.id IN (:id_manufacturer)
            AND categ.id IN (:id_category) " 
            . $attrQuery .
            " GROUP BY i.id
            ORDER BY i.id ASC
            LIMIT :limit1, 32 ";
        }else{
            $query="SELECT i.name, i.id as itemID, price, m.name as 'name2', i.amount, i.price as itemPrice
            FROM items i 
            INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
            INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
            INNER JOIN categoriesofitem coi ON i.id = coi.id_item
            INNER JOIN categories categ ON coi.id_category = categ.id
            INNER JOIN attributesofitems aoi ON i.id = aoi.id_item 
            INNER JOIN attributes attr ON aoi.id_attribute = attr.id 
            LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
            LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
            WHERE i.name LIKE :search 
            AND m.id IN (:id_manufacturer)
            AND categ.id IN (:id_category)
            AND catal.id IN (:id_catalog) "
            . $attrQuery .
            " GROUP BY i.id
            ORDER BY i.id ASC
            LIMIT :limit1, 32 ";
        }

        $result = $db->prepare($query);
        if (isset($_POST['checkBoxVarAttributes']) && isset($_POST['arrayOfAttrVal'])) 
        {
            for($j = 0; $j < count($tableAttr); $j++)
            {
                $first = $tableAttrValues[$j];
                $second = $tableAttrValues[$j];            
                $first = substr($first .'-', 0, strpos($first , '-'));
                $second = substr($second, (strpos($second, '-') ?: -1) + 1);
                $attrIdLoc = $tableAttr[$j];

                if(empty($first)){
                    $result->bindParam(":id_attribute$attrIdLoc", $attrIdLoc);
                    $result->bindParam(":secondParam$attrIdLoc", $second);
                }else if(empty($second)){
                    $result->bindParam(":id_attribute$attrIdLoc", $attrIdLoc);
                    $result->bindParam(":firstParam$attrIdLoc",$first);
                }else if(!empty($first) && !empty($second)){
                    $result->bindParam(":id_attribute$attrIdLoc", $attrIdLoc);
                    $result->bindParam(":firstParam$attrIdLoc",$first);
                    $result->bindParam(":secondParam$attrIdLoc",$second);
                }
            }
        }

        $result->bindParam(':limit1',$limit1);
        $result->bindParam(':search',$searchEx);
        $result->bindParam(':id_manufacturer',$id_manufacturer);
        $result->bindParam(':id_category',$id_category);
        if(!$querySwitch) $result->bindParam(':id_catalog',$id_catalog);
        $result -> execute();
  
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
   
        print_r($result);
        die();

        $query="SELECT COUNT(i.id) AS c
        FROM items i 
        INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
        INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
        INNER JOIN categoriesofitem coi ON i.id = coi.id_item
        INNER JOIN categories categ ON coi.id_category = categ.id
        LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
        LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
        WHERE i.name LIKE '%".$search."%' 
        AND m.id IN (".$id_manufacturer.")
        AND categ.id IN (".$id_category.")
        AND catal.id IS NULL
        GROUP BY i.id
        ORDER BY i.id ASC";
        $numberOfItems = $db->prepare($query);
        $numberOfItems -> execute();
        $numberOfItems = $numberOfItems->fetch(PDO::FETCH_ASSOC);
        if(!empty($numberOfItems))
            $numberOfItems = $numberOfItems['c'];
        if(!empty($numberOfItems))
            $numberOfPages = intdiv($numberOfItems, 32) + 1;
        
        $this->view('store/index', ['itemsArray'=>$result, 'search' => $search, 'limit1' => $page, 
            'manufacturersArray' => $manufacturers, 'last'=> $endofitems,
            'test' => $id_manufacturer, 'siteFooter' => $siteFooter, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name,
        'categoriesArray'=>$categories, 'catalogsArray'=>$catalogs, 'attributesArray'=>$attributes, 'numberOfPages' => $numberOfPages, 'numberOfItems' => $numberOfItems]); // ten 'test' to do wywalenia na koniec
            
    }

    public function cart(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);

        $itemsInCart = NULL;
        if(isset($_COOKIE['itemsInCart']) && $_COOKIE['itemsInCart'] != ''){
            $query="SELECT d.title, d.description, i.name, i.id as itemID, m.name as 'name2', i.price as itemPrice
                FROM items i 
                LEFT JOIN descriptions d ON d.id_item=i.id
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                WHERE i.id IN (".rtrim($_COOKIE['itemsInCart'],',').")";


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

    public function order_history(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);
        
        $this->view('store/order_history', ['siteFooter' => $siteFooter, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]);
    }

}

?>