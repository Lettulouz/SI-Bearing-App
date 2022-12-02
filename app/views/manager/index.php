<?php
include 'mng_nav.php';

?>

<div class="container-fluid">
<p class="mb-0"><a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
            data-bs-toggle="collapse" href="#dashcollapse2" role="button" aria-expanded="true" aria-controls="dashcollapse2">Produkty
        <span class="bi bi-chevron-down right-icon ms-auto"></span>
    </a></p>
        <div class="collapse collapse show" id="dashcollapse2">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-primary mb-3 h-100" >
                        <div class="card-header"><i class="bi bi-box-seam-fill"></i>&nbspProdukty
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_item"?>" >
                                <i class="bi bi-plus-lg"></i></a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Produktów: [ilość]</h5>
                            <p class="card-text">Tu kilka nazw produktów, jeżeli się wszyscy nie mieszczą to na końcu ...</p>
                        </div>
                        <a href="<?php echo ROOT."/manager/list_of_products"?>" id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj produkty
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-custom-3 mb-3 h-100" >
                <div class="card-header"><i class="bi bi-journals"></i>&nbspKatalogi
                    <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_catalog"?>" >
                        <i class="bi bi-plus-lg"></i></a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Katalogów: [ilość]</h5>
                    <p class="card-text">Tutaj kilka nazw katalogów, jeżeli się wszystkie nie mieszczą to na końcu ...</p>
                </div>
                <a href="<?php echo ROOT."/manager/list_of_catalogs"?>" id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj katalogi
                    </div>
                </a>
            </div>    
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-custom-1 mb-3 h-100" >
                <div class="card-header"><i class="bi bi-journal-richtext"></i>&nbspAtrybuty
                    <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_attribute"?>" >
                        <i class="bi bi-plus-lg"></i></a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Atrybutów: [ilość]</h5>
                    <p class="card-text">Tutaj kilka nazw atrybutów, jeżeli się wszystkie nie mieszczą to na końcu ...</p>
                </div>
                <a href="<?php echo ROOT."/manager/list_of_attributes"?>" id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj atrybuty
                    </div>
                </a>
            </div>    
        </div>

</div>



<script>
    document.getElementById('gotomngmain').setAttribute( 'style', 'color:white !important' );
</script>

<?php
include 'mng_feet.php';

?>