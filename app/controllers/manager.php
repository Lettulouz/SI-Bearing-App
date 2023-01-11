<?php

use PHPMailer\PHPMailer\PHPMailer;

class Manager extends Controller
{

    /** This function display information, if element was succesful added to the database
     * @param {int} is the id of message
     */
    public function success_page($sid){     
        if(isset($_SESSION['success_page'])){
            $path = $_SESSION['success_page'];
            unset($_SESSION['success_page']);
            if($sid==1){
                $firstLine = "Dodano rekord";
                $secondLine = "pomyślnie!";
            }
            else if($sid==2){
                $firstLine = "Edytowano rekord";
                $secondLine = "pomyślnie!";
            }
            else if($sid==3){
                $firstLine = "Usunięto rekord";
                $secondLine = "pomyślnie!";
            }
            $this->view('success_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            header("Refresh: 2; url=" . ROOT . "/manager/" . $path);
        }
        else header("Location:" . ROOT . "");
    }

    /** This function display information, if element was not succesful added to the database
     * @param {int} is the id of message
     */
    public function error_page($sid){     
        if(isset($_SESSION['error_page'])){
            $path = $_SESSION['error_page'];
            unset($_SESSION['error_page']);
            if($sid==1){
                $firstLine = "Nie podano wszystkich wymaganych wartości";
                $secondLine = "";
            }
            else if($sid==2){
                $firstLine = "Taki rekord już istnieje";
                $secondLine = "";
            }
            else if($sid==3){
                $firstLine = "Błąd dodawania zdjęcia";
                $secondLine = "";
            }
            $this->view('error_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            $_SESSION['successOrErrorResponse'] = $path;
            header("Refresh: 2; url=" . ROOT . "/manager/" . $path);

        }
        else header("Location:" . ROOT . "");
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////SPECIAL PAGES//////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    public function edit_page($id=0){ 
        if($id<1 || $id>9){
            header("Location:" . ROOT . "/manager");
        }
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        $pageNames=array();
        $pageNames[1]=$siteLink['c1r1'];
        $pageNames[2]=$siteLink['c1r2'];
        $pageNames[3]=$siteLink['c1r3'];
        $pageNames[4]=$siteLink['c1r4'];
        $pageNames[5]=$siteLink['c2r1'];
        $pageNames[6]=$siteLink['c2r2'];
        $pageNames[7]=$siteLink['c2r3'];
        $pageNames[8]=$siteLink['c2r4'];
        $pageNames[9]="Dolny tekst";

        if(isset($_POST['submitButton'])){
            $query="SELECT EXISTS(SELECT * FROM pages WHERE id=$id) as ex";
            $result = $db->query($query);
            $checkIfExistsInDB = $result->fetch(PDO::FETCH_ASSOC);
            $checkIfExistsInDB = $checkIfExistsInDB['ex'];
            $submittedContent = $_POST['editor'];

            if($checkIfExistsInDB == 1){
                $query="UPDATE pages SET content=:content WHERE id=$id";
                $result = $db->prepare($query);
                $result->bindParam(':content', $submittedContent);
                $result->execute();
            }else{
                $query="INSERT INTO pages (id, content) VALUES ($id,:content)";
                $result = $db->prepare($query);
                $result->bindParam(':content', $submittedContent);
                $result->execute();
            }
        }

        $query="SELECT content FROM pages WHERE id=$id";
        $result = $db->prepare($query);
        $result->execute();
        $pageContent = $result->fetch(PDO::FETCH_ASSOC);
        !empty($pageContent) ? $pageContent = $pageContent['content'] : $pageContent = "";    

        $this->view('manager/edit_page', ['pageNames'=>$pageNames,'siteLinks'=>$siteLink,'editingId' => $id,'storedValue' => $pageContent]);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////MAIN///////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /** Main page of manager panel
     * 
     */
    public function index(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);

        ///////////////////////////////////

        $query="SELECT i.name AS item, m.name AS manufacturer
        FROM items i 
            INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
            INNER JOIN manufacturers m ON m.id=mc.id_manufacturer WHERE i.active=1 LIMIT 5";
        $result = $db->query($query);
        $items = $result->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT Count(name)
        FROM `items` WHERE active=1";
        $result = $db->query($query);
        
        $itemsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        $itemsCount = $itemsCount[0]['Count(name)'];

        $query="SELECT name
        FROM catalog LIMIT 5";
        $result = $db->query($query);
        $catalogs = $result->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT Count(name)
        FROM `catalog`";
        $result = $db->query($query);
        
        $catalogsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        $catalogsCount = $catalogsCount[0]['Count(name)'];

        $query="SELECT name
        FROM attributes LIMIT 5";
        $result = $db->query($query);
        $attributes = $result->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT Count(name)
        FROM attributes";
        $result = $db->query($query);
        
        $attributesCount = $result->fetchAll(PDO::FETCH_ASSOC);
        $attributesCount = $attributesCount[0]['Count(name)'];

        $query="SELECT name
        FROM manufacturers LIMIT 5";
        $result = $db->query($query);
        $manufacturers = $result->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT Count(name)
        FROM manufacturers";
        $result = $db->query($query);
        
        $manufacturersCount = $result->fetchAll(PDO::FETCH_ASSOC);
        $manufacturersCount = $manufacturersCount[0]['Count(name)'];

        $query="SELECT name
        FROM categories LIMIT 5";
        $result = $db->query($query);
        
        $categories = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $query="SELECT Count(name)
        FROM categories";
        $result = $db->query($query);
        
        $categoriesCount = $result->fetchAll(PDO::FETCH_ASSOC);
        $categoriesCount = $categoriesCount[0]['Count(name)'];

        $query="SELECT GROUP_CONCAT(name SEPARATOR ', ') as shippingMethodsString FROM shippingmethods WHERE active=1";
        $result = $db->query($query);
        
        $shippingMethodsString = $result->fetch(PDO::FETCH_ASSOC);
        $shippingMethodsString = $shippingMethodsString['shippingMethodsString'];
        
        $query="SELECT Count(name) as c
        FROM shippingmethods WHERE active=1";
        $result = $db->query($query);
        
        $shippingMethodsCount = $result->fetch(PDO::FETCH_ASSOC);
        $shippingMethodsCount = $shippingMethodsCount['c'];

        $query="SELECT GROUP_CONCAT(name SEPARATOR ', ') as paymentMethodsString FROM paymentmethods WHERE active=1";
        $result = $db->query($query);
        
        $paymentMethodsString = $result->fetch(PDO::FETCH_ASSOC);
        $paymentMethodsString = $paymentMethodsString['paymentMethodsString'];
        
        $query="SELECT Count(name) as c
        FROM paymentmethods WHERE active=1";
        $result = $db->query($query);
        
        $paymentMethodsCount = $result->fetch(PDO::FETCH_ASSOC);
        $paymentMethodsCount = $paymentMethodsCount['c'];

        $this->view('manager/index', ['siteLinks'=>$siteLink ,'items'=>$items, 'itemsCount'=>$itemsCount, 'catalogs'=>$catalogs, 
        'catalogsCount'=>$catalogsCount, 'attributes'=>$attributes, 'attributesCount'=>$attributesCount, 'manufacturers'=>$manufacturers, 
        'manufacturersCount'=>$manufacturersCount,'categories'=>$categories, 'categoriesCount'=>$categoriesCount, 
        'shippingMethodsString' => $shippingMethodsString, 'shippingMethodsCount' => $shippingMethodsCount, 
        'paymentMethodsCount' => $paymentMethodsCount,'paymentMethodsString' => $paymentMethodsString]);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////ATTRIBUTES////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /** This function viev atributes form the database
     */
    public function list_of_attributes()
    {
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);

        $query="SELECT * FROM `attributes` ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);    

        $rmAttrPath=ROOT."/manager/remove_attribute";
        $editAttrPath=ROOT."/manager/edit_attribute";
        $this->view('manager/list_of_attributes', ['siteLinks'=>$siteLink,'attributesArray'=>$result, 'rmpath'=> $rmAttrPath, 'editpath'=> $editAttrPath]);
    }

    /** This function edit attribute from the database
     * @param {int} is the id of attribute
     */
    public function edit_attribute($id_a=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 
        
        if(isset($id_a)){
        isset($_POST['edit_atr']) ? $attribute=$_POST['edit_atr'] : $attribute="";
            if(!empty($attribute)){
                require_once dirname(__FILE__,2) . '/core/database.php';
                $tekst1 = strtolower($attribute);
                $tekst2 = ucfirst($tekst1);
                isset($_POST['attributeUnit']) ? $attributeUnit = $_POST['attributeUnit'] : $attributeUnit="";
                
                $query="SELECT id, COUNT(id) FROM attributes WHERE name=:attr";
                $result = $db->prepare($query);
                $result->bindParam(':attr', $attribute);
                $result->execute();
                $attr_id=$result->fetch(PDO::FETCH_ASSOC);
                $temp = $attr_id['COUNT(id)'];
                if($temp>0&&$attr_id['id']!=$id_a){
                    $_SESSION['error_page'] = "list_of_attributes";
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query = "UPDATE `attributes` 
                        SET name = '$tekst2',
                        unit='$attributeUnit',
                        WHERE id = '$id_a';";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "list_of_attributes";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }

            }else{
                $_SESSION['error_page'] = "list_of_attributes";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }else{
            header("Location:" . ROOT . "/manager/list_of_attributes");
        }
    }

    /** This function remove attribute from the database
     * @param {int} is the id of attribute
     */
    public function remove_attribute($id_a=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        if(isset($id_a)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="DELETE FROM attributes WHERE id=:id_a";
            $result = $db->prepare($query);
            $result->bindParam(':id_a', $id_a);
            $result->execute();
        }
    
        header("Location:" . ROOT . "/manager/list_of_attributes");
    }

    /** This function remove item from the database
     * @param {int} is the id of item
     */
    public function remove_item($id_a=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        if(isset($id_a)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="UPDATE items SET active=0 WHERE id=:id_a";
            $result = $db->prepare($query);
            $result->bindParam(':id_a', $id_a);
            $result->execute();

            $imagePathCheck = PHOTOSPATH . "/[" . $id_a. "].png";

            if(file_exists($imagePathCheck)) unlink($imagePathCheck);
        }
    
        header("Location:" . ROOT . "/manager/list_of_items");
    }

    /** This function add attribute to the database
     */
    public function add_attribute(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 

        require_once dirname(__FILE__,2) . '/core/database.php';

        $attributeName = "";
        $attributeUnit = "";
        $attributeRange = "";
        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_attribute"){
                if(isset($_SESSION['attributeName'])) {$attributeName = $_SESSION['attributeName']; unset($_SESSION['attributeName']);} 
                if(isset($_SESSION['attributeUnit'])) {$attributeUnit = $_SESSION['attributeUnit']; unset($_SESSION['attributeUnit']);} 
                if(isset($_SESSION['attributeRange'])) {$attributeRange = $_SESSION['attributeRange']; unset($_SESSION['attributeRange']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        if(isset($_POST['attrEditSub'])){
            if(isset($_POST['attributeName'])) $_SESSION['attributeName'] = $_POST['attributeName'];
            if(isset($_POST['attributeUnit'])) $_SESSION['attributeUnit'] = $_POST['attributeUnit'];
            if(isset($_POST['attributeRange'])) $_SESSION['attributeRange'] = $_POST['attributeRange'];

            if(!empty($_POST['attributeName'])){
            
                $attributeName = $_POST['attributeName'];
                isset($_POST['attributeUnit']) ? $attributeUnit = $_POST['attributeUnit'] : $attributeUnit="";
                isset($_POST['attributeRange']) ? $attributeRange = 1 : $attributeRange = 0;
                
                $attributeName = strtolower($attributeName);
                $attributeName = ucfirst($attributeName);

                $query="SELECT COUNT(id) as amount
                FROM attributes WHERE name=:name";
                $result = $db->prepare($query);
                $result->bindParam(':name', $attributeName);
                $result->execute(); 
                $result = $result->fetch(PDO::FETCH_ASSOC);
                if($result['amount']>0){
                    $_SESSION['error_page'] = "add_attribute";
                    $_SESSION['attributeName'] = $attributeName;
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query = "INSERT INTO attributes (name, unit, isrange) VALUES ('$attributeName', '$attributeUnit', '$attributeRange');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "add_attribute";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_attribute";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }else{
        $this->view('manager/add_attribute_manager', ['siteLinks'=>$siteLink,'attributeName' => $attributeName, 
        'attributeUnit' => $attributeUnit, 'attributeRange' => $attributeRange]);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////CATALOGS//////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /** This function add catalog to the database
     */
    public function add_catalog(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);

        $catname = "";
        $itemstocat = "";

        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_catalog"){
                if(isset($_SESSION['catname'])) {$catname = $_SESSION['catname']; unset($_SESSION['catname']);} 
                if(isset($_SESSION['itemcat'])) {$itemstocat = $_SESSION['itemcat']; unset($_SESSION['itemcat']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        $return_msg_color="";
        $return_msg="";
        if(isset($_POST['catsubmit'])){
            isset($_POST['itemcat']) ? $itemstocat=$_POST['itemcat'] : $itemstocat="";
            isset($_POST['catname']) ? $catname=$_POST['catname'] : $catname="";
            $_SESSION['catname'] = $catname;
            $_SESSION['itemcat'] = $itemstocat;


            if(isset($_POST['itemcat'])&&!empty($_POST['catname'])){
                //add catalog to database
                $query="SELECT COUNT(id) FROM catalog WHERE name=:catname";
                $result = $db->prepare($query);
                $result->bindParam(':catname', $catname);
                $result->execute();
                $cat_id=$result->fetch(PDO::FETCH_ASSOC);
                $temp = $cat_id['COUNT(id)'];
                if($temp>0){
                    $_SESSION['error_page'] = "add_catalog";
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query="INSERT INTO catalog (name) VALUES (:cat_name)";
                    $result = $db->prepare($query);
                    $result->bindParam(':cat_name',$catname);
                    $result->execute();
                    //get catalog id
                    $query="SELECT id FROM catalog WHERE name=:catname ORDER BY id DESC LIMIT 1";
                    $result = $db->prepare($query);
                    $result->bindParam(':catname', $catname);
                    $result->execute();
                    $cat_id=$result->fetch(PDO::FETCH_ASSOC);
                    //connect items with catalog
                    $query="INSERT INTO itemsincatalog (id_catalog,id_item) VALUES (:cat_id,:item_id)";
                    foreach ($itemstocat as $item_id){
                        $result = $db->prepare($query);
                        $result->bindParam(':cat_id',$cat_id['id']);
                        $result->bindParam(':item_id',$item_id);
                        $result->execute();
                    }
                    $_SESSION['success_page'] = "add_catalog";
                    unset($_SESSION['catname']);
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_catalog";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }

        $query="SELECT i.name AS item, i.id AS item_id, m.name AS mnf,
        c.name AS  mnfCountry FROM items i 
        INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
        INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
        INNER JOIN countries c ON mc.id_country=c.id";
        $result = $db->prepare($query);
        $result->execute();
        $items = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('manager/add_catalog_manager', ['siteLinks'=>$siteLink,'items'=>$items, 'msg_color' => $return_msg_color , 'msg' => $return_msg, 'catname' => $catname, 'itemcat'=> $itemstocat]);
    }

    /** This function view catalogs from the database
     */
    public function list_of_catalogs(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        
        if(isset($_POST['catEditSub'])){
            isset($_POST['itemcat']) ? $itemstocat=$_POST['itemcat'] : $itemstocat="";
            isset($_POST['catname']) ? $catname=$_POST['catname'] : $catname="";
            isset($_POST['catid']) ? $catid=$_POST['catid'] : $catid="";

            if(isset($_POST['itemcat'])&&!empty($_POST['catname'])){
                    //update catalog name
                    $query="SELECT id, COUNT(id) FROM catalog WHERE name=:catname";
                    $result = $db->prepare($query);
                    $result->bindParam(':catname', $catname);
                    $result->execute();
                    $cat_id=$result->fetch(PDO::FETCH_ASSOC);
                    $temp = $cat_id['COUNT(id)'];

                    //check if catalog name is already use by different catalog
                    if($temp>0&&$cat_id['id']!=$catid){
                        $_SESSION['error_page'] = "list_of_catalogs";
                        header("Location:" . ROOT . "/manager/error_page/2");
                    }else{
                        $query="UPDATE catalog SET name=:catname WHERE id=:catid";
                        $result = $db->prepare($query);
                        $result->bindParam(':catname',$catname);
                        $result->bindParam(':catid',$catid);
                        $result->execute();

                        //delete old items and add new to catalog
                        $query="DELETE FROM itemsincatalog WHERE id_catalog=:catid";
                        $result = $db->prepare($query);
                        $result->bindParam(':catid',$catid);
                        $result->execute();

                        $query="INSERT INTO itemsincatalog (id_catalog,id_item) VALUES (:cat_id,:item_id)";
                        foreach ($itemstocat as $item_id){
                            $result = $db->prepare($query);
                            $result->bindParam(':cat_id',$catid);
                            $result->bindParam(':item_id',$item_id);
                            $result->execute();
                            }
                        $_SESSION['success_page'] = "list_of_catalogs";
                        header("Location:" . ROOT . "/manager/success_page/1");
                    }
                }else{
                    $_SESSION['error_page'] = "list_of_catalogs";
                    header("Location:" . ROOT . "/manager/error_page/1");
                }
            } 

        $query="SELECT c.name, COUNT(iic.id_catalog) as amount, c.id
        FROM catalog c LEFT JOIN itemsInCatalog iic ON c.id=iic.id_catalog GROUP BY c.id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        $queryIt="SELECT i.name AS item, i.id AS item_id, m.name AS mnf,
        c.name AS  mnfCountry
        FROM items i
        INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
        INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
        INNER JOIN countries c ON mc.id_country=c.id";
        $resultIt = $db->prepare($queryIt);
        $resultIt->execute();
        $items = $resultIt->fetchAll(PDO::FETCH_ASSOC);

        $itemsInCat=array();

        foreach($result as $res){
            $query_items="SELECT catalog.id AS cat_id, itemsincatalog.id_item AS id_item,
            i.name AS name_item, i.amount AS amount, i.price AS price,
            m.name AS mn_name, c.name AS mn_country
            FROM catalog 
                INNER JOIN itemsincatalog ON itemsincatalog.id_catalog = catalog.id 
                INNER JOIN items i ON itemsincatalog.id_item = i.id 
                INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
                INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
                INNER JOIN countries c ON mc.id_country=c.id
                WHERE catalog.id =:catid";
                $result_id = $db->prepare($query_items);
                $result_id->bindParam(':catid', $res['id']);
                $result_id->execute();
                $result_id =  $result_id->fetchAll(PDO::FETCH_ASSOC);
                $itemsInCat[$res['id']]= $result_id;
        }
 
        $rmCatPath=ROOT."/manager/";

        $this->view('manager/list_of_catalogs', ['siteLinks'=>$siteLink,'catalogsArray'=>$result, 'catalogsItems'=>$itemsInCat,'items'=>$items ,'rmpath'=> $rmCatPath]);
    }

    /** This function remove catalog from the database
     * @param {int} is the id of catalog
     */
    public function remove_catalog($cid=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        if(isset($cid)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="DELETE FROM catalog WHERE id=:cid";
            $result = $db->prepare($query);
            $result->bindParam(':cid', $cid);
            $result->execute();
        }
        header("Location:" . ROOT . "/manager/list_of_catalogs");
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////MANUFACTURERS/////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /** This function add manufacturer to the database
     */
    public function add_manufacturer(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        $manufacturerName = "";
        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_manufacturer"){
                if(isset($_SESSION['manufacturerName'])) {$manufacturerName = $_SESSION['manufacturerName']; unset($_SESSION['manufacturerName']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        if(isset($_POST['attrEditSub'])){
            if(!empty($_POST['manufacturer'])){      
                $manufacturerName = $_POST['manufacturer'];

                $query="SELECT COUNT(id) as amount
                FROM manufacturers WHERE name=:name";
                $result = $db->prepare($query);
                $result->bindParam(':name', $manufacturerName);
                $result->execute();
                $result = $result->fetch(PDO::FETCH_ASSOC);
                if($result['amount']>0){
                    $_SESSION['error_page'] = "add_manufacturer";
                    $_SESSION['manufacturer'] = $manufacturerName;
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query = "INSERT INTO `manufacturers` (name) VALUES ('$manufacturerName');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "add_manufacturer";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_manufacturer";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }else{
            $this->view('manager/add_manufacturer_manager', ['siteLinks'=>$siteLink,'manufacturer' => $manufacturerName]);
        }
    }

    /** This function add countries to manufacturer in the database
     */
    public function add_countries_to_manufacturer(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        $manufacturername = "";
        $selCountries = "";
        $selManufacturer = "";

        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_countries_to_manufacturer"){
                if(isset($_SESSION['manufacturername'])) {$manufacturername = $_SESSION['manufacturername']; unset($_SESSION['manufacturername']);} 
                if(isset($_SESSION['selCountries'])) {$selCountries = $_SESSION['selCountries']; unset($_SESSION['selCountries']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        $return_msg_color="";
        $return_msg="";
        if(isset($_POST['manufsubmit'])){
            isset($_POST['selCountries']) ? $selCountries=$_POST['selCountries'] : $selCountries=array();
            isset($_POST['manufacturerid']) ? $manufacturerid=$_POST['manufacturerid'] : $manufacturerid="";
            $_SESSION['manufacturerid'] = $manufacturerid;
            $_SESSION['selCountries'] = $selCountries;
            $countryArray = array();

            if(isset($_POST['selCountries'])&&!empty($_POST['manufacturerid'])){

                $queryI="INSERT INTO manufacturercountries (id_manufacturer,id_country) VALUES (:mnf_id,:ctr_id)";
                foreach ($selCountries as $country){
                    array_push($countryArray, $country);
                    $query="SELECT COUNT(id) FROM manufacturercountries WHERE id_manufacturer=:id_manufacturer AND id_country=:id_country";
                    $result = $db->prepare($query);
                    $result->bindParam(':id_manufacturer',$manufacturerid);
                    $result->bindParam(':id_country',$country);
                    $result->execute();
                    $mnf_id=$result->fetch(PDO::FETCH_ASSOC);
                    if($mnf_id['COUNT(id)']>0)
                        continue;
                    $result = $db->prepare($queryI);
                    $result->bindParam(':mnf_id',$manufacturerid);
                    $result->bindParam(':ctr_id',$country);
                    $result->execute();
                }
                $query="SELECT id, id_country FROM manufacturercountries WHERE id_manufacturer=:id_manufacturer";
                $result = $db->prepare($query);
                $result->bindParam(':id_manufacturer',$manufacturerid);
                $result->execute();
                $arr=$result->fetchAll(PDO::FETCH_ASSOC);   
                $i=0;
                foreach($arr as $element){
                    if(in_array(strval($element['id_country']), $countryArray)){
                        print_r('jest');
                    }else{
                        $query="DELETE FROM manufacturercountries WHERE id=:id";
                        $result = $db->prepare($query);
                        $result->bindParam(':id',$arr[$i]['id']);
                        $result->execute();
                    }        
                    $i++;
                } 
                $_SESSION['success_page'] = "add_manufacturer";
                unset($_SESSION['manufacturername']);
                header("Location:" . ROOT . "/manager/success_page/1");
                
            }
            else{
                $_SESSION['error_page'] = "add_countries_to_manufacturer";
                header("Location:" . ROOT . "/manager/error_page/1");
            }

        }

        $query="SELECT id as countryid, name as countryname FROM countries ORDER BY countryname";
        $result = $db->prepare($query);
        $result->execute();
        $countries = $result->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT * FROM `manufacturers`";
        $result = $db->query($query);
        $manufacturers = $result->fetchAll(PDO::FETCH_ASSOC);

        $mnfCountries=array();
        foreach($manufacturers as $mnf){
            $query_country="SELECT id_country FROM manufacturercountries WHERE
            id_manufacturer=:mnfid";
              $result_id = $db->prepare($query_country);
              $result_id->bindParam(':mnfid', $mnf['id']);
              $result_id->execute();
              $result_id =  $result_id->fetchAll(PDO::FETCH_ASSOC);
              $mnfCountries[$mnf['id']]= $result_id;    
 
        }

        $this->view('manager/add_countries_to_manufacturer_manager', ['siteLinks'=>$siteLink,'countries'=>$countries, 'manufacturers'=>$manufacturers, 'msg_color' => $return_msg_color ,
        'msg' => $return_msg, 'manufacturername' => $manufacturername, 'selCountries'=> $selCountries, 'mnf_countries'=>$mnfCountries]);
    }

    /** This function viev manufacturers form the database
     */
    public function list_of_manufacturers(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }

        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);

        $query="SELECT m.id as m_id, m.name as mnf,COUNT(mc.id_manufacturer) as mnfctsam 
        FROM manufacturers m 
        LEFT JOIN manufacturercountries mc ON m.id=mc.id_manufacturer 
        GROUP BY m.id";
        $result = $db->prepare($query);
        $result->execute();
        $manufacturers = $result->fetchAll(PDO::FETCH_ASSOC);
        $mnfCountries=array();

        foreach($manufacturers as $mnf){
            $query_country="SELECT `manufacturers`.id as m_id, `manufacturers`.name as mname, countries.id as c_id,
            countries.name as cname
            FROM `manufacturers` 
            LEFT JOIN `manufacturercountries` ON `manufacturercountries`.`id_manufacturer` = `manufacturers`.`id` 
            LEFT JOIN `countries` ON `manufacturercountries`.`id_country` = `countries`.`id` 
            WHERE `manufacturers`.id=:mnfid";
            $result_id = $db->prepare($query_country);
            $result_id->bindParam(':mnfid', $mnf['m_id']);
            $result_id->execute();
            $result_id =  $result_id->fetchAll(PDO::FETCH_ASSOC);
            $mnfCountries[$mnf['m_id']]= $result_id;    
        }

        $queryCnt="SELECT id, name FROM countries";
        $resultCnt= $db->query($queryCnt);
        $resultCnt = $resultCnt->fetchAll(PDO::FETCH_ASSOC);

        if(isset($_POST['mnfEditSub'])){
            isset($_POST['countrymnf']) ? $countrymnf=$_POST['countrymnf'] : $countrymnf=array();
            isset($_POST['mnfname']) ? $mnfname=$_POST['mnfname'] : $mnfname="";
            isset($_POST['mnfid']) ? $mnfid=$_POST['mnfid'] : $mnfid="";

            if(!empty($_POST['mnfname'])){
                $query="UPDATE manufacturers SET name=:mnfname WHERE id=:mnfid";
                $result = $db->prepare($query);
                $result->bindParam(':mnfid', $mnfid);
                $result->bindParam(':mnfname', $mnfname);
                $result->execute();

                $query="SELECT id, COUNT(id) FROM manufacturers WHERE name=:mnfname";
                $result = $db->prepare($query);
                $result->bindParam(':mnfname', $mnfname);
                $result->execute();
                $mnf_id=$result->fetch(PDO::FETCH_ASSOC);
                $temp = $mnf_id['COUNT(id)'];
                $countryArray = array();
                if($temp>0&&$mnf_id['id']!=$mnfid){
                    $_SESSION['error_page'] = "list_of_manufacturers";
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $queryI="INSERT INTO manufacturercountries (id_manufacturer,id_country) VALUES (:mnf_id,:ctr_id)";
                    foreach ($countrymnf as $country){
                        array_push($countryArray, strval($country));
                        print_r($countryArray);
                        $query="SELECT COUNT(id) FROM manufacturercountries WHERE id_manufacturer=:id_manufacturer AND id_country=:id_country";
                        $result = $db->prepare($query);
                        $result->bindParam(':id_manufacturer',$mnfid);
                        $result->bindParam(':id_country',$country);
                        $result->execute();
                        $mnf_id=$result->fetch(PDO::FETCH_ASSOC);
                        if($mnf_id['COUNT(id)']>0)
                            continue;
                        $result = $db->prepare($queryI);
                        $result->bindParam(':mnf_id',$mnfid);
                        $result->bindParam(':ctr_id',$country);
                        $result->execute();
                    }
                    $query="SELECT id, id_country FROM manufacturercountries WHERE id_manufacturer=:id_manufacturer";
                    $result = $db->prepare($query);
                    $result->bindParam(':id_manufacturer',$mnfid);
                    $result->execute();
                    $arr=$result->fetchAll(PDO::FETCH_ASSOC);   
                    $i=0;
                    foreach($arr as $element){
                        if(in_array(strval($element['id_country']), $countryArray)){
                            print_r('jest');
                        }else{
                            $query="DELETE FROM manufacturercountries WHERE id=:id";
                            $result = $db->prepare($query);
                            $result->bindParam(':id',$arr[$i]['id']);
                            $result->execute();
                        }        
                        $i++;
                    }

                    $_SESSION['success_page'] = "list_of_manufacturers";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "list_of_manufacturers";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }

        $rmPath=ROOT."/manager/remove_manufacturer";

        $this->view('manager/list_of_manufacturers',['siteLinks'=>$siteLink,'mnfArray'=> $manufacturers, 'mnfCts'=> $mnfCountries,
         'rmpath'=> $rmPath, 'countries'=>$resultCnt]);

    }

    /** This function remove manufacturer from the database
     * @param {int} is the id of manufacturer
     */
    public function remove_manufacturer($id_manuf=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "manager"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }      

        if(isset($id_manuf)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="DELETE FROM manufacturers WHERE id=:id_manuf";
            $result = $db->prepare($query);
            $result->bindParam(':id_manuf', $id_manuf);
            $result->execute();
        }
    
        header("Location:" . ROOT . "/manager/list_of_manufacturers");
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////ITEMS/////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /** This function add item to the database
     */
    public function add_item(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        
        if(isset($_POST['itemSubmit'])){
            if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) && !empty($_POST['manufacturer']) && !empty($_POST['selCategories'])){
                //add item to database
                                  
                $itemName = $_POST['name'];
                $itemPrice = $_POST['price'];
                $itemQuantity = $_POST['quantity'];
                $itemManufacturer = $_POST['manufacturer'];
                $selCategories = $_POST['selCategories'];

                $query="INSERT INTO items (id_manufacturercountry, name, amount, price) 
                VALUES (:id_manufacturercountry, :item_name, :item_quantity, :item_price)";

                $result = $db->prepare($query);
                $result->bindParam(':id_manufacturercountry',$itemManufacturer);
                $result->bindParam(':item_name',$itemName);
                $result->bindParam(':item_price',$itemPrice);
                $result->bindParam(':item_quantity',$itemQuantity);
                $result->execute();
                
                $query="SELECT id FROM items WHERE name=:item_name ORDER BY id DESC LIMIT 1";
                $result = $db->prepare($query);
                $result->bindParam(':item_name', $itemName);
                $result->execute();
                $item_id=$result->fetch(PDO::FETCH_ASSOC);
                $item_id=$item_id['id'];

                $path = $_FILES['formFile']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $imagename = "[" . $item_id . "]." . $ext;    
                $tmpname = $_FILES['formFile']['tmp_name'];
                if (!move_uploaded_file($tmpname, PHOTOSPATH . "/" . $imagename)) {
                    $_SESSION['error_page'] = "list_of_items";
                    header("Location:" . ROOT . "/manager/error_page/3");
                } 

                foreach($selCategories as $i){
                    $query="INSERT INTO categoriesofitem (id_category, id_item) 
                    VALUES (:id_categ, :id_item)";
                    $result = $db->prepare($query);
                    $result->bindParam(':id_categ',$i);
                    $result->bindParam(':id_item',$item_id);                                                                      
                    $result->execute();
                }

                $i = 1;
                while(isset($_POST["attribute_name" . $i])){
                    $query="SELECT id, isrange FROM attributes WHERE name=:attr_name";
                    $result = $db->prepare($query);
                    $result->bindParam(':attr_name', $_POST["attribute_name" . $i]);
                    $result->execute();
                    $result=$result->fetch(PDO::FETCH_ASSOC); 
                    $attr_id=$result['id'];
                    $attr_isrange=$result['isrange'];
                    
                    if($attr_isrange == 0){
                        $query="INSERT INTO attributesofitems (id_item, id_attribute, value) 
                        VALUES (:id_item, :id_attribute, :in_value)";
                        $result = $db->prepare($query);
                        $result->bindParam(':id_item',$item_id);
                        $result->bindParam(':id_attribute',$attr_id);
                        $result->bindParam(':in_value',$_POST["attribute_value" . $i]);
                        $result->execute();
                    }else if($attr_isrange == 1){
                        $attrValuePost = $_POST["attribute_value" . $i];
                        $floatVal = floatval($attrValuePost);

                        $query="INSERT INTO attributesofitems (id_item, id_attribute, value, valuedecimal) 
                        VALUES (:id_item, :id_attribute, :in_value, :in_valuedecimal)";
                        $result = $db->prepare($query);
                        $result->bindParam(':id_item',$item_id);
                        $result->bindParam(':id_attribute',$attr_id);
                        if($floatVal)
                        {
                            $result->bindParam(':in_valuedecimal',$attrValuePost);
                            $result->bindParam(':in_value',$attrValuePost);
                        }else{
                            $attrValuePost = 0;
                            $result->bindParam(':in_valuedecimal',$attrValuePost);
                            $result->bindParam(':in_value',$attrValuePost);
                        }
                        $result->execute();
                    }


                   // var_dump($_POST["attribute_name" . $i] . ", " . $_POST["attribute_value" . $i]);
                    $i += 1;
                }      
                
                $i = 1;
                while(isset($_POST["descriptionTitle" . $i])){
                    $query="SELECT id FROM descriptions WHERE title=:desc_title";
                    $result = $db->prepare($query);
                    $result->bindParam(':desc_title', $_POST["descriptionTitle" . $i]);
                    $result->execute();
                    $attr_id=$result->fetch(PDO::FETCH_ASSOC); 

                    $query="INSERT INTO descriptions (id_item, title, description) 
                    VALUES (:id_item, :title, :desc)";
                    $result = $db->prepare($query);
                    $result->bindParam(':id_item',$item_id);
                    $result->bindParam(':title',$_POST["descriptionTitle" . $i]);
                    $result->bindParam(':desc',$_POST["description" . $i]);
                    $result->execute();

                    $i += 1;
                }  

                $_SESSION['success_page'] = "list_of_items";
                header("Location:" . ROOT . "/manager/success_page/1");

            }else{
                $_SESSION['error_page'] = "list_of_items";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }

        $query="SELECT mc.id as id, m.name as mname,c.name as cname
        FROM manufacturercountries mc 
        INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
        INNER JOIN countries c ON mc.id_country=c.id";
        $result = $db->prepare($query);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $query="SELECT name FROM attributes";
        $result2 = $db->prepare($query);
        $result2->execute();
        $result2 = $result2->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT id as categoryid, name as categoryname FROM categories";
        $categories = $db->prepare($query);
        $categories->execute();
        $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

        $selCategories = "";

        
        $this->view('manager/add_item_manager', ['siteLinks'=>$siteLink,'items'=>$result, 'attributes' => $result2, 'categories'=>$categories, 
        'selCategories'=>$selCategories]);
        
    }

    /** This function edit item in the database
     * @param {int} is the id of item
     */
    public function edit_item($editId){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
    
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        
        if(isset($_POST['itemSubmit'])){
            if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) && !empty($_POST['manufacturer']) && !empty($_POST['selCategories'])){
                //update item in database
              
                $itemName = $_POST['name'];
                $itemPrice = $_POST['price'];
                $itemQuantity = $_POST['quantity'];
                $itemManufacturer = $_POST['manufacturer'];
                $selCategories = $_POST['selCategories'];

                $query="UPDATE items i SET id_manufacturercountry=:id_manufacturercountry, name=:item_name, amount=:item_quantity, price=:item_price
                WHERE i.id=:id";

                $result = $db->prepare($query);
                $result->bindParam(':id_manufacturercountry',$itemManufacturer);
                $result->bindParam(':item_name',$itemName);
                $result->bindParam(':item_price',$itemPrice);
                $result->bindParam(':item_quantity',$itemQuantity);
                $result->bindParam(':id',$editId);
                $result->execute();

                $query="SELECT id FROM items WHERE name=:item_name ORDER BY id DESC LIMIT 1";
                $result = $db->prepare($query);
                $result->bindParam(':item_name', $itemName);
                $result->execute();
                $item_id=$result->fetch(PDO::FETCH_ASSOC);
                $item_id=$item_id['id'];



                //////////////////////categories//////////////////////////////////////////
                $categArray = array();
                $queryCateg="INSERT INTO categoriesofitem (id_category,id_item) VALUES (:id_categ,:id)";

                foreach($selCategories as $i){
                    array_push($categArray, $i);
                    $query="SELECT COUNT(id_category) FROM categoriesofitem WHERE id_category=:id_category AND id_item=:id_item";
                    $result = $db->prepare($query);
                    $result->bindParam(':id_category',$i);
                    $result->bindParam(':id_item',$editId);
                    $result->execute();
                    $categ_id=$result->fetch(PDO::FETCH_ASSOC);
                    if($categ_id['COUNT(id_category)']>0)
                        continue;
                    $result = $db->prepare($queryCateg);
                    $result->bindParam(':id_categ',$i);
                    $result->bindParam(':id',$editId);
                    $result->execute();
                }

                $query="SELECT id, id_category FROM categoriesofitem WHERE id_item=:id_item";
                $result = $db->prepare($query);
                $result->bindParam(':id_item',$editId);
                $result->execute();
                $arr=$result->fetchAll(PDO::FETCH_ASSOC);   
                $i=0;
                foreach($arr as $element){
                    if(in_array(strval($element['id_category']), $categArray)){

                    }else{
                        $query="DELETE FROM categoriesofitem WHERE id=:id";
                        $result = $db->prepare($query);
                        $result->bindParam(':id',$arr[$i]['id']);
                        $result->execute();
                    }        
                    $i++;
                } 

                ///////////////////////////ATTR/////////////////////////////////////

                $remainingAttrID = array();

                $i = 1;

                for($i=1;$i<=$_POST["idOfLastAttr"];$i++){
                    if(!isset($_POST["attribute_name" . $i]) &&!isset($_POST["attribute_value" . $i])&&!isset($_POST["attrId" . $i])){

                    }else{
                        if(!empty($_POST["attribute_name" . $i])){
                            $query="SELECT isrange FROM attributes WHERE id=:attr_id";
                            $result = $db->prepare($query);
                            $result->bindParam(':attr_id', $_POST["attribute_name" . $i]);
                            $result->execute();
                            $result=$result->fetch(PDO::FETCH_ASSOC); 
                            $attr_isrange=$result['isrange'];
                            if($_POST["attrId" . $i] != 0){       
                                if($attr_isrange == 0){               
                                    $query="UPDATE attributesofitems SET id_attribute=:id_attr, value=:val WHERE id=:id";
                                    $result = $db->prepare($query);
                                    $result->bindParam(':id_attr',$_POST["attribute_name" . $i]);
                                    $result->bindParam(':val',$_POST["attribute_value" . $i]);
                                    $result->bindParam(':id',$_POST["attrId" . $i]);
                                    $result->execute();
                                }else{
                                    $attrValuePost = $_POST["attribute_value" . $i];
                                    $floatVal = floatval($attrValuePost);
                                
                                    $query="UPDATE attributesofitems SET id_attribute=:id_attr, value=:val, valuedecimal=:valuedecimal WHERE id=:id";
                                    $result = $db->prepare($query);
                                    $result->bindParam(':id_attr',$_POST["attribute_name" . $i]);
                                    if($floatVal){
                                        $result->bindParam(':val',$attrValuePost);
                                        $result->bindParam(':valuedecimal',$attrValuePost);
                                    }else{
                                        $attrValuePost = 0;
                                        $result->bindParam(':val',$attrValuePost);
                                        $result->bindParam(':valuedecimal',$attrValuePost);
                                    }
                                    $result->bindParam(':id',$_POST["attrId" . $i]);
                                    $result->execute();

                                }
                                array_push($remainingAttrID, $_POST["attrId".$i]);
                            }else{
                                if($attr_isrange == 0){               
                                    $query="INSERT INTO attributesofitems (id_item, id_attribute, value) VALUES (:id_item, :id_attr, :val)";
                                    $result = $db->prepare($query);
                                    $result->bindParam(':id_attr',$_POST["attribute_name" . $i]);
                                    $result->bindParam(':val',$_POST["attribute_value" . $i]);
                                    $result->bindParam(':id_item',$editId);
                                    $result->execute();
                                    $aId = $db->lastInsertId();
                                    array_push($remainingAttrID, $aId);
                                }else if($attr_isrange == 1){
                                    $attrValuePost = $_POST["attribute_value" . $i];
                                    $floatVal = floatval($attrValuePost);

                                    $query="INSERT INTO attributesofitems (id_item, id_attribute, value, valuedecimal) VALUES (:id_item, :id_attr, :val, :valuedecimal)";
                                    $result = $db->prepare($query);
                                    $result->bindParam(':id_attr',$_POST["attribute_name" . $i]);

                                    if($floatVal)
                                    {
                                        $result->bindParam(':val',$attrValuePost);
                                        $result->bindParam(':valuedecimal',$attrValuePost);
                                    }else{
                                        $attrValuePost = 0;
                                        $result->bindParam(':val',$attrValuePost);
                                        $result->bindParam(':valuedecimal',$attrValuePost);
                                    }
                                    $result->bindParam(':id_item',$editId);
                                    $result->execute();
                                    $aId = $db->lastInsertId();
                                    array_push($remainingAttrID, $aId);
                                }
                            }
                        }
                        else{
                            $_SESSION['error_page'] = "list_of_items";
                            header("Location:" . ROOT . "/manager/error_page/1");
                        }
                    }
                }

                $AttrIdsInDatabase = array();

                $query="SELECT id FROM attributesofitems WHERE id_item=:id_item";
                $result = $db->prepare($query);
                $result->bindParam(':id_item',$editId);
                $result->execute();
                $AttrIdsInDb=$result->fetchAll(PDO::FETCH_ASSOC); 

                foreach($AttrIdsInDb as $AidInDb){
                    array_push($AttrIdsInDatabase, $AidInDb['id']);
                }
                $array4 = array_diff($AttrIdsInDatabase,$remainingAttrID);
                foreach($array4 as $element){
                    $query = "DELETE FROM attributesofitems WHERE id=:id";
                    $result = $db->prepare($query);
                    $result->bindParam(':id',$element);
                    $result->execute();
                }

                ///////////////////////////////DESC////////////////////////////////////////////

                $remainingDescIds = array();
                
                for($i=1;$i<=$_POST["idOfLastDesc"];$i++){
                    if(!isset($_POST["descriptionTitle" . $i]) && !isset($_POST["description" . $i])){

                    }else{
                        if($_POST["descriptionId" . $i] != 0){
                            $query="UPDATE descriptions SET title=:title, description=:desc WHERE id=:id";
                            $result = $db->prepare($query);
                            $result->bindParam(':title',$_POST["descriptionTitle" . $i]);
                            $result->bindParam(':desc',$_POST["description" . $i]);
                            $result->bindParam(':id',$_POST["descriptionId" . $i]);
                            $result->execute();
                            array_push($remainingDescIds, $_POST["descriptionId" . $i]);
                        }
                        else{
                            $query="INSERT INTO descriptions (id_item, title, description) VALUES (:id_item, :title, :description)";
                            $result = $db->prepare($query);
                            $result->bindParam(':title',$_POST["descriptionTitle" . $i]);
                            $result->bindParam(':description',$_POST["description" . $i]);
                            $result->bindParam(':id_item',$editId);
                            $result->execute();
                            $lIId = $db->lastInsertId();
                            array_push($remainingDescIds, $lIId);
                        }
                    }
                }      

                $idsInDatabase = array();

                $query="SELECT id FROM descriptions WHERE id_item=:id_item";
                $result = $db->prepare($query);
                $result->bindParam(':id_item',$editId);
                $result->execute();
                $idsInDb=$result->fetchAll(PDO::FETCH_ASSOC); 

                foreach($idsInDb as $idInDb){
                    array_push($idsInDatabase, $idInDb['id']);
                }

                $array3 = array_diff($idsInDatabase,$remainingDescIds);

                foreach($array3 as $element){
                    $query = "DELETE FROM descriptions WHERE id=:id";
                    $result = $db->prepare($query);
                    $result->bindParam(':id',$element);
                    $result->execute();
                }

                $imagePathCheck = PHOTOSPATH . "/[" . $item_id. "].png";
                if(!empty($_FILES['formFile']['name'])){
                    if(file_exists($imagePathCheck)) unlink($imagePathCheck);
                    $path = $_FILES['formFile']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $imagename = "[" . $item_id . "]." . $ext;    
                    $tmpname = $_FILES['formFile']['tmp_name'];
                    if (!move_uploaded_file($tmpname, PHOTOSPATH . "/" . $imagename)) {
                        $_SESSION['error_page'] = "list_of_items";
                        header("Location:" . ROOT . "/manager/error_page/3");
                    }
                }
                
                $_SESSION['success_page'] = "list_of_items";
                header("Location:" . ROOT . "/manager/success_page/2");

            }
            else{
                $_SESSION['error_page'] = "list_of_items";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }

        $query="SELECT mc.id as id, m.name as mname,c.name as cname
        FROM manufacturercountries mc 
        INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
        INNER JOIN countries c ON mc.id_country=c.id";
        $result = $db->prepare($query);
        $result->execute();
        $items = $result->fetchAll(PDO::FETCH_ASSOC);
        $query="SELECT id, name FROM attributes";
        $result2 = $db->prepare($query);
        $result2->execute();
        $attributes = $result2->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT id as categoryid, name as categoryname FROM categories";
        $categories = $db->prepare($query);
        $categories->execute();
        $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

        $prevCtg = array();
        $prevAttr = array();
        $prevDesc = array();

        $query="SELECT name AS prevName, id_manufacturercountry AS prevMnfCnt,
        amount AS prevAmount, price AS prevPrice, picturepath AS prevPctPth
        FROM items
        WHERE id=:editId";
        $result = $db->prepare($query);     
        $result->bindParam(':editId', $editId);
        $result->execute();
        $prevItems = $result->fetch(PDO::FETCH_ASSOC);

        $queryCateg="SELECT c.id AS categid
        FROM items i 
        INNER JOIN categoriesofitem coi ON i.id=coi.id_item
        INNER JOIN categories c ON coi.id_category=c.id
        WHERE i.id=:iid";
        $result = $db->prepare($queryCateg);     
        $result->bindParam(':iid', $editId);
        $result->execute();
        $tempPrevCtg = $result->fetchAll(PDO::FETCH_ASSOC);

        for($i=0;$i<sizeof($tempPrevCtg); $i++){
            array_push($prevCtg, $tempPrevCtg[$i]['categid']);
        }

        $queryAttr="SELECT ai.id AS aiId, a.id AS attrId ,a.name AS attrname, ai.value AS aval
        FROM items i 
        INNER JOIN attributesofitems ai ON i.id=ai.id_item
        INNER JOIN attributes a ON ai.id_attribute=a.id
        WHERE i.id=:iid";
        $result = $db->prepare($queryAttr);     
        $result->bindParam(':iid', $editId);
        $result->execute();
        $prevAttr = $result->fetchAll(PDO::FETCH_ASSOC);

        $queryDesc="SELECT d.id AS descriptionId, d.title AS desctitle, d.description AS descval
        FROM items i 
        INNER JOIN descriptions d ON i.id=d.id_item
        WHERE i.id=:iid";
        $result = $db->prepare($queryDesc);     
        $result->bindParam(':iid', $editId);
        $result->execute();
        $prevDesc = $result->fetchAll(PDO::FETCH_ASSOC);

        $imagePath = APPPATH . "/resources/itemsPhotos/[" . $editId . "].png";
        $imagePathCheck = PHOTOSPATH . "/[" . $editId . "].png";

        if(!file_exists($imagePathCheck)){
            $imagePath = APPPATH . "/resources/itemsPhotos/brak_zdjecia.png";
        }

        $this->view('manager/edit_item_manager', ['siteLinks'=>$siteLink,'items'=>$items, 'attributes' => $attributes, 'categories'=>$categories, 
        'selCategories'=>$prevCtg, 'prevItems'=>$prevItems, 'prevCtg'=>$prevCtg, 'prevAttr'=>$prevAttr, 
        'prevDesc'=>$prevDesc, 'imagePath'=>$imagePath]);
        
    }

    /** This function view items from the database
     */
    public function list_of_items(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);

        $query="SELECT i.id AS iid, i.name AS itemName, m.name AS manufacturerName, 
        c.name AS manufacturerCountry, i.amount AS amount, i.price AS price
        FROM items i 
            INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
            INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
            INNER JOIN countries c ON mc.id_country=c.id WHERE i.active=1";
        $result = $db->query($query);
        $items = $result->fetchAll(PDO::FETCH_ASSOC);

        $queryCateg="SELECT c.name AS categname
        FROM items i 
        INNER JOIN categoriesofitem coi ON i.id=coi.id_item
        INNER JOIN categories c ON coi.id_category=c.id
        WHERE i.id=:iid AND i.active=1";

        $queryCat="SELECT c.name AS catname
        FROM items i 
        INNER JOIN itemsincatalog ic ON i.id=ic.id_item
        INNER JOIN catalog c ON ic.id_catalog=c.id
        WHERE i.id=:iid AND i.active=1";

        $queryAttr="SELECT a.name AS attrname, ai.value AS aval
        FROM items i 
        INNER JOIN attributesofitems ai ON i.id=ai.id_item
        INNER JOIN attributes a ON ai.id_attribute=a.id
        WHERE i.id=:iid AND i.active=1";

        $categoriesArray=array();
        $catalogArray=array();
        $attrArray=array();

        foreach($items as $id){
            $result = $db->prepare($queryCateg);
            $result->bindParam(':iid', $id['iid']);
            $result->execute();
            $result =  $result->fetchAll(PDO::FETCH_ASSOC);
            $categoriesArray[$id['iid']]= $result;

            $result = $db->prepare($queryCat);
            $result->bindParam(':iid', $id['iid']);
            $result->execute();
            $result =  $result->fetchAll(PDO::FETCH_ASSOC);
            $catalogArray[$id['iid']]= $result;

            $result = $db->prepare($queryAttr);
            $result->bindParam(':iid', $id['iid']);
            $result->execute();
            $result =  $result->fetchAll(PDO::FETCH_ASSOC);
            $attrArray[$id['iid']]= $result;
        }
        
        $editItemPath=ROOT."/manager/edit_item";
        $removeItemPath=ROOT."/manager/remove_item";
        
        $this->view('manager/list_of_items', ['siteLinks'=>$siteLink,'itemsArray' => $items, 'categoriesArray' => $categoriesArray, 
        'catalogArray' => $catalogArray, 'attrArray' => $attrArray, 'editItemPath' => $editItemPath, 'removeItemPath' => $removeItemPath]);
    }


    /** This function view items from the database, that do not belong to any catalog
     */
    public function list_of_uncategorized_items(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);

        $query="SELECT i.id AS iid, i.name AS itemName, m.name AS manufacturerName, 
        c.name AS manufacturerCountry, i.amount AS amount, i.price AS price
        FROM items i
        	LEFT OUTER JOIN categoriesofitem coi ON i.id=coi.id_item
            LEFT OUTER JOIN categories cat ON coi.id_category=cat.id
            INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
            INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
            INNER JOIN countries c ON mc.id_country=c.id
            WHERE id_category IS NULL";
        $result = $db->query($query);
        $items = $result->fetchAll(PDO::FETCH_ASSOC);


        $queryCat="SELECT c.name AS catname
        FROM items i 
        INNER JOIN itemsincatalog ic ON i.id=ic.id_item
        INNER JOIN catalog c ON ic.id_catalog=c.id
        WHERE i.id=:iid";

        $queryAttr="SELECT a.name AS attrname, ai.value AS aval
        FROM items i 
        INNER JOIN attributesofitems ai ON i.id=ai.id_item
        INNER JOIN attributes a ON ai.id_attribute=a.id
        WHERE i.id=:iid";

        $catalogArray=array();
        $attrArray=array();

        foreach($items as $id){

            $result = $db->prepare($queryCat);
            $result->bindParam(':iid', $id['iid']);
            $result->execute();
            $result =  $result->fetchAll(PDO::FETCH_ASSOC);
            $catalogArray[$id['iid']]= $result;

            $result = $db->prepare($queryAttr);
            $result->bindParam(':iid', $id['iid']);
            $result->execute();
            $result =  $result->fetchAll(PDO::FETCH_ASSOC);
            $attrArray[$id['iid']]= $result;
        }
        
        $editItemPath=ROOT."/manager/edit_item";
        $removeItemPath=ROOT."/manager/remove_item";
        
        $this->view('manager/list_of_uncategorized_items', ['siteLinks'=>$siteLink,'itemsArray' => $items,
        'catalogArray' => $catalogArray, 'attrArray' => $attrArray, 'editItemPath' => $editItemPath, 'removeItemPath' => $removeItemPath]);
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////CATEGORIES////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
    /** This function add catalog to the database
     */
    public function add_category(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        $tekst2 = "";
        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_category"){
                if(isset($_SESSION['categoryName'])) {$tekst2 = $_SESSION['categoryName']; unset($_SESSION['categoryName']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        if(isset($_POST['categSub'])){
            if(!empty($_POST['category'])){
                $category = $_POST['category'];
                $tekst1 = strtolower($category);
                $tekst2 = ucfirst($tekst1);

                $query="SELECT COUNT(id) as amount
                FROM categories WHERE name=:name";
                $result = $db->prepare($query);
                $result->bindParam(':name', $tekst2);
                $result->execute();
                $result = $result->fetch(PDO::FETCH_ASSOC);
                if($result['amount']>0){
                    $_SESSION['error_page'] = "add_category";
                    $_SESSION['categoryName'] = $tekst2;
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query = "INSERT INTO `categories` (name) VALUES ('$tekst2');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "add_category";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_category";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }else{
            $this->view('manager/add_category_manager', ['siteLinks'=>$siteLink,'category' => $tekst2]);
        }
    }


    /** This function view categories from the database
     */
    public function list_of_categories()
    {
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        $query="SELECT * FROM `categories` ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC); 

        $rmCatPath=ROOT."/manager/remove_category";
        $editCatPath=ROOT."/manager/edit_category";
        $this->view('manager/list_of_categories', ['siteLinks'=>$siteLink,'categoriesArray'=>$result, 'rmpath'=> $rmCatPath, 'editpath'=> $editCatPath]);
    }

    /** This function edit category in the database
     * @param {int} is the id of catgory
     */
    public function edit_category($id_categ=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        if(isset($id_categ)){
        isset($_POST['edit_categ']) ? $category=$_POST['edit_categ'] : $category="";
            if(!empty($category)){
                require_once dirname(__FILE__,2) . '/core/database.php';
                $tekst1 = strtolower($category);
                $tekst2 = ucfirst($tekst1);

                $query="SELECT id, COUNT(id) FROM categories WHERE name=:categ";
                $result = $db->prepare($query);
                $result->bindParam(':categ', $category);
                $result->execute();
                $categ_id=$result->fetch(PDO::FETCH_ASSOC);
                $temp = $categ_id['COUNT(id)'];
                if($temp>0&&$categ_id['id']!=$id_categ){
                    $_SESSION['error_page'] = "list_of_categories";
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query = "UPDATE `categories` 
                        SET name = '$tekst2' 
                        WHERE id = '$id_categ';";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "list_of_categories";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "list_of_categories";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }else{
            header("Location:" . ROOT . "/manager/list_of_categories");
        }
    }


    /** This function remove category from the database
     * @param {int} is the id of category
     */
    public function remove_category($id_categ=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        if(isset($id_categ)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="DELETE FROM categories WHERE id=:id_categ";
            $result = $db->prepare($query);
            $result->bindParam(':id_categ', $id_categ);
            $result->execute();
        }  
    
        header("Location:" . ROOT . "/manager/list_of_categories");
    }


    /** This function add shipping method to the database
     */
    public function add_shipping_method(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 
        $methodName = "";
        $methodPrice = "";
        $methodActive = "";
        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_shipping_method"){
                if(isset($_SESSION['methodName'])) {$methodName = $_SESSION['paymentMethodName']; unset($_SESSION['paymentMethodName']);} 
                if(isset($_SESSION['methodPrice'])) {$methodPrice = $_SESSION['methodPrice']; unset($_SESSION['methodPrice']);} 
                if(isset($_SESSION['methodActive'])) {$methodActive = $_SESSION['paymentMethodActive']; unset($_SESSION['paymentMethodActive']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        require_once dirname(__FILE__,2) . '/core/database.php';

        $siteLink = $this->getFooter($db);

        if(isset($_POST['addshipmeth'])){
            if(isset($_POST['methodName'])) $_SESSION['paymentMethodName'] = $_POST['methodName'];
            if(isset($_POST['methodPrice'])) $_SESSION['methodPrice'] = $_POST['methodPrice'];
            if(isset($_POST['methodActive'])) $_SESSION['paymentMethodActive'] = $_POST['methodActive'];

            if(!empty($_POST['methodName'])){
            
                $methodName = $_POST['methodName'];
                isset($_POST['methodPrice']) ? $methodPrice = $_POST['methodPrice'] : $methodPrice="";
                isset($_POST['methodActive']) ? $methodActive = 1 : $methodActive = 0;

                $query="SELECT COUNT(id) as amount
                FROM shippingmethods WHERE name=:name";
                $result = $db->prepare($query);
                $result->bindParam(':name', $methodName);
                $result->execute(); 
                $result = $result->fetch(PDO::FETCH_ASSOC);
                if($result['amount']>0){
                    $_SESSION['error_page'] = "shipping_method";
                    $_SESSION['methodName'] = $methodName;
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query = "INSERT INTO shippingmethods (name, price, active) VALUES ('$methodName', '$methodPrice', '$methodActive');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "shipping_method";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "shipping_method";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }else{
            $this->view('manager/add_shipping_method_manager', ['siteLinks'=>$siteLink]);
        }
    }

    /** This function view shipping methods from the database
     */
    public function list_of_shipping_methods(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 

        $shippingOnlyActive = 1;
        if(isset($_POST['onlyActiveSubmit'])){
            if(!isset($_POST['onlyActive']))
                $shippingOnlyActive = 0;
        }
        require_once dirname(__FILE__,2) . '/core/database.php';

        $siteLink = $this->getFooter($db);

        if($shippingOnlyActive==1){        
            $query="SELECT id, name, price, needaddress active FROM shippingmethods WHERE active=1";
            $result = $db->query($query);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $query="SELECT id, name, price, needaddress active FROM shippingmethods";
            $result = $db->query($query);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        }

        

        $editMethPath=ROOT."/manager/edit_shipping_method";
        $this->view('manager/list_of_shipping_methods_manager', ['siteLinks'=>$siteLink, 'shippingArray' => $result, 'editpath' => $editMethPath,  
        'shippingOnlyActive' =>$shippingOnlyActive]);
    }


    /** This function edit shipping method in the database
     * @param {int} is the id of shipping method
     */
    public function edit_shipping_method($id_m=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 
        
        if(isset($id_m)){

        require_once dirname(__FILE__,2) . '/core/database.php';
        isset($_POST['methActive']) ? $methActive = 1 : $methActive=0;
        isset($_POST['needAddress']) ? $needAddress = 1 : $needAddress=0;

        $query = "UPDATE `shippingmethods` 
            SET active='$methActive', needaddress='$needAddress'
            WHERE id = '$id_m';";
        $result = $db->prepare($query);
        $result->execute();
        $_SESSION['success_page'] = "list_of_shipping_methods";
        header("Location:" . ROOT . "/manager/success_page/2");
        
        }else{
            header("Location:" . ROOT . "/manager/list_of_attributes");
        }
    }

    /** 
     * This function add payment method to the database
     */
    public function add_payment_method(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 
        $methodName = "";
        $methodFee = "";
        $methodActive = "";
        $needAddress = "";
        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_shipping_method"){
                if(isset($_SESSION['methodName'])) {$methodName = $_SESSION['paymentMethodName']; unset($_SESSION['paymentMethodName']);} 
                if(isset($_SESSION['methodFee'])) {$methodFee = $_SESSION['methodFee']; unset($_SESSION['methodFee']);} 
                if(isset($_SESSION['methActive'])) {$methActive = $_SESSION['paymentMethodActive']; unset($_SESSION['paymentMethodActive']);} 
                if(isset($_SESSION['needAddress'])) 
                {$needAddress = $_SESSION['needAddress']; unset($_SESSION['needAddress']);}
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        require_once dirname(__FILE__,2) . '/core/database.php';

        $siteLink = $this->getFooter($db);

        if(isset($_POST['addpaymeth'])){
            if(isset($_POST['methodName'])) $_SESSION['paymentMethodName'] = $_POST['methodName'];
            if(isset($_POST['methodFee'])) $_SESSION['methodFee'] = $_POST['methodFee'];
            if(isset($_POST['methActive'])) $_SESSION['paymentMethodActive'] = $_POST['methActive'];
            if(isset($_POST['needAddress'])) $_SESSION['needAddress'] = $_POST['needAddress'];

            if(!empty($_POST['methodName'])){
            
                $methodName = $_POST['methodName'];
                isset($_POST['methodFee']) ? $methodFee = $_POST['methodFee'] : $methodFee="";
                isset($_POST['methActive']) ? $methodActive = 1 : $methodActive = 0;
                isset($_POST['needAddress']) ? $needAddress = 1 : $needAddress = 0;

                $query="SELECT COUNT(id) as amount
                FROM paymentmethods WHERE name=:name";
                $result = $db->prepare($query);
                $result->bindParam(':name', $methodName);
                $result->execute(); 
                $result = $result->fetch(PDO::FETCH_ASSOC);
                if($result['amount']>0){
                    $_SESSION['error_page'] = "add_payment_method";
                    $_SESSION['paymentMethodName'] = $methodName;
                    header("Location:" . ROOT . "/manager/error_page/2");
                }else{
                    $query = "INSERT INTO paymentmethods (name, fee, needaddress ,active) 
                    VALUES ('$methodName', '$methodFee', '$needAddress' ,'$methodActive');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "add_payment_method";
                    header("Location:" . ROOT . "/manager/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_payment_method";
                header("Location:" . ROOT . "/manager/error_page/1");
            }
        }else{
            $this->view('manager/add_payment_method_manager', ['siteLinks'=>$siteLink]);
        }
    }

    /** This function view payment methods from the database
     */
    public function list_of_payment_methods(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 

        $paymentOnlyActive = 1;
        if(isset($_POST['onlyActiveSubmit'])){
            if(isset($_POST['onlyActive']))
                $paymentOnlyActive = 0;
        }
        require_once dirname(__FILE__,2) . '/core/database.php';

        $siteLink = $this->getFooter($db);

        if($paymentOnlyActive==1){        
            $query="SELECT id, name, fee, active FROM paymentmethods WHERE active=1";
            $result = $db->query($query);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $query="SELECT id, name, fee, active FROM paymentmethods";
            $result = $db->query($query);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        }

        $editMethPath=ROOT."/manager/edit_payment_method";
        $this->view('manager/list_of_payment_methods_manager', ['siteLinks'=>$siteLink,'paymentArray' => $result, 'editpath' => $editMethPath, 
        'paymentOnlyActive' =>$paymentOnlyActive]);
    }

    /** This function edit payment method in the database
     * @param {int} is the id of payment method
     */
    public function edit_payment_method($id_p=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "manager"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 
        
        if(isset($id_p)){
            
         
            require_once dirname(__FILE__,2) . '/core/database.php';
            isset($_POST['methActive']) ? $methActive = 1 : $methActive=0;
    
           
            $query = "UPDATE `paymentmethods` 
                SET name = 
                active='$methActive'
                WHERE id = '$id_p';";
            $result = $db->prepare($query);
            $result->execute();
            $_SESSION['success_page'] = "list_of_payment_methods";
            header("Location:" . ROOT . "/manager/success_page/2");
            
         
        }else{
            header("Location:" . ROOT . "/manager/list_of_attributes");
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////HOME PAGE///////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////// 
    public function edit_home(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }

        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        
        if(isset($_POST['homeEditSubmit'])){


            $query="UPDATE homepageinfo SET icon1=:ico1,
            title1=:title1, desc1=:desc1, icon2=:ico2,
            title2=:title2, desc2=:desc2, icon3=:ico3,
            title3=:title3, desc3=:desc3, youtubeUrl=:link";

            $result= $db->prepare($query);
            $result->bindParam(':ico1', $_POST['ico1']);
            $result->bindParam(':title1', $_POST['title1']);
            $result->bindParam(':desc1', $_POST['brief1']);
            $result->bindParam(':ico2', $_POST['ico2']);
            $result->bindParam(':title2', $_POST['title2']);
            $result->bindParam(':desc2', $_POST['brief2']);
            $result->bindParam(':ico3', $_POST['ico3']);
            $result->bindParam(':title3', $_POST['title3']);
            $result->bindParam(':desc3', $_POST['brief3']);
            $result->bindParam(':link', $_POST['video']);
            $result->execute();

            if(!empty($_FILES['formFile']['name'])){
                $imagePathCheck = PHOTOSPATH . "/upload/baner.png";
                if(file_exists($imagePathCheck)) unlink($imagePathCheck);
                $path = $_FILES['formFile']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $imagename = "baner." . $ext;
                $tmpname = $_FILES['formFile']['tmp_name'];
                if (!move_uploaded_file($tmpname, PHOTOSPATH . "/upload/" . $imagename)) {
                    $_SESSION['error_page'] = "list_of_items";
                    header("Location:" . ROOT . "/manager/error_page/3");
                }  
            }

            $_SESSION['success_page'] = "edit_home";
            header("Location:" . ROOT . "/manager/success_page/2");

        }

        $query="SELECT * FROM homepageinfo LIMIT 1";
        $result = $db->prepare($query);
        $result->execute();
        $result=$result->fetch(PDO::FETCH_ASSOC);


        $this->view('manager/edit_home', ['result'=>$result, 'siteLinks'=>$siteLink]);
    }
    //////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////INFO////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////// 
    public function edit_informations(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "contentmanager"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }

        require_once dirname(__FILE__,2) . '/core/database.php';

        $siteLink = $this->getFooter($db);
        $imagePath = MAINPATH . "/resources/shopPhotos/siteicon.png";
        if(isset($_POST['informationsEditSubmit'])){
            $query="UPDATE siteinfo SET sitename=:sitename";
            $result = $db->prepare($query);
            $result->bindParam(':sitename', $_POST['siteName']);
            $result->execute();

            if(!empty($_FILES['formFile']['name'])){
                $imagePathCheck = MAINPATHLOC . "/resources/shopPhotos/siteicon.png";
                if(file_exists($imagePathCheck)) unlink($imagePathCheck); 
                $tmpname = $_FILES['formFile']['tmp_name'];
                if (!move_uploaded_file($tmpname, MAINPATHLOC . "/resources/shopPhotos/siteicon.png")) {
                    $_SESSION['error_page'] = "edit_informations";
                    header("Location:" . ROOT . "/manager/error_page/3");
                }
            }
            $_SESSION['success_page'] = "edit_informations";
            header("Location:" . ROOT . "/manager/success_page/2");
        }

        $query="SELECT sitename FROM siteinfo LIMIT 1";
        $result = $db->prepare($query);
        $result->execute();
        $result=$result->fetch(PDO::FETCH_ASSOC);

        $this->view('manager/edit_informations', ['result' => $result, 'siteLinks'=>$siteLink, 'imagePath' => $imagePath]);
    }

    //////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////FOOTER//////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////

    public function edit_footer(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "manager"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }

        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);
        if(isset($_POST['footerEditSubmit'])){
            $query="UPDATE footer SET name=:name, brief=:brief, 
            c1name=:c1name, 
            c1r1=:c1r1, c1r2=:c1r2, c1r3=:c1r3, c1r4=:c1r4, 
            c1r1path=:c1r1path, c1r2path=:c1r2path, c1r3path=:c1r3path, c1r4path=:c1r4path,
            c2name=:c2name,
            c2r1=:c2r1, c2r2=:c2r2, c2r3=:c2r3, c2r4=:c2r4,
            c2r1path=:c2r1path, c2r2path=:c2r2path, c2r3path=:c2r3path, c2r4path=:c2r4path, 
            c3name=:c3name,
            c3r1=:c3r1, c3r2=:c3r2, c3r3=:c3r3, c3r4=:c3r4, 
            bottomtext=:bottomtext, bottomtextpath=:bottomtextpath";
            $result = $db->prepare($query);
            $result->bindParam(':name', $_POST['companyName']);
            $result->bindParam(':brief', $_POST['brief']);
            $result->bindParam(':c1name', $_POST['c1name']);
            $result->bindParam(':c1r1', $_POST['c1r1']);
            $result->bindParam(':c1r2', $_POST['c1r2']);
            $result->bindParam(':c1r3', $_POST['c1r3']);
            $result->bindParam(':c1r4', $_POST['c1r4']);
            $result->bindParam(':c1r1path', $_POST['c1r1path']);
            $result->bindParam(':c1r2path', $_POST['c1r2path']);
            $result->bindParam(':c1r3path', $_POST['c1r3path']);
            $result->bindParam(':c1r4path', $_POST['c1r4path']);
            $result->bindParam(':c2name', $_POST['c2name']);
            $result->bindParam(':c2r1', $_POST['c2r1']);
            $result->bindParam(':c2r2', $_POST['c2r2']);
            $result->bindParam(':c2r3', $_POST['c2r3']);
            $result->bindParam(':c2r4', $_POST['c2r4']);
            $result->bindParam(':c2r1path', $_POST['c2r1path']);
            $result->bindParam(':c2r2path', $_POST['c2r2path']);
            $result->bindParam(':c2r3path', $_POST['c2r3path']);
            $result->bindParam(':c2r4path', $_POST['c2r4path']);
            $result->bindParam(':c3name', $_POST['c3name']);
            $result->bindParam(':c3r1', $_POST['c3r1']);
            $result->bindParam(':c3r2', $_POST['c3r2']);
            $result->bindParam(':c3r3', $_POST['c3r3']);
            $result->bindParam(':c3r4', $_POST['c3r4']);
            $result->bindParam(':bottomtext', $_POST['bottomtext']);
            $result->bindParam(':bottomtextpath', $_POST['bottomtextpath']);
            $result->execute();
            $_SESSION['success_page'] = "edit_footer";
            header("Location:" . ROOT . "/manager/success_page/2");
        }

        $query="SELECT * FROM footer LIMIT 1";
        $result = $db->prepare($query);
        $result->execute();
        $result=$result->fetch(PDO::FETCH_ASSOC);

        $this->view('manager/edit_footer', ['result' => $result, 'siteLinks'=>$siteLink]);
    }

    private function getFooter($db){
        if(isset($_SESSION['siteLink'])){
            $result = $_SESSION['siteLink'];
        }else{
            $query = "SELECT * FROM footer";
            $result = $db->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['siteLink'] = $result;
        }
        return $result;
    }

    

    /** This function logout the user
     */
    public function logout(){
        unset($_SESSION['loggedUser']);
        header("Location:" . ROOT . "/login");
    }
}
?>
