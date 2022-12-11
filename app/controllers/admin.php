<?php

use PHPMailer\PHPMailer\PHPMailer;

class Admin extends Controller
{

    public function success_page($sid){     
        if(isset($_SESSION['success_page'])){
            $path = $_SESSION['success_page'];
            unset($_SESSION['success_page']);
            if($sid==1){
                $firstLine = "Dodano rekord";
                $secondLine = "pomyślnie!";
            }
            $this->view('success_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            header("Refresh: 2; url=" . ROOT . "/admin/" . $path);
        }
        else header("Location:" . ROOT . "");
    }

    public function error_page($sid){     
        if(isset($_SESSION['error_page'])){
            $path = $_SESSION['error_page'];
            unset($_SESSION['error_page']);
            if($sid==1){
                $firstLine = "Nie podano wszystkich wymaganych wartości";
                $secondLine = "";
            }
            if($sid==2){
                $firstLine = "Taki rekord już istnieje";
                $secondLine = "";
            }
            $this->view('error_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            $_SESSION['successOrErrorResponse'] = $path;
            header("Refresh: 2; url=" . ROOT . "/admin/" . $path);

        }
        else header("Location:" . ROOT . "");
    }

    public function index(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/login");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }
        $this->view('admin/index', []);
    }

    public function list_of_users(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT id, name, lastName, email, login, password FROM users WHERE role='user' ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        $this->view('admin/list_of_users', ['usersArray'=>$result]);

    }

    public function add_user(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $name = '';
        $lastName = '';
        $email = '';
        $login = '';
        $password = '';
        if(isset($_POST['senduser']))
        {
            $name = ucfirst(strtolower($_POST['name']));
            $lastName = ucfirst(strtolower($_POST['surname']));
            $email = $_POST['mail'];
            $login = strtolower($_POST['login']);
            $password = $_POST['pass'];
            $role = "user";

            if(empty($password)){
                $length = 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                for ($i = 0; $i < $length; $i++) {
                    $password.= $characters[rand(0, $charactersLength - 1)];
                }
            }
            if(empty($name) || empty($lastName) || empty($email) || empty($login)){
                $_SESSION['error_page'] = "add_user";
                header("Location:" . ROOT . "/admin/error_page/1");
            }else{
                $hashedPassword = hash('sha256', $password);

                $query = "SELECT COUNT(id) AS amount FROM users WHERE login=:login";
                $result = $db->prepare($query);
                $result->bindParam(':login', $login);
                $result->execute();
                $result = $result->fetch(PDO::FETCH_ASSOC);
                
                $query = "SELECT COUNT(id) AS amount FROM users WHERE email=:email";
                $result2 = $db->prepare($query);
                $result2->bindParam(':email', $email);
                $result2->execute();
                $result2 = $result2->fetch(PDO::FETCH_ASSOC);
                
                if($result['amount']>0 || $result2['amount']>0){
                    $_SESSION['error_page'] = "add_user";
                    header("Location:" . ROOT . "/admin/error_page/2");
                }
                else{
                    $query = "INSERT INTO `users` (name, lastName, email, login, password, role) VALUES ('$name', '$lastName', '$email', '$login', '$hashedPassword', '$role');";
                    $result = $db->prepare($query);
                    $result->execute();
                    try{
                    $config = require_once dirname(__FILE__,2) . '/core/mailerconfig.php';
                    $mail = new PHPMailer();
    
                    $mail->isSMTP();
    
                    $mail->Host = $config['host'];
                    $mail->Port = $config['port'];
                    $mail->SMTPSecure =   PHPMailer::ENCRYPTION_SMTPS;
                    $mail->SMTPAuth = true;
    
                    $mail->Username = $config['username'];
                    $mail->Password = $config['password'];
    
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom($config['username'], 'Grontsmar');
                    $mail->addAddress($email);
                    $mail->addReplyTo($config['username'], 'Grontsmar');
    
                    $mail->isHTML(true);
                    $mail->Subject = 'Założone konto w sklepie Grontsmar';
                    $mail->Body = "<html>
                    <head>
                    <title> Założone konto w sklepie Grontsmar </title>
                    </head>
                    <body>
                    <h1> Dzień dobry! </h1>
                    <p> Na ten email zostało utworzone konto w sklepie Grontsmar. Oto dane: </p>
                    <p> Login: $login </p>
                    <p> Hasło: $password </p>
                    </body>
                    </html>";
    
                    //$mail->addAttachment('ścieżka');
    
                    $mail->send();
                } catch(Exception $e){
                    echo "<script>alert('Błąd wysyłania maila!')</script>";
                }
                    $_SESSION['success_page'] = "add_user";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }            
            }
        }
        $this->view('admin/add_user', ['name'=>$name, 'surname'=>$lastName, 'mail'=>$email, 'login'=>$login, 'pass'=>$password]);
    }

    public function list_of_content_managers(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT id, name, lastName, email, login, password FROM users WHERE role='contentmanager' ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->view('admin/list_of_conent_managers', ['usersArray'=>$result]);
    }

    public function list_of_administrators(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT id, name, lastName, email, login, password FROM users WHERE role='admin' ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->view('admin/list_of_administrators', ['usersArray'=>$result]);
    }

    public function list_of_products(){
        require_once dirname(__FILE__,2) . '/core/database.php';

        $query="SELECT i.name as itemName, m.name as manufacturerName, amount, price
        FROM items i INNER JOIN manufactures m ON i.id_manufacturer=m.id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('admin/list_of_products', ['itemsArray'=>$result]);
    }

    public function list_of_attributes()
    {
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT * FROM `attributes` ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
         

        $rmCatPath=ROOT."/admin/remove_attribut";
        $editCatPath=ROOT."/admin/edit_attribut";
        $this->view('admin/list_of_attributes', ['attributesArray'=>$result, 'rmpath'=> $rmCatPath, 'editpath'=> $editCatPath]);

    }

    public function edit_attribut($id_a=NULL){

        require_once dirname(__FILE__,2) . '/core/database.php';

        if(isset($_POST['edit_atr']))
        {
        
            $attribute = $_POST['edit_atr'];
            $tekst1 = strtolower($attribute);
            $tekst2 = ucfirst($tekst1);


            $query = "UPDATE `attributes` 
                SET name = '$tekst2' 
                WHERE id = '$id_a';";
            $result = $db->prepare($query);
            $result->execute();
            $_SESSION['success_page'] = "list_of_attributes";

        }
        header("Location:" . ROOT . "/admin/list_of_attributes");
    }

    public function remove_attribut($id_a=NULL){

        if(isset($id_a)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="DELETE FROM attributes WHERE id=:id_a";
            $result = $db->prepare($query);
            $result->bindParam(':id_a', $id_a);
            $result->execute();
        }
        
    
        header("Location:" . ROOT . "/admin/list_of_attributes");
    }

    public function list_of_catalogs(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        

        $query="SELECT c.name, COUNT(iic.id_catalog) as amount, c.id
        FROM catalog c LEFT JOIN itemsInCatalog iic ON c.id=iic.id_catalog GROUP BY c.id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);


        $itemsInCat=array();

        foreach($result as $res){
            $query_items="SELECT `catalog`.`id` AS `cat_id`, `itemsincatalog`.`id_item` AS `id_item`,
             `items`.`name` AS `name_item`, `items`.`amount` AS `amount`, `items`.`price` AS `price`,
            `manufactures`.`name` AS `mn_name`
            FROM `catalog` 
                LEFT JOIN `itemsincatalog` ON `itemsincatalog`.`id_catalog` = `catalog`.`id` 
                LEFT JOIN `items` ON `itemsincatalog`.`id_item` = `items`.`id` 
                LEFT JOIN `manufactures` ON `items`.`id_manufacturer` = `manufactures`.`id` WHERE  `catalog`.`id` =:catid";
                $result_id = $db->prepare($query_items);
                $result_id->bindParam(':catid', $res['id']);
                $result_id->execute();
                $result_id =  $result_id->fetchAll(PDO::FETCH_ASSOC);
                $itemsInCat[$res['id']]= $result_id;
        }

        $rmCatPath=ROOT."/admin/remove_catalog";

        $this->view('admin/list_of_catalogs', ['catalogsArray'=>$result, 'catalogsItems'=>$itemsInCat, 'rmpath'=> $rmCatPath]);
    }

    public function remove_catalog($cid=NULL){
        if(isset($cid)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="DELETE FROM catalog WHERE id=:cid";
            $result = $db->prepare($query);
            $result->bindParam(':cid', $cid);
            $result->execute();
        }
        header("Location:" . ROOT . "/admin/list_of_catalogs");
    }

    public function list_of_orders(){
        $this->view('admin/list_of_orders', []);
    }

    /** Function that add attributes
    * @author Ur_mum
    */
    public function add_attribute(){

        require_once dirname(__FILE__,2) . '/core/database.php';
        $tekst2 = "";
        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_attribute"){
                if(isset($_SESSION['attributeName'])) {$tekst2 = $_SESSION['attributeName']; unset($_SESSION['attributeName']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        if(isset($_POST['attribute']))
        {
        
            $attribute = $_POST['attribute'];
            $tekst1 = strtolower($attribute);
            $tekst2 = ucfirst($tekst1);

            $query="SELECT COUNT(id) as amount
            FROM attributes WHERE name=:name";
            $result = $db->prepare($query);
            $result->bindParam(':name', $tekst2);
            $result->execute();
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if($result['amount']>0){
                $_SESSION['error_page'] = "add_attribute";
                $_SESSION['attributeName'] = $tekst2;
                header("Location:" . ROOT . "/admin/error_page/2");
            }
            else{
                $query = "INSERT INTO `attributes` (name) VALUES ('$tekst2');";
                $result = $db->prepare($query);
                $result->execute();
                $_SESSION['success_page'] = "add_attribute";
                header("Location:" . ROOT . "/admin/success_page/1");
            }
        }

        $this->view('admin/add_attribute_admin', ['attribute' => $tekst2]);
    }
/////////////////////////////////////////////////////////////////////////////
    public function add_catalog(){
        require_once dirname(__FILE__,2) . '/core/database.php';
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
                    header("Location:" . ROOT . "/admin/error_page/2");
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
                //TODO zwrócenie komunikatów
                $return_msg_color="rgb(25, 135, 84)";
                $return_msg="pomyślnie dodano nowy katalog";
                $_SESSION['success_page'] = "add_catalog";
                unset($_SESSION['catname']);
                header("Location:" . ROOT . "/admin/success_page/1");
                }
            }
            else{
                $_SESSION['error_page'] = "add_catalog";
                header("Location:" . ROOT . "/admin/error_page/1");
            }

        }

        $query="SELECT i.name AS item, i.id AS item_id, m.name AS mnf FROM items i LEFT JOIN manufactures m ON i.id_manufacturer = m.id";
        $result = $db->prepare($query);
        $result->execute();
        $items = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('admin/add_catalog_admin', ['items'=>$items, 'msg_color' => $return_msg_color , 'msg' => $return_msg, 'catname' => $catname, 'itemcat'=> $itemstocat]);
    }
////////////////////////////////////////////////////////////////////////////
    public function add_item(){
        require_once dirname(__FILE__,2) . '/core/database.php';

        $return_msg_color="";
        $return_msg="";
        
        if(isset($_POST['itemSubmit'])){
            if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) && !empty($_POST['manufacturer'])){
                //add catalog to database
                $itemName = $_POST['name'];
                $itemPrice = $_POST['price'];
                $itemQuantity = $_POST['quantity'];
                $itemManufacturer = $_POST['manufacturer'];
                $test2 = "test";
                $test2 = $_POST['attributes'];
                $test3 = json_decode($_POST['attributes'],true);
                
                  
                
                $query="INSERT INTO items (name, amount, price, id_manufacturer) 
                VALUES (:item_name, :item_quantity, :item_price, :item_manufacturer)";

                $result = $db->prepare($query);
                $result->bindParam(':item_name',$itemName);
                $result->bindParam(':item_price',$itemPrice);
                $result->bindParam(':item_quantity',$itemQuantity);
                $result->bindParam(':item_manufacturer',$itemManufacturer);
                $result->execute();

                //TODO zwrócenie komunikatów
                $return_msg_color="rgb(25, 135, 84)";
                $return_msg=base64_encode("pomyślnie dodano nowy przedmiot");

            }
            else{
                $return_msg_color="rgb(220, 53, 69)";
                $return_msg=base64_encode("należy wybrać nazwę, cenę, ilość i producenta przedmiotu");
            }
            $_GET['color']=$return_msg_color;
            $_GET['msg']=$return_msg;
            header("Refresh:0; ". ROOT ."/admin/add_item?msg=".$_GET['msg']."&color=".$_GET['color']);

        }

        $query="SELECT id, name FROM manufactures";
        $result = $db->prepare($query);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT name FROM attributes";
        $result2 = $db->prepare($query);
        $result2->execute();
        $result2 = $result2->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('admin/add_item_admin', ['items'=>$result, 'attributes' => $result2]);
        
    }

    public function logout(){
        unset($_SESSION['loggedUser']);
        header("Location:" . ROOT . "/login");
    }
}
?>
