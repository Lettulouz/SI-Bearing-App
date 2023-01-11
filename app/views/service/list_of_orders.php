<?php
include 'srv_nav.php';

include dirname(__FILE__,2) . "/sale/list_of_orders.php";

?>

<script>
    document.getElementById('store_collapse').classList.add('show');
    document.getElementById('store_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('store_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('ord_list').setAttribute( 'style', 'color:white !important' );
</script>
<?php
include 'srv_feet.php';

?>