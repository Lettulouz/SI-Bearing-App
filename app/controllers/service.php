<?php

use PHPMailer\PHPMailer\PHPMailer;

class Service extends Controller
{
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

        $this->view('service/index', ['siteLinks'=>$siteLink]);
    }

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
        $this->view('service/list_of_orders', ['siteLinks'=>$siteLink]);
    }

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

            $query="SELECT SUM(iio.amount*price) FROM itemsinorder iio
            INNER JOIN orders o on o.id=iio.id_order
            INNER JOIN items i on i.id=iio.id_item
            WHERE orderdate BETWEEN :dateFrom AND :dateTo";
            $result=$db->prepare($query);
            $result->bindParam(':dateFrom', $_POST['dateFrom']);
            $result->bindParam(':dateTo', $_POST['dateTo']);
            $result->execute();
            $earnings=$result->fetchAll(PDO::FETCH_ASSOC);
            $earnings= $earnings[0]['SUM(iio.amount*price)'];
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

    public function logout(){
        unset($_SESSION['loggedUser']);
        header("Location:" . ROOT . "/login");
    }

    }
