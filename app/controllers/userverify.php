<?php

class UserVerify extends Controller
{
    
    /** function used to verify the user's account
     * @param {string} is a unique code used to verify the user's account
     */
    public function index($hash){
        $success = 0;

        require_once dirname(__FILE__,2) . '/core/database.php';
        $query = "SELECT id FROM users WHERE authhash=:authhash";
        $result = $db->prepare($query);
        $result->bindParam(':authhash',$hash);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);
        if(isset($result['id']) && $result['id']>0){
            $id = $result['id'];
            $query = "UPDATE users SET temporary=0, authhash=NULL WHERE id=:id";
            $result = $db->prepare($query);
            $result->bindParam(':id',$id);
            $result->execute();
            $success = 1;
        }
        $this->view('userverify', ['success' => $success]);
    }
}

