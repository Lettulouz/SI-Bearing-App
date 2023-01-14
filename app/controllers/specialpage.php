<?php

class SpecialPage extends Controller
{
    /** function used to display the content of a special page based on the "id" parameter passed
     * @param {int} is the ID of the page to be displayed
     */
    public function index($id){
        if($id<1 || $id>9){
            header("Location:" . ROOT . "/home");
        }
        require_once dirname(__FILE__,2) . '/core/database.php';
        $siteFooter = $this->getFooter($db);
        $siteName = $this->getSiteName($db);

        $query="SELECT content FROM pages WHERE id=$id";
        $result = $db->prepare($query);
        $result->execute();
        $pageContent = $result->fetch(PDO::FETCH_ASSOC);
        !empty($pageContent) ? $pageContent = $pageContent['content'] : $pageContent = "";    

        $this->view("specialpage", ['siteFooter' => $siteFooter, 'pageContent' => $pageContent, 'siteName' => $siteName]);
    }

    /** private function that returns footer information from the database
     * @param {PDO} an object representing a database connection
     * @return Returns array, which contains footer information
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

    /** function is used to retrieve the page name from the database
     * @param {PDO} used to execute the SQL query
     * @return Returns array, associative, containing a single record from the siteinfo table containing the sitename field
     */
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
}