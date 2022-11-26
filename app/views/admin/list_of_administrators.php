<?php
include 'adm_nav.php';

?>

<script>
    document.getElementById('users_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('users_collapse').classList.add('show');
    document.getElementById('administrators_lists').setAttribute( 'style', 'color:white !important' );
</script>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>