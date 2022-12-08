<?php

use PHPMailer\PHPMailer\PHPMailer;

class Admin extends Controller
{
    public function success_page($sid){     
        if(isset($_SESSION['success_page'])){
            unset($_SESSION['success_page']);
            if($sid==1){
                $firstLine = "Dodano rekord";
                $secondLine = "pomyślnie!";
            }
            $this->view('success_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            $_SESSION['successOrErrorResponse'] = true;
            header("Refresh: 2; url=" . ROOT . "/admin/add_catalog");
        }
        else header("Location:" . ROOT . "");
    }

    public function error_page($sid){     
        if(isset($_SESSION['error_page'])){
            unset($_SESSION['error_page']);
            if($sid==1){
                $firstLine = "Nie podano nazwy";
                $secondLine = "";
            }
            if($sid==2){
                $firstLine = "Taki rekord już istnieje";
                $secondLine = "";
            }
            $this->view('error_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            $_SESSION['successOrErrorResponse'] = true;
            header("Refresh: 2; url=" . ROOT . "/admin/add_catalog");

        }
        else header("Location:" . ROOT . "");
    }

    public function index(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "admin"){

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
        $this->view('admin/list_of_users', []);
    }

    public function add_user(){
        $this->view('admin/add_user', []);
    }

    public function list_of_content_managers(){
        $this->view('admin/list_of_conent_managers', []);
    }

    public function list_of_administrators(){
        $this->view('admin/list_of_administrators', []);
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
        $query="SELECT name FROM `attributes` ORDER BY id";
        $result = $db->query($query);
        $attributesArray=array();
         foreach($result as $catalog){
            array_push($attributesArray, $catalog);
        }
        $this->view('admin/list_of_attributes', ['attributesArray'=>$attributesArray]);

    }

    public function list_of_catalogs(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $query="SELECT c.name, COUNT(iic.id_catalog) as amount
        FROM catalog c LEFT JOIN itemsInCatalog iic ON c.id=iic.id_catalog GROUP BY c.id";
        $result = $db->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        $this->view('admin/list_of_catalogs', ['catalogsArray'=>$result]);
    }

    public function list_of_orders(){
        $this->view('admin/list_of_orders', []);
    }

    /** Function that add attributes
    * @author Ur_mum
    */
    public function add_attribute(){

        require_once dirname(__FILE__,2) . '/core/database.php';


        if(isset($_POST['attribute']))
        {
            try{
                $config = require_once dirname(__FILE__,2) . '/core/mailerconfig.php';
                $mail = new PHPMailer();

                $mail->isSMTP();

                $mail->Host = $config['host'];
                $mail->Port = $config['port'];
                $mail->SMTPSecure =   PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";

                $mail->Username = $config['username'];
                $mail->Password = $config['password'];

                $mail->CharSet = 'UTF-8';
                $mail->setFrom($config['username'], 'Grontsmar');
                $mail->addAddress($config['addAddress']);
                $mail->addReplyTo($config['username'], 'Grontsmar');

                $mail->isHTML(true);
                $mail->Subject = 'Przykładowy tytuł wiadomości';
                $mail->Body = '<html>
                <head>
                  <title> Przykładowy nagłówek </title>
                </head>
                <body>
                <h1> Dzień dobry! </h1>
                <p> Na ten email zostało utworzone konto w sklepie Grontsmar. Oto dane: </p>
                </body>
                </html>';

                //$mail->addAttachment('ścieżka');

                $mail->send();
            } catch(Exception $e){
                echo "<script>alert('Błąd wysyłania maila!')</script>";
            }
             $attribute = $_POST['attribute'];
             $tekst1 = strtolower($attribute);
             $tekst2 = ucfirst($tekst1);
             $query = "INSERT INTO `attributes` (name) VALUES ('$tekst2');";
             $result = $db->prepare($query);
             $result->execute();
        }



        $this->view('admin/add_attribute_admin', []);
    }
/////////////////////////////////////////////////////////////////////////////
    public function add_catalog(){
        require_once dirname(__FILE__,2) . '/core/database.php';
        $catname = "";
        $itemstocat = "";

        if(isset($_SESSION['successOrErrorResponse'])){
            if(isset($_SESSION['catname'])) {$catname = $_SESSION['catname']; unset($_SESSION['catname']);} 
            if(isset($_SESSION['itemcat'])) {$itemstocat = $_SESSION['itemcat']; unset($_SESSION['itemcat']);} 

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
                    $_SESSION['error_page'] = true;
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
                $_SESSION['success_page'] = true;
                unset($_SESSION['catname']);
                header("Location:" . ROOT . "/admin/success_page/1");
                }
            }
            else{
                $_SESSION['error_page'] = true;
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
         $items=array();
         foreach($result as $item){
            array_push($items, $item);
        }
        
        $this->view('admin/add_item_admin', ['items'=>$items]);
        
    }

    public function logout(){
        unset($_SESSION['loggedUser']);
        header("Location:" . ROOT . "/login");
    }
}
?>