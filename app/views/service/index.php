<?php
include 'srv_nav.php';

?>

<div class="container-fluid">
<p class="mb-0"><a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
            data-bs-toggle="collapse" href="#dashcollapse2" role="button" aria-expanded="true" aria-controls="dashcollapse2">Zamówienia
        <span class="bi bi-chevron-down right-icon ms-auto"></span>
    </a></p>
    <div class="row">
            <div class="col-12 col-sm-6 col-xl-4 mb-3">
                <div class="card text-white bg-custom-2 h-100">
                    <div class="card-header">
                        <i class="bi bi-cart4"></i>&nbspZamówienia
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Zamówień: [ilość]</h5>
                        <p class="card-text">Zamówień w ciągu ostanich 7 dni: </p>
                    </div>
                    <a href=<?php echo ROOT."/service/list_of_orders"?> id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                        Przeglądaj zamówienia
                    </div>
                 </a>
             </div>
        </div>
    </div>
</div>        


<script>
    document.getElementById('gotosrvmain').setAttribute( 'style', 'color:white !important' );
</script>

<?php
include 'srv_feet.php';

?>