<?php
class Store extends Controller
{
    /** This function display information, if order was succesful added to the database
     * @param {int} is the id of message
     */
    public function success_page($sid){     
        if(isset($_SESSION['success_page'])){
            $path = $_SESSION['success_page'];
            unset($_SESSION['success_page']);
            if($sid==1){
                $firstLine = "Złożono zamówienie";
                $secondLine = "pomyślnie!";
            }
            $this->view('success_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            header("Refresh: 0.75; url=" . ROOT . "/store/" . $path);
        }
        else header("Location:" . ROOT . "");
    }

    /** Main page of store
     * 
     */
    public function index(){
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
        $siteName = $this->getSiteName($db);

        isset($_POST['limit1']) ? $limit1 = $_POST['limit1'] : $limit1=1;

        $search = '';
        $endofitems=0;
        if(isset($_POST['search']))
            $search = $_POST['search'];

        if(isset($_POST['page'])){
            $limit1 = $_POST['page'];
        }

        $sortValue=0;
        $sortValueQuery="";
        if(isset($_POST['sortValue'])){
            $sortValue=$_POST['sortValue']; 
        }
        if($sortValue==0){
            $sortValueQuery = " ORDER BY i.id DESC";
        }
        if($sortValue==1){
            $sortValueQuery = " ORDER BY i.id DESC";
        }
        if($sortValue==2){
            $sortValueQuery = " ORDER BY i.id ASC";
        }
        if($sortValue==3){
            $sortValueQuery = " ORDER BY i.price ASC";
        }
        if($sortValue==4){
            $sortValueQuery = " ORDER BY i.price DESC";
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


        isset($_POST['pricepartstart']) ? $pricepartstart=$_POST['pricepartstart'] : $pricepartstart = "";
        isset($_POST['pricepartend']) ? $pricepartend=$_POST['pricepartend'] : $pricepartend = "";
        $querypricestartend = " ";
        if($pricepartstart != ""){
            $querypricestartend .= " AND i.price>=$pricepartstart ";
        }
        if($pricepartend != ""){
            $querypricestartend .= " AND i.price<=$pricepartend ";
        }
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
        
        $attrQuery = ' ';


        if (!empty($_POST['checkBoxVarAttributes']) && !empty($_POST['arrayOfAttrVal'])) 
        {
            $tableAttr = $_POST['checkBoxVarAttributes']; 
            $tableAttrValues = $_POST['arrayOfAttrVal'];
            $isItRange = $_POST['isItRange'];
            // zamienia tablice w jednego stringa
            // wystarczy dostarczyć tablice wypełnioną id producenta i polecenie sql działa

            $k = 0;
            for($j = 0; $j < count($attributes); $j++)
            {
                if(!isset($tableAttr[$k]))
                    break;
                if($tableAttr[$k]==$attributes[$j]['id']){
                    if($isItRange[$j] == 1){
                        $first = $tableAttrValues[$k];
                        $second = $tableAttrValues[$k];
                        $first = substr($first .'-', 0, strpos($first , '-'));
                        $second = substr($second, (strpos($second, '-') ?: 0) + 1);
                        $attrIdLoc = $tableAttr[$k];
                        if($first == "" && $second != ""){
                            $attrQuery .= "AND i.id IN (SELECT id_item FROM attributesofitems 
                            WHERE id_attribute=$attrIdLoc AND valuedecimal<=$second) ";
                        }else if($second == "" && $first != ""){
                            $attrQuery .= "AND i.id IN (SELECT id_item FROM attributesofitems 
                            WHERE id_attribute=$attrIdLoc AND valuedecimal>=$first) ";
                        }else if($first != "" && $second != ""){
                            $attrQuery .= "AND i.id IN (SELECT id_item FROM attributesofitems 
                            WHERE id_attribute=$attrIdLoc AND valuedecimal>=$first AND valuedecimal<=$second) ";
                        }
                    }else{
                        $tblAttrValue = $tableAttrValues[$k];
                        $attrIdLoc = $tableAttr[$k];
                        if($tblAttrValue != ""){
                            $attrQuery .= " AND i.id IN (SELECT id_item FROM attributesofitems 
                            WHERE id_attribute=$attrIdLoc AND value LIKE CONCAT('%', :tblAttrValue$attrIdLoc, '%')) ";
                        }
                    }
                    $k++; 
                }
            }
        }
        $itemsArr = array();
        if(!empty($manufacturers) && !empty($categories)){
            if($querySwitch){
                $query="SELECT i.name, i.id as itemID, price, m.name as 'name2', i.amount, i.price as itemPrice, i.amountComma as isDouble
                FROM items i 
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                INNER JOIN categoriesofitem coi ON i.id = coi.id_item
                INNER JOIN categories categ ON coi.id_category = categ.id
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1
                AND m.active=1
                AND m.id IN ($id_manufacturer)
                AND categ.id IN ($id_category) "
                . $querypricestartend  
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery .
                " LIMIT :limit1, 32";
            }else{
                $query="SELECT i.name, i.id as itemID, price, m.name as 'name2', i.amount, i.price as itemPrice, i.amountComma as isDouble
                FROM items i 
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                INNER JOIN categoriesofitem coi ON i.id = coi.id_item
                INNER JOIN categories categ ON coi.id_category = categ.id
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1
                AND m.active=1
                AND m.id IN ($id_manufacturer)
                AND categ.id IN ($id_category)
                AND catal.id IN ($id_catalog) "
                . $querypricestartend 
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery .
                " LIMIT :limit1, 32";
            }
            
            $itemsArr = $db->prepare($query);
            
            if (isset($_POST['checkBoxVarAttributes']) && isset($_POST['arrayOfAttrVal'])) 
            {
                $k=0;
                for($j = 0; $j < count($attributes); $j++)
                {
                    if(!isset($tableAttr[$k]))
                        break;
                    if($tableAttr[$k]==$attributes[$j]['id']){
                        if($isItRange[$j] == 0){
                            $attrIdLoc = $tableAttr[$k];
                            $tblAttrValue = $tableAttrValues[$k];
                            if($tblAttrValue != ""){
                                $itemsArr->bindParam(':tblAttrValue' . $attrIdLoc,$tblAttrValue);
                            }
                        }
                        $k++; 
                    }
                }
            }

            $itemsArr->bindParam(':limit1',$limit1);
            $itemsArr->bindParam(':search',$search);
            
            $itemsArr -> execute();
    
            $itemsArr = $itemsArr->fetchAll(PDO::FETCH_ASSOC);
    
            if($querySwitch){
                $query="SELECT COUNT(i.id) as c
                FROM items i 
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                INNER JOIN categoriesofitem coi ON i.id = coi.id_item
                INNER JOIN categories categ ON coi.id_category = categ.id
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1
                AND m.active=1
                AND m.id IN ($id_manufacturer)
                AND categ.id IN ($id_category) " 
                . $querypricestartend 
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery;
            }else{
                $query="SELECT COUNT(i.id) as c
                FROM items i 
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                INNER JOIN categoriesofitem coi ON i.id = coi.id_item
                INNER JOIN categories categ ON coi.id_category = categ.id
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1
                AND m.active=1
                AND m.id IN ($id_manufacturer)
                AND categ.id IN ($id_category)
                AND catal.id IN ($id_catalog) "
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery;
            }
         
            $numberOfItems = $db->prepare($query);
            
            if (isset($_POST['checkBoxVarAttributes']) && isset($_POST['arrayOfAttrVal'])) 
            {
                $k=0;
                for($j = 0; $j < count($attributes); $j++)
                {
                    if(!isset($tableAttr[$k]))
                        break;
                    if($tableAttr[$k]==$attributes[$j]['id']){
                        if($isItRange[$j] == 0){
                            $attrIdLoc = $tableAttr[$k];
                            $tblAttrValue = $tableAttrValues[$k];
                            if($tblAttrValue != ""){
                                $numberOfItems->bindParam(':tblAttrValue' . $attrIdLoc,$tblAttrValue);
                            }
                        }
                        $k++; 
                    }
                }
            }

            $numberOfItems->bindParam(':search',$search);

            $numberOfItems -> execute();
            $numberOfItems = $numberOfItems->fetchAll(PDO::FETCH_ASSOC);

            

            if(!empty($numberOfItems))
                $numberOfItems = sizeof($numberOfItems);
            if(!empty($numberOfItems))
                $numberOfPages = intdiv($numberOfItems, 32) + 1;
        
        }else{
            if($querySwitch){
                $query="SELECT i.name, i.id as itemID, price as 'name2', i.amount, i.price as itemPrice, i.amountComma as isDouble
                FROM items i 
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1 "
                . $querypricestartend  
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery .
                " LIMIT :limit1, 32";
            }else{
                $query="SELECT i.name, i.id as itemID, price as 'name2', i.amount, i.price as itemPrice, i.amountComma as isDouble
                FROM items i 
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1
                AND catal.id IN ($id_catalog) "
                . $querypricestartend 
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery .
                " LIMIT :limit1, 32";
            }

            $itemsArr = $db->prepare($query);
            
            if (isset($_POST['checkBoxVarAttributes']) && isset($_POST['arrayOfAttrVal'])) 
            {
                $k=0;
                for($j = 0; $j < count($attributes); $j++)
                {
                    if(!isset($tableAttr[$k]))
                        break;
                    if($tableAttr[$k]==$attributes[$j]['id']){
                        if($isItRange[$j] == 0){
                            $attrIdLoc = $tableAttr[$k];
                            $tblAttrValue = $tableAttrValues[$k];
                            if($tblAttrValue != ""){
                                $itemsArr->bindParam(':tblAttrValue' . $attrIdLoc,$tblAttrValue);
                            }
                        }
                        $k++; 
                    }
                }
            }

            $itemsArr->bindParam(':limit1',$limit1);
            $itemsArr->bindParam(':search',$search);
            
            $itemsArr -> execute();
    
            $itemsArr = $itemsArr->fetchAll(PDO::FETCH_ASSOC);
    
            if($querySwitch){
                $query="SELECT COUNT(i.id) as c
                FROM items i 
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1 " 
                . $querypricestartend 
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery;
            }else{
                $query="SELECT COUNT(i.id) as c
                FROM items i 
                LEFT OUTER JOIN attributesofitems aoi ON i.id = aoi.id_item 
                LEFT OUTER JOIN attributes attr ON aoi.id_attribute = attr.id 
                LEFT OUTER JOIN itemsincatalog iic ON i.id = iic.id_item
                LEFT OUTER JOIN catalog catal ON iic.id_catalog = catal.id
                WHERE i.name LIKE CONCAT('%', :search, '%')
                AND i.amount>0
                AND i.active=1
                AND catal.id IN ($id_catalog) "
                . $attrQuery .
                " GROUP BY i.id"
                . $sortValueQuery;
            }
         
            $numberOfItems = $db->prepare($query);

            if (isset($_POST['checkBoxVarAttributes']) && isset($_POST['arrayOfAttrVal'])) 
            {
                $k=0;
                for($j = 0; $j < count($attributes); $j++)
                {
                    if(!isset($tableAttr[$k]))
                        break;
                    if($tableAttr[$k]==$attributes[$j]['id']){
                        if($isItRange[$j] == 0){
                            $attrIdLoc = $tableAttr[$k];
                            $tblAttrValue = $tableAttrValues[$k];
                            if($tblAttrValue != ""){
                                $numberOfItems->bindParam(':tblAttrValue' . $attrIdLoc,$tblAttrValue);
                            }
                        }
                        $k++; 
                    }
                }
            }

            $numberOfItems->bindParam(':search',$search);

            $numberOfItems -> execute();
            $numberOfItems = $numberOfItems->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($numberOfItems))
                $numberOfItems = sizeof($numberOfItems);
            if(!empty($numberOfItems))
                $numberOfPages = intdiv($numberOfItems, 32) + 1;
        }

       
        $this->view('store/index', ['itemsArray'=>$itemsArr, 'search' => $search, 'limit1' => $page, 
            'manufacturersArray' => $manufacturers, 'last'=> $endofitems,
            'test' => $id_manufacturer, 'siteFooter' => $siteFooter, 'isLogged' => $isLogged, 
            'loggedUser_name' => $loggedUser_name, 'categoriesArray'=>$categories, 'catalogsArray'=>$catalogs, 
            'attributesArray'=>$attributes, 'numberOfPages' => $numberOfPages, 'numberOfItems' => $numberOfItems, 
            'pricepartstart' => $pricepartstart, 'pricepartend' => $pricepartend, 'siteName' => $siteName, 
            'sortValue' =>$sortValue]); // ten 'test' to do wywalenia na koniec
            
    }

    /** This function view items in card for a logged user
     */
    public function cart(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);       
        $siteName = $this->getSiteName($db);

        $itemsInCart = NULL;
        if(isset($_COOKIE['itemsInCart']) && $_COOKIE['itemsInCart'] != ''){
            $query="SELECT i.name, i.id as itemID, m.name as 'name2', i.price as itemPrice
                FROM items i 
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                WHERE i.id IN (".rtrim($_COOKIE['itemsInCart'],',').")
                AND i.active=1 AND m.active=1";


            $itemsInCart = $db->query($query);
            $itemsInCart = $itemsInCart->fetchAll(PDO::FETCH_ASSOC);
        }
     
        $this->view('store/cart', ['siteFooter' => $siteFooter, 'siteName' => $siteName, 'itemsArray'=>$itemsInCart, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]);
    }

    /** This function get footer elements from the database
     * 
     */
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

    // this funtcion get store name from the database
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

    /** This function show detalis about item from the database
     * @param {int} is the id of item
     */
    public function item($id=NULL){
        if($id==NULL){
            header("Location:" . ROOT . "/store");
            return;
        }
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);    
        $siteName = $this->getSiteName($db);

        $query="SELECT i.price as price, i.name as name, i.amount as amount, m.name as manname, i.amountComma as isDouble
        FROM items i
        INNER JOIN manufacturercountries mc on i.id_manufacturercountry=mc.id
        INNER JOIN manufacturers m on m.id=mc.id_manufacturer
        WHERE i.id=:id";

        $itemParams = $db->prepare($query);
        $itemParams -> bindParam(':id',$id);
        $itemParams -> execute();
        $itemParams = $itemParams->fetch(PDO::FETCH_ASSOC);


        $query="SELECT d.title, d.description FROM items i
        INNER JOIN descriptions d ON i.id=d.id_item
        WHERE i.id=:id";

        $itemDescrs = $db->prepare($query);
        $itemDescrs -> bindParam(':id',$id);
        $itemDescrs -> execute();
        $itemDescrs = $itemDescrs->fetchAll(PDO::FETCH_ASSOC);


        $query="SELECT aoi.value as attrValue, a.name as attrName FROM items i
        INNER JOIN attributesofitems aoi ON i.id=aoi.id_item
        INNER JOIN attributes a ON a.id=aoi.id_attribute
        WHERE i.id=:id";

        $itemAttrs = $db->prepare($query);
        $itemAttrs -> bindParam(':id',$id);
        $itemAttrs -> execute();
        $itemAttrs = $itemAttrs->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('store/item', ['id' => $id, 'siteFooter' => $siteFooter, 'siteName' => $siteName, 
        'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name, 'itemParams' => $itemParams, 
        'itemDescrs' => $itemDescrs, 'itemAttrs' => $itemAttrs]);
    }


    /** This function show order history for a logged user. Orders are in database
     */
    public function order_history(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);   
        $siteName = $this->getSiteName($db);

        isset($_SESSION['loggedUser_id']) ? $id_user=$_SESSION['loggedUser_id'] : $id_user = 0;
        $query="SELECT o.*, sm.name as smName FROM orders o INNER JOIN shippingmethods sm 
        ON o.id_shippingmethod=sm.id WHERE id_user=:id_user";
        $orders = $db->prepare($query);
        $orders->bindParam(':id_user', $id_user);
        $orders->execute();
        $orders = $orders->fetchAll(PDO::FETCH_ASSOC);
        

        
        $this->view('store/order_history', ['ordersArray'=>$orders, 'siteName' => $siteName, 
        'siteFooter' => $siteFooter, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name]);
    }

    /** Thus functon show order summary
     * it allows the user to confirm order
     * oredr will be insert into database
     */
    public function summary(){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);   
        $siteName = $this->getSiteName($db);

        if(!empty($_POST['payment'])){
            if(!empty($_POST['country'])){
            $query="INSERT INTO orders (id_user, id_shippingmethod, id_paymentmethod, orderstate, trackingnumber, 
            ordercountry, ordervoivodeship, ordercity, orderpostcode, orderstreet, orderhomenumber, 
            orderphonenumber, ordername, orderlastname, price)
            VALUES ('".$_SESSION['idLoggedUser']."', '".$_POST['delivery']."', '".$_POST['payment']."',
             'Do akceptacji', '123456789', :country, :voivodeship, :city, :postcode, :street, :homeNumber, :phoneNumber, 
             :orderName, :orderLastname, '".$_SESSION['totalOrderPrice']."')";
            
            $order = $db->prepare($query);
            $order->bindParam(':country', $_POST['country']);
            $order->bindParam(':voivodeship', $_POST['voivoden']);
            $order->bindParam(':city', $_POST['city']);
            $order->bindParam(':postcode', $_POST['postcode']);
            $order->bindParam(':street', $_POST['street']);
            $order->bindParam(':homeNumber', $_POST['housenumber']);
            $order->bindParam(':phoneNumber', $_POST['phonenumber']);
            $order->bindParam(':orderName', $_POST['name']);
            $order->bindParam(':orderLastname', $_POST['surname']);
            $order -> execute();
            }
            else{
                $query="INSERT INTO orders (id_user, id_shippingmethod, id_paymentmethod, orderstate, price)
                VALUES ('".$_SESSION['idLoggedUser']."', '".$_POST['delivery']."', '".$_POST['payment']."',
                 'Zaraz Bedzie', '".$_SESSION['totalOrderPrice']."')";
                $db->query($query);
            }

            $query="SELECT id FROM orders ORDER BY id DESC LIMIT 1";
            $lastOrder = $db->query($query);
            $lastOrder = $lastOrder->fetchAll(PDO::FETCH_ASSOC);

            foreach($_SESSION['idOfItems'] as $j => $itemId) {
                $query="INSERT INTO itemsinorder (id_item, id_order, amount)
                VALUES ('$itemId', '{$lastOrder[0]['id']}', '{$_SESSION['numberOfItems'][$j]}')";

                $query2 = "UPDATE items SET amount = amount-{$_SESSION['numberOfItems'][$j]}
                            WHERE id='$itemId'";

                $db->query($query2);
                $db->query($query);
              }

            unset($_SESSION['idOfItems']);
            unset($_SESSION['numberOfItems']);
            unset($_SESSION['totalItemPrice']);

            $_SESSION['success_page'] = "index";
            header("Location:" . ROOT . "/store/success_page/1");
            return;
        }

        $itemsInCart = NULL;
        if(!isset($_SESSION['numberOfItems'])){
            $_SESSION['numberOfItems'] = array();
            $_SESSION['totalItemPrice'] = array();
            $_SESSION['idOfItems'] = array();
        }
        
        if(isset($_COOKIE['itemsInCart']) && $_COOKIE['itemsInCart'] != ''){
            $_SESSION['totalOrderPrice'] = 0;
            $query="SELECT i.name, i.id as itemID, m.name as 'name2', i.price as itemPrice
                FROM items i 
                INNER JOIN manufacturercountries ms ON ms.id=i.id_manufacturercountry
                INNER JOIN manufacturers m ON m.id=ms.id_manufacturer
                WHERE i.id IN (".rtrim($_COOKIE['itemsInCart'],',').") AND active=1";

            $itemsInCart = $db->query($query);
            $itemsInCart = $itemsInCart->fetchAll(PDO::FETCH_ASSOC);
            

            $query2="SELECT paymentmethods.id as methodId, paymenttypes.name as typeName, paymentmethods.name as methodName, fee
                    FROM paymentmethods 
                    LEFT JOIN paymenttypes 
                    ON paymentmethods.id_type = paymenttypes.id
                    WHERE active=1";

            $paymentmethods = $db->query($query2);
            $paymentmethods = $paymentmethods->fetchAll(PDO::FETCH_ASSOC);

            $query3="SELECT id, name, price, needaddress
                    FROM shippingmethods WHERE active=1";

            $shippingmethods = $db->query($query3);
            $shippingmethods = $shippingmethods->fetchAll(PDO::FETCH_ASSOC);

            
            $i = 0;
            foreach($_POST as $key => $value){
                if(is_numeric($key)){
                    $_SESSION['idOfItems'][$i] = $key;
                    $_SESSION['numberOfItems'][$i] = $value;
                    $_SESSION['totalItemPrice'][$i] = $itemsInCart[$i]['itemPrice'] * $value;
                    $i++;
                }
            }
            foreach($_SESSION['totalItemPrice'] as $i => $value){
                $_SESSION['totalOrderPrice'] += $value;
            }

        }else{
            header("Location:" . ROOT . "/store/cart");
            return;
        }



        $this->view('store/summary', ['siteFooter' => $siteFooter, 'siteName' => $siteName, 
        'paymentmethods' => $paymentmethods, 'shippingmethods' => $shippingmethods, 
        'itemsArray'=>$itemsInCart, 'isLogged' => $isLogged, 'loggedUser_name' => $loggedUser_name,]);
    }

    /** This function views details about order  from the database
     * @param {int} is the id of order
     */
    public function orderview($order_id){
        isset($_SESSION['loggedUser']) ? $isLogged = true :  $isLogged = false; 
        isset($_SESSION['loggedUser_name']) ? $loggedUser_name = $_SESSION['loggedUser_name'] : $loggedUser_name = "";
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);   
        $siteName = $this->getSiteName($db);

        $itemsInOrder = NULL;

        $o_id = $order_id;

        if(!is_numeric($order_id))
            $o_id  = 0;
        
        isset($_SESSION['loggedUser_id']) ? $id_user=$_SESSION['loggedUser_id'] : $id_user = 0;
        
        $query="SELECT i.id as itemID, iio.amount as itemAmount, i.price as itemPrice, i.name as itemName, m.name as itemManName
        FROM orders o 
        INNER JOIN itemsinorder iio ON o.id=iio.id_order 
        INNER JOIN items i ON iio.id_item=i.id
        INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
        INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
        WHERE o.id=:id_order AND id_user=:id_user";

        $itemsInOrder = $db->prepare($query);
        $itemsInOrder->bindParam(':id_user',$id_user);
        $itemsInOrder->bindParam(':id_order', $o_id);
        $itemsInOrder->execute();
        $itemsInOrder = $itemsInOrder->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT o.orderdate as orderDate, sm.name as shippingName, sm.price as shippingPrice, sm.needAddress as needAddress,
        pm.name as paymentName, pm.fee as paymentFee, o.price as orderPrice, o.*
        FROM orders o 
        INNER JOIN itemsinorder iio ON o.id=iio.id_order 
        INNER JOIN items i ON iio.id_item=i.id
        INNER JOIN shippingmethods sm ON o.id_shippingmethod=sm.id
        INNER JOIN paymentmethods pm ON o.id_paymentmethod=pm.id
        WHERE o.id=:id_order AND id_user=:id_user";

        $result = $db->prepare($query);
        $result->bindParam(':id_user',$id_user);
        $result->bindParam(':id_order', $o_id);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);

        $totalOrderPrice = $result['orderPrice'] +  $result['shippingPrice'] + $result['paymentFee'];

        if(empty($itemsInOrder) || empty($result)){
            header("Location:" . ROOT . "/store");
            return;
        }

        $this->view('store/orderview', ['siteFooter' => $siteFooter, 'siteName' => $siteName,
        'itemsArray'=>$itemsInOrder, 'isLogged' => $isLogged,
        'loggedUser_name' => $loggedUser_name, 'orderInfo' => $result, 'totalOrderPrice'=>$totalOrderPrice]);
 
    }


}

?>