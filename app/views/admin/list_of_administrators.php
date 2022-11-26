<?php
include 'adm_nav.php';

?>

<script>
    document.getElementById('users_collapse').classList.add('show');
    document.getElementById('users_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('users_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('ad_list').setAttribute( 'style', 'color:white !important' );
</script>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>