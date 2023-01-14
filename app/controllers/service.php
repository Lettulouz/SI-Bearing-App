<?php

use PHPMailer\PHPMailer\PHPMailer;

class Service extends Controller
{
    /** the function responsible for displaying the success page for various operations performed in the application
     * @param {int} is responsible for determining what type of operation has been performed
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
            else if($sid==4){
                $firstLine = "Zmieniono status";
                $secondLine = "pomyślnie!";
            }
            $this->view('success_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            header("Refresh: 1; url=" . ROOT . "/service/" . $path);
        }
        else header("Location:" . ROOT . "");
    }

    /** the function responsible for displaying the error page, which is generated in the event of a failure while performing an operation on the data
     * @param {int} is the error ID that determines the error message to be displayed on the page
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
            $this->view('error_page', ['firstLine' => $firstLine, 'secondLine' => $secondLine]);
            $_SESSION['successOrErrorResponse'] = $path;
            header("Refresh: 1; url=" . ROOT . "/service/" . $path);

        }
        else header("Location:" . ROOT . "");
    }

    /** function checks if the user is logged in and if his role is "shopservice"
     * 
     */
    public function index(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "shopservice"){
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

        $query="SELECT COUNT(id) as c FROM orders WHERE orderdate > (SELECT NOW()- interval 7 DAY)";
        $result = $db->query($query);
        
        $ordersLast7Count = $result->fetch(PDO::FETCH_ASSOC);
        $ordersLast7Count = $ordersLast7Count['c'];

        $query="SELECT COUNT(id) as c FROM orders";

        $result = $db->query($query);
        
        $ordersTotalCount = $result->fetch(PDO::FETCH_ASSOC);
        $ordersTotalCount = $ordersTotalCount['c'];

        $this->view('service/index', ['siteLinks'=>$siteLink, 'ordersLast7Count' => $ordersLast7Count, 'ordersTotalCount' => $ordersTotalCount]);
    }

    /** function takes the user to the page with the list of orders, if the user is logged in and is the service provider of the store
     * 
     */
    public function list_of_orders(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "shopservice"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteLink = $this->getFooter($db);

        if(isset($_POST['stateSubmit'])){
           if(!empty($_POST['orderid'])){
                $query="UPDATE orders SET trackingnumber=:trackingnumber, orderstate=:orderstate
                WHERE id=:id";
                $result = $db->prepare($query);
                $result->bindParam(':trackingnumber',$_POST['trackingnumber']);
                $result->bindParam(':orderstate',$_POST['orderstate']);
                $result->bindParam(':id',$_POST['orderid']);
                $result->execute();
                $_SESSION['success_page'] = "list_of_orders";
                header("Location:" . ROOT . "/service/success_page/4");
           }else{
            $_SESSION['error_page'] = "list_of_orders";
            header("Location:" . ROOT . "/service/error_page/1");
           }

      }

        $query="SELECT o.*, sm.name AS smName, u.login AS user, u.email FROM orders o
        INNER JOIN shippingmethods sm ON o.id_shippingmethod=sm.id
        INNER JOIN users u ON u.id=o.id_user
        ORDER BY orderdate DESC";
        $orders = $db->prepare($query);
        $orders->execute();
        $orders = $orders->fetchAll(PDO::FETCH_ASSOC);

        $queryItems="SELECT i.name AS item, m.name AS mnf,
        c.name AS country, iio.amount AS amount, i.price AS price
        FROM orders o 
        INNER JOIN itemsinorder iio ON o.id=iio.id_order
        INNER JOIN items i ON i.id=iio.id_item
        INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
        INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
        INNER JOIN countries c ON mc.id_country=c.id 
        WHERE o.id=:iid";

        $OrderItems=array();

        foreach($orders as $id){
            $result = $db->prepare($queryItems);
            $result->bindParam(':iid', $id['id']);
            $result->execute();
            $result =  $result->fetchAll(PDO::FETCH_ASSOC);
            $OrderItems[$id['id']]= $result;
        }

        $orderpath="/service/";

        $this->view('service/list_of_orders', ['siteLinks'=>$siteLink, 'orders'=>$orders, 'orderItems'=>$OrderItems, 'orderpath'=>$orderpath]);
    }

