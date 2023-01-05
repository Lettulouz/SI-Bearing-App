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
            else if($sid==2){
                $firstLine = "Edytowano rekord";
                $secondLine = "pomyślnie!";
            }
            else if($sid==3){
                $firstLine = "Usunięto rekord";
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
            header("Refresh: 2; url=" . ROOT . "/admin/" . $path);

        }
        else header("Location:" . ROOT . "");
    }

    public function edit_page($id=0){ 
        if($id<1 || $id>9){
            header("Location:" . ROOT . "/admin");
        }
        require_once dirname(__FILE__,2) . '/core/database.php';
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

        $this->view('admin/edit_page', ['editingId' => $id,'storedValue' => $pageContent, 'page'=>$id]);
    }

    public function index(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        require_once dirname(__FILE__,2) . '/core/database.php';

        $query="SELECT i.name AS item, m.name AS manufacturer
        FROM items i 
            INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
            INNER JOIN manufacturers m ON m.id=mc.id_manufacturer LIMIT 5";
        $result = $db->query($query);
        $items = $result->fetchAll(PDO::FETCH_ASSOC);

        $query="SELECT Count(name)
        FROM `items`";
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

        $this->view('admin/index', ['items'=>$items, 'itemsCount'=>$itemsCount, 'catalogs'=>$catalogs, 'catalogsCount'=>$catalogsCount,
        'attributes'=>$attributes, 'attributesCount'=>$attributesCount, 'manufacturers'=>$manufacturers, 
        'manufacturersCount'=>$manufacturersCount,'categories'=>$categories, 'categoriesCount'=>$categoriesCount]);
    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////USERS/////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function list_of_users(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
        $query="SELECT id, name, lastName, email, login, password FROM users WHERE role='user' ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        $this->view('admin/list_of_users', ['usersArray'=>$result]);

    }

    public function edit_user($id){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
        $query="SELECT id, name, lastName, email, login, password, role FROM users WHERE id=:id";
        $result = $db->prepare($query);
        $result->bindParam(':id', $id);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $name = $result["name"];
        $lastName = $result["lastName"];
        $email = $result["email"];
        $login = $result["login"];
        $password = '';
        $role = $result["role"];
        if(isset($_POST['senduser']))
        {
            $query = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
            $result = $db->prepare($query);
            $result->execute();
            $result = $result->fetch(PDO::FETCH_ASSOC);;

            $name = ucfirst(strtolower($_POST['name']));
            $lastName = ucfirst(strtolower($_POST['surname']));
            $email = $_POST['mail'];
            $login = strtolower($_POST['login']);
            $password = $_POST['pass'];
            $role = "user";
            $temporary = 1;
            $authhash = hash('sha256',$name . $lastName . $email . $login . $role . $result['id']);

            if(empty($password)){
                $length = 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                for ($i = 0; $i < $length; $i++) {
                    $password.= $characters[rand(0, $charactersLength - 1)];
                }
            }
            if(empty($name) || empty($lastName) || empty($email) || empty($login)){
                $_SESSION['error_page'] = "edit_user";
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
                    $_SESSION['error_page'] = "edit_user";
                    header("Location:" . ROOT . "/admin/error_page/2");
                }
                else{
                    $query = "INSERT INTO `users` (name, lastname, email, login, password, role, temporary, authhash) 
                    VALUES (:name, :lastname, :email, :login, :password, :role, :temporary, :authhash);";
                    $result = $db->prepare($query);
                    $result->bindParam(':name', $name);
                    $result->bindParam(':lastname', $lastName);
                    $result->bindParam(':email', $email);
                    $result->bindParam(':login', $login);
                    $result->bindParam(':password', $hashedPassword);
                    $result->bindParam(':role', $role);
                    $result->bindParam(':temporary', $temporary);
                    $result->bindParam(':authhash', $authhash);
                    $result->execute();
                     
                    $_SESSION['success_page'] = "edit_user";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }            
            }
        }
        $this->view('admin/edit_user', ['name'=>$name, 'surname'=>$lastName, 'mail'=>$email, 'login'=>$login, 'pass'=>$password, 'role'=>$role]);
    }

    public function add_user(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
        $name = '';
        $lastName = '';
        $email = '';
        $login = '';
        $password = '';
        if(isset($_POST['senduser']))
        {
            $adminPass = false;

            $query = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
            $result = $db->prepare($query);
            $result->execute();
            $result = $result->fetch(PDO::FETCH_ASSOC);;

            $name = ucfirst(strtolower($_POST['name']));
            $lastName = ucfirst(strtolower($_POST['surname']));
            $email = $_POST['mail'];
            $login = strtolower($_POST['login']);
            $password = $_POST['pass'];
            $role = "user";
            if(isset($_POST['userActivated'])){
                $temporary = 0;
                $authhash = NULL;
                $adminPass = true;
            }else{
                $temporary = 1;
                $authhash = hash('sha256',$name . $lastName . $email . $login . $role . $result['id']);
            }
            
            if(empty($password)){
                $length = 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                for ($i = 0; $i < $length; $i++) {
                    $password.= $characters[rand(0, $charactersLength - 1)];
                }
            }
            if(empty($name) || empty($lastName) || empty($login) || ($adminPass==false) && empty($email)){
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
                    $query = "INSERT INTO `users` (name, lastname, email, login, password, role, temporary, authhash) 
                    VALUES (:name, :lastname, :email, :login, :password, :role, :temporary, :authhash);";
                    $result = $db->prepare($query);
                    $result->bindParam(':name', $name);
                    $result->bindParam(':lastname', $lastName);
                    $result->bindParam(':email', $email);
                    $result->bindParam(':login', $login);
                    $result->bindParam(':password', $hashedPassword);
                    $result->bindParam(':role', $role);
                    $result->bindParam(':temporary', $temporary);
                    $result->bindParam(':authhash', $authhash);
                    $result->execute();
                    if($adminPass == false){
                        $path = PUBLICPATH;
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
                        <a href='$path/userverify/$authhash'>Link aktywacyjny</a>
                        <br>
                        <br>
                        <p> Masz 48h na aktywację konta, po tym czasie konto zostanie usunięte. </p>
                        </body>
                        </html>";
        
                        $mail->send();
                    } catch(Exception $e){
                        echo "<script>alert('Błąd wysyłania maila!')</script>";
                    }
                }
                    $_SESSION['success_page'] = "add_user";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }            
            }
        }
        $this->view('admin/add_user', ['name'=>$name, 'surname'=>$lastName, 'mail'=>$email, 'login'=>$login, 'pass'=>$password]);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////MANAGERS//////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function list_of_content_managers(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }
        
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
        $query="SELECT id, name, lastName, email, login, password FROM users WHERE role='contentmanager' ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->view('admin/list_of_conent_managers', ['usersArray'=>$result]);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////ADMINS////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function list_of_administrators(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }
            else{
                header("Location:" . ROOT . "/home");
            }
        }
        else{
            header("Location:" . ROOT . "/login");
        }
        
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT id, name, lastName, email, login, password FROM users WHERE role='admin' ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->view('admin/list_of_administrators', ['usersArray'=>$result]);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////ATRRIBUTES////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function list_of_attributes()
    {
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT * FROM `attributes` ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);    

        $rmCatPath=ROOT."/admin/remove_attribute";
        $editCatPath=ROOT."/admin/edit_attribute";
        $this->view('admin/list_of_attributes', ['attributesArray'=>$result, 'rmpath'=> $rmCatPath, 'editpath'=> $editCatPath]);
    }

    public function edit_attribute($id_a=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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

                $query="SELECT id, COUNT(id) FROM attributes WHERE name=:attr";
                $result = $db->prepare($query);
                $result->bindParam(':attr', $attribute);
                $result->execute();
                $attr_id=$result->fetch(PDO::FETCH_ASSOC);
                $temp = $attr_id['COUNT(id)'];
                if($temp>0&&$attr_id['id']!=$id_a){
                    $_SESSION['error_page'] = "list_of_attributes";
                    header("Location:" . ROOT . "/admin/error_page/2");
                }else{
                    $query = "UPDATE `attributes` 
                        SET name = '$tekst2' 
                        WHERE id = '$id_a';";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "list_of_attributes";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }

            }else{
                $_SESSION['error_page'] = "list_of_attributes";
                header("Location:" . ROOT . "/admin/error_page/1");
            }
        }else{
            header("Location:" . ROOT . "/admin/list_of_attributes");
        }
    }

    public function remove_attribute($id_a=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
    
        header("Location:" . ROOT . "/admin/list_of_attributes");
    }

    public function remove_item($id_a=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        if(isset($id_a)){
            require_once dirname(__FILE__,2) . '/core/database.php';
            $query="DELETE FROM items WHERE id=:id_a";
            $result = $db->prepare($query);
            $result->bindParam(':id_a', $id_a);
            $result->execute();

            $imagePathCheck = RESOURCEPATH . "/[" . $id_a. "].png";

            if(file_exists($imagePathCheck)) unlink($imagePathCheck);
        }
    
        header("Location:" . ROOT . "/admin/list_of_items");
    }

    public function list_of_orders(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        $this->view('admin/list_of_orders', []);
    }

    /** Function that add attributes
    * @author Ur_mum
    */
    public function add_attribute(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        } 

        require_once dirname(__FILE__,2) . '/core/database.php';
        $tekst2 = "";
        if(isset($_SESSION['successOrErrorResponse'])){
            if($_SESSION['successOrErrorResponse'] == "add_attribute"){
                if(isset($_SESSION['attributeName'])) {$tekst2 = $_SESSION['attributeName']; unset($_SESSION['attributeName']);} 
            }
            unset($_SESSION['successOrErrorResponse']);
        }

        if(isset($_POST['attrEditSub'])){
            if(!empty($_POST['attribute'])){
            
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
                }else{
                    $query = "INSERT INTO `attributes` (name) VALUES ('$tekst2');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "add_attribute";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_attribute";
                header("Location:" . ROOT . "/admin/error_page/1");
            }
        }else{
        $this->view('admin/add_attribute_admin', ['attribute' => $tekst2]);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////CATALOGS//////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function add_catalog(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
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
                    $_SESSION['success_page'] = "add_catalog";
                    unset($_SESSION['catname']);
                    header("Location:" . ROOT . "/admin/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_catalog";
                header("Location:" . ROOT . "/admin/error_page/1");
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
        
        $this->view('admin/add_catalog_admin', ['items'=>$items, 'msg_color' => $return_msg_color , 'msg' => $return_msg, 'catname' => $catname, 'itemcat'=> $itemstocat]);
    }

    public function list_of_catalogs(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        
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
                        header("Location:" . ROOT . "/admin/error_page/2");
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
                        header("Location:" . ROOT . "/admin/success_page/1");
                    }
                }else{
                    $_SESSION['error_page'] = "list_of_catalogs";
                    header("Location:" . ROOT . "/admin/error_page/1");
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
 
        $rmCatPath=ROOT."/admin/";

        $this->view('admin/list_of_catalogs', ['catalogsArray'=>$result, 'catalogsItems'=>$itemsInCat,'items'=>$items ,'rmpath'=> $rmCatPath]);
    }

    public function remove_catalog($cid=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
        header("Location:" . ROOT . "/admin/list_of_catalogs");
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////MANUFACTURERS/////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function add_manufacturer(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
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
                    header("Location:" . ROOT . "/admin/error_page/2");
                }else{
                    $query = "INSERT INTO `manufacturers` (name) VALUES ('$manufacturerName');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "add_manufacturer";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_manufacturer";
                header("Location:" . ROOT . "/admin/error_page/1");
            }
        }else{
            $this->view('admin/add_manufacturer_admin', ['manufacturer' => $manufacturerName]);
        }
    }

    public function add_countries_to_manufacturer(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
                header("Location:" . ROOT . "/admin/success_page/1");
                
            }
            else{
                $_SESSION['error_page'] = "add_countries_to_manufacturer";
                header("Location:" . ROOT . "/admin/error_page/1");
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

        $this->view('admin/add_countries_to_manufacturer_admin', ['countries'=>$countries, 'manufacturers'=>$manufacturers, 'msg_color' => $return_msg_color ,
        'msg' => $return_msg, 'manufacturername' => $manufacturername, 'selCountries'=> $selCountries, 'mnf_countries'=>$mnfCountries]);
    }

    public function list_of_manufacturers(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
                    header("Location:" . ROOT . "/admin/error_page/2");
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
                    header("Location:" . ROOT . "/admin/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "list_of_manufacturers";
                header("Location:" . ROOT . "/admin/error_page/1");
            }
        }

        $rmPath=ROOT."/admin/remove_manufacturer";
        //$editPath=ROOT."/admin/edit_category";

        $this->view('admin/list_of_manufacturers',['mnfArray'=> $manufacturers, 'mnfCts'=> $mnfCountries,
         'rmpath'=> $rmPath, 'countries'=>$resultCnt]);

    }


    public function remove_manufacturer($id_manuf=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
    
        header("Location:" . ROOT . "/admin/list_of_manufacturers");
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////ITEMS/////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function add_item(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        
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
                if (!move_uploaded_file($tmpname, RESOURCEPATH . "/" . $imagename)) {
                    $_SESSION['error_page'] = "list_of_items";
                    header("Location:" . ROOT . "/admin/error_page/3");
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
                    $query="SELECT id FROM attributes WHERE name=:attr_name";
                    $result = $db->prepare($query);
                    $result->bindParam(':attr_name', $_POST["attribute_name" . $i]);
                    $result->execute();
                    $attr_id=$result->fetch(PDO::FETCH_ASSOC); 

                    $query="INSERT INTO attributesofitems (id_item, id_attribute, value) 
                    VALUES (:id_item, :id_attribute, :in_value)";
                    $result = $db->prepare($query);
                    $result->bindParam(':id_item',$item_id);
                    $result->bindParam(':id_attribute',$attr_id['id']);
                    $result->bindParam(':in_value',$_POST["attribute_value" . $i]);
                    $result->execute();

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
                header("Location:" . ROOT . "/admin/success_page/1");

            }else{
                $_SESSION['error_page'] = "list_of_items";
                header("Location:" . ROOT . "/admin/error_page/1");
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

        
        $this->view('admin/add_item_admin', ['items'=>$result, 'attributes' => $result2, 'categories'=>$categories, 
        'selCategories'=>$selCategories]);
        
    }

    public function edit_item($editId){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
    
        require_once dirname(__FILE__,2) . '/core/database.php';
        
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

                $imagePathCheck = RESOURCEPATH . "/[" . $item_id. "].png";

                if(file_exists($imagePathCheck)) unlink($imagePathCheck);
                $path = $_FILES['formFile']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $imagename = "[" . $item_id . "]." . $ext;    
                $tmpname = $_FILES['formFile']['tmp_name'];
                if (!move_uploaded_file($tmpname, RESOURCEPATH . "/" . $imagename)) {
                    $_SESSION['error_page'] = "list_of_items";
                    header("Location:" . ROOT . "/admin/error_page/3");
                }

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
                        if($_POST["attrId" . $i] != 0){
                            echo "<script>alert('test')</script>";
                            $query="UPDATE attributesofitems SET id_attribute=:id_attr, value=:val WHERE id=:id";
                            $result = $db->prepare($query);
                            $result->bindParam(':id_attr',$_POST["attribute_name" . $i]);
                            $result->bindParam(':val',$_POST["attribute_value" . $i]);
                            $result->bindParam(':id',$_POST["attrId" . $i]);
                            $result->execute();
                            array_push($remainingAttrID, $_POST["attrId".$i]);
                        }else{
                            $query="INSERT INTO attributesofitems (id_item, id_attribute, value) VALUES (:id_item, :id_attr, :val)";
                            $result = $db->prepare($query);
                            $result->bindParam(':id_attr',$_POST["attribute_name" . $i]);
                            $result->bindParam(':val',$_POST["attribute_value" . $i]);
                            $result->bindParam(':id_item',$editId);
                            $result->execute();
                            $aId = $db->lastInsertId();
                            array_push($remainingAttrID, $aId);
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
                            echo "<script>alert('test')</script>";
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
                
                $_SESSION['success_page'] = "list_of_items";
                header("Location:" . ROOT . "/admin/success_page/2");

            }
            else{
                $_SESSION['error_page'] = "list_of_items";
                header("Location:" . ROOT . "/admin/error_page/2");
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

        $imagePath = APPPATH . "/resources/[" . $editId . "].png";
        $imagePathCheck = RESOURCEPATH . "/[" . $editId . "].png";

        if(!file_exists($imagePathCheck)){
            $imagePath = APPPATH . "/resources/brak_zdjecia.png";
        }

        $this->view('admin/edit_item_admin', ['items'=>$items, 'attributes' => $attributes, 'categories'=>$categories, 
        'selCategories'=>$prevCtg, 'prevItems'=>$prevItems, 'prevCtg'=>$prevCtg, 'prevAttr'=>$prevAttr, 
        'prevDesc'=>$prevDesc, 'imagePath'=>$imagePath]);
        
    }

    public function list_of_items(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';

        $query="SELECT i.id AS iid, i.name AS itemName, m.name AS manufacturerName, 
        c.name AS manufacturerCountry, i.amount AS amount, i.price AS price
        FROM items i 
            INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
            INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
            INNER JOIN countries c ON mc.id_country=c.id";
        $result = $db->query($query);
        $items = $result->fetchAll(PDO::FETCH_ASSOC);

        $queryCateg="SELECT c.name AS categname
        FROM items i 
        INNER JOIN categoriesofitem coi ON i.id=coi.id_item
        INNER JOIN categories c ON coi.id_category=c.id
        WHERE i.id=:iid";

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
        
        $editItemPath=ROOT."/admin/edit_item";
        $removeItemPath=ROOT."/admin/remove_item";
        
        $this->view('admin/list_of_items', ['itemsArray' => $items, 'categoriesArray' => $categoriesArray, 
        'catalogArray' => $catalogArray, 'attrArray' => $attrArray, 'editItemPath' => $editItemPath, 'removeItemPath' => $removeItemPath]);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////CATEGORIES////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
    public function add_category(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
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
                    header("Location:" . ROOT . "/admin/error_page/2");
                }else{
                    $query = "INSERT INTO `categories` (name) VALUES ('$tekst2');";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "add_category";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "add_category";
                header("Location:" . ROOT . "/admin/error_page/1");
            }
        }else{
            $this->view('admin/add_category_admin', ['category' => $tekst2]);
        }
    }


    public function list_of_categories()
    {
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT * FROM `categories` ORDER BY id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC); 

        $rmCatPath=ROOT."/admin/remove_category";
        $editCatPath=ROOT."/admin/edit_category";
        $this->view('admin/list_of_categories', ['categoriesArray'=>$result, 'rmpath'=> $rmCatPath, 'editpath'=> $editCatPath]);
    }


    public function edit_category($id_categ=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
                    header("Location:" . ROOT . "/admin/error_page/2");
                }else{
                    $query = "UPDATE `categories` 
                        SET name = '$tekst2' 
                        WHERE id = '$id_categ';";
                    $result = $db->prepare($query);
                    $result->execute();
                    $_SESSION['success_page'] = "list_of_categories";
                    header("Location:" . ROOT . "/admin/success_page/1");
                }
            }else{
                $_SESSION['error_page'] = "list_of_categories";
                header("Location:" . ROOT . "/admin/error_page/1");
            }
        }else{
            header("Location:" . ROOT . "/admin/list_of_categories");
        }
    }

    public function remove_category($id_categ=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){
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
    
        header("Location:" . ROOT . "/admin/list_of_categories");
    }


    public function edit_footer(){
        require_once dirname(__FILE__,2) . '/core/database.php';
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
            header("Location:" . ROOT . "/admin/success_page/2");
        }

        $query="SELECT * FROM footer LIMIT 1";
        $result = $db->prepare($query);
        $result->execute();
        $result=$result->fetch(PDO::FETCH_ASSOC);

        $this->view('admin/edit_footer', ['result' => $result]);
    }

    public function logout(){
        unset($_SESSION['loggedUser']);
        header("Location:" . ROOT . "/login");
    }
}
?>
