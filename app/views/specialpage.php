<?php 
include "login/loginHeader.php";
include dirname(__FILE__,1) . "/navbar_top.php"; 
?>
<div class="container-fluid">
    <div class="row m-1 mt-5 m-lg-5">
        <div class="col m-1 mt-5 mb-3 m-lg-5">
            <div class="card p-3" >
                <?php echo $data['pageContent']; ?>
            </div>
        </div>
    </div>
</div>
<?php
include dirname(__FILE__,1) . "/footer.php"; 
?>