    /** function used to generate a sales report
     * 
     */
    public function sales_report(){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "shopservice"){
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

        $amount='';
        $earnings='';
        $selling='';

        if(isset($_POST['reportSub'])){;
            if(!empty($_POST['dateFrom'])&&!empty($_POST['dateTo'])){
            $query="SELECT SUM(amount) FROM itemsinorder iio
            INNER JOIN orders o on o.id=iio.id_order
            WHERE orderdate BETWEEN :dateFrom AND :dateTo";
            $result=$db->prepare($query);
            $result->bindParam(':dateFrom', $_POST['dateFrom']);
            $result->bindParam(':dateTo', $_POST['dateTo']);
            $result->execute();
            $amount=$result->fetchAll(PDO::FETCH_ASSOC);
            $amount=$amount[0]['SUM(amount)'];
            if(empty( $amount)){
                $amount=0;
            }

            $query="SELECT SUM(iio.amount*i.price) FROM itemsinorder iio
            INNER JOIN orders o on o.id=iio.id_order
            INNER JOIN items i on i.id=iio.id_item
            WHERE orderdate BETWEEN :dateFrom AND :dateTo";
            $result=$db->prepare($query);
            $result->bindParam(':dateFrom', $_POST['dateFrom']);
            $result->bindParam(':dateTo', $_POST['dateTo']);
            $result->execute();
            $earnings=$result->fetchAll(PDO::FETCH_ASSOC);
            $earnings= $earnings[0]['SUM(iio.amount*i.price)'];
            if(empty( $earnings)){
                $earnings=0;
            }

            $query="SELECT i.name AS item, i.price AS price,
             m.name AS mnf, c.name AS country, SUM(i.price*iio.amount) AS earnings, SUM(iio.amount) AS sellAmount
            FROM items i
            INNER JOIN itemsinorder iio ON i.id = iio.id_item
            INNER JOIN orders o ON o.id=iio.id_order
            INNER JOIN manufacturercountries mc on mc.id=i.id_manufacturercountry
            INNER JOIN manufacturers m on m.id=mc.id_manufacturer
            INNER JOIN countries c on c.id=mc.id_country
            WHERE orderdate BETWEEN :dateFrom AND :dateTo
            GROUP BY i.name
            ORDER BY SUM(iio.amount) DESC";
            $result=$db->prepare($query);
            $result->bindParam(':dateFrom', $_POST['dateFrom']);
            $result->bindParam(':dateTo', $_POST['dateTo']);
            $result->execute();
            $selling=$result->fetchAll(PDO::FETCH_ASSOC);

            }
            else{
                $_SESSION['error_page'] = "sales_report";
                header("Location:" . ROOT . "/service/error_page/1");
            }
        }

        $this->view('service/sales_report', ['siteLinks'=>$siteLink, 'amount'=>$amount, 'earnings'=>$earnings, 'selling'=> $selling]);
    }

    /** function responsible for displaying order details from the database
     * @param {int} is responsible for passing the order ID to the function
     */
    public function orderview($order_id=NULL){
        if(isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "shopservice"){
                unset($_SESSION['successOrErrorResponse']);
            }else{
                header("Location:" . ROOT . "/home");
            }
        }else{
            header("Location:" . ROOT . "/login");
        }

        if($order_id==NULL){
            header("Location:" . ROOT . "/service");
        }

        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);   

        $itemsInOrder = NULL;

        $o_id = $order_id;

        if(!is_numeric($order_id))
            $o_id  = 0;
        
        
        $query="SELECT i.id as itemID, iio.amount as itemAmount, i.price as itemPrice, i.name as itemName, m.name as itemManName
        FROM orders o 
        INNER JOIN itemsinorder iio ON o.id=iio.id_order 
        INNER JOIN items i ON iio.id_item=i.id
        INNER JOIN manufacturercountries mc ON i.id_manufacturercountry=mc.id
        INNER JOIN manufacturers m ON mc.id_manufacturer=m.id
        WHERE o.id=:id_order";

        $itemsInOrder = $db->prepare($query);
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
        WHERE o.id=:id_order";

        $result = $db->prepare($query);
        $result->bindParam(':id_order', $o_id);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);

        $totalOrderPrice = $result['orderPrice'] +  $result['shippingPrice'] + $result['paymentFee'];

        if(empty($itemsInOrder) || empty($result)){
            header("Location:" . ROOT . "/service/list_of_orders");
            return;
        }

        $orderpath="/service/";

        $this->view('service/orderview', ['siteLinks' => $siteFooter,
        'itemsArray'=>$itemsInOrder, 'orderInfo' => $result, 'totalOrderPrice'=>$totalOrderPrice, 'orderpath'=>$orderpath]);
 
    }

    /** private function that returns footer information from the database
     * @param {PDO} an object representing a database connection
     * @return Returns array, which contains footer information
     */
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

    /** function responsible for logging out the user
    * 
    */
    public function logout(){
        unset($_SESSION['loggedUser']);
        header("Location:" . ROOT . "/login");
    }

    }
