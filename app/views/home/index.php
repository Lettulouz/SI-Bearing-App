<?php include "header.php"; ?>

    <h1>Hello World</h1>
    <br>
    <?=$data['message']?>
    <?php echo CSSPATH; ?>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>