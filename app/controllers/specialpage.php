<?php

class SpecialPage extends Controller
{
    public function index($id){
        if($id<1 || $id>9){
            header("Location:" . ROOT . "/home");
        }
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);

        $query="SELECT content FROM pages WHERE id=$id";
        $result = $db->prepare($query);
        $result->execute();
        $pageContent = $result->fetch(PDO::FETCH_ASSOC);
        !empty($pageContent) ? $pageContent = $pageContent['content'] : $pageContent = "";    

        $this->view("specialpage", ['siteFooter' => $siteFooter, 'pageContent' => $pageContent]);
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
}