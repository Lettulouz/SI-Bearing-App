<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>


<div class="homeMain">

<?php
echo "<h1> it itemku: ";
echo  $data['id'];
echo "</h1>";
?>

</div>
<?php //include "sidebar_top.php"; ?>
<?php //include "sidebar_bottom.php"; ?> 


<?php include dirname(__FILE__,2) . "/footer.php"; ?>
