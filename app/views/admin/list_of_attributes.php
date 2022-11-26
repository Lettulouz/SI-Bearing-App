<?php
include 'adm_nav.php';

?>

<script>
    document.getElementById('content_collapse').classList.add('show');
    document.getElementById('content_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('content_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('attr_list').setAttribute( 'style', 'color:white !important' );
</script>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>