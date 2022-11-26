<?php
include 'adm_nav.php';

?>
<div class="container-fluid">
    <a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
            data-bs-toggle="collapse" href="#dashcollapse1" role="button" aria-expanded="true" aria-controls="dashcollapse1">Użytkownicy
        <span class="bi bi-chevron-down right-icon ms-auto"></span>
    </a>
    <div class="collapse collapse show" id="dashcollapse1">
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-success mb-3 h-100" >
                        <div class="card-header"><i class="bi bi-person-fill"></i>&nbspUżytkownicy</div>
                        <div class="card-body">
                            <h5 class="card-title">Użytkowników: [ilość]</h5>
                            <p class="card-text">Tu kilka nazw użytkowników, jeżeli się wszyscy nie mieszczą to na końcu ...</p>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_users"?> id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj użytkowników
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-warning mb-3 h-100" >
                <div class="card-header"><i class="bi bi-person-fill-gear"></i>&nbspMenadżerowie contentu</div>
                <div class="card-body">
                    <h5 class="card-title">Menadżerów: [ilość]</h5>
                    <p class="card-text">Tutaj nicki menadżerów</p>
                </div>
                <a href=<?php echo ROOT."/admin/list_of_content_managers"?> id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj menadżerów contentu
                    </div>
                </a>
            </div>    
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-danger mb-3 h-100" >
                <div class="card-header"><i class="bi bi-person-vcard"></i>&nbspAdministratorzy</div>
                <div class="card-body">
                    <h5 class="card-title">Administratorów: [ilość]</h5>
                    <p class="card-text">Tutaj nicki administratorów</p>
                </div>

                    <a href=<?php echo ROOT."/admin/list_of_administrators"?> id="orders_lists" class="nav-link text-white p-0">
                        <div class="card-footer p-3">
                                    Przeglądaj adminstratorów
                        </div>
                    </a>

            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-custom-2 mb-3 h-100" >
                <div class="card-header"><i class="bi bi-cart4"></i>&nbspZamówienia</div>
                <div class="card-body">
                    <h5 class="card-title">Zamówień: [ilość]</h5>
                    <p class="card-text">Zamówień w ciągu ostanich 7 dni: </p>
                </div>
                <a href=<?php echo ROOT."/admin/list_of_orders"?> id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj zamówienia
                    </div>
                </a>
            </div>
    </div>
</div>
</div>
    <!-- Second row on xl -->
    <p><a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
            data-bs-toggle="collapse" href="#dashcollapse2" role="button" aria-expanded="true" aria-controls="dashcollapse2">Produkty
        <span class="bi bi-chevron-down right-icon ms-auto"></span>
    </a></p>
        <div class="collapse collapse show" id="dashcollapse2">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-primary mb-3 h-100" >
                        <div class="card-header"><i class="bi bi-gear-fill"></i></i>&nbspProdukty</div>
                        <div class="card-body">
                            <h5 class="card-title">Produktów: [ilość]</h5>
                            <p class="card-text">Tu kilka nazw produktów, jeżeli się wszyscy nie mieszczą to na końcu ...</p>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_products"?> id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj produkty
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-custom-3 mb-3 h-100" >
                <div class="card-header"><i class="bi bi-journals"></i>&nbspKatalogi</div>
                <div class="card-body">
                    <h5 class="card-title">Katalogów: [ilość]</h5>
                    <p class="card-text">Tutaj kilka nazw katalogów, jeżeli się wszystkie nie mieszczą to na końcu ...</p>
                </div>
                <a href=<?php echo ROOT."/admin/list_of_orders"?> id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj katalogi
                    </div>
                </a>
            </div>    
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-custom-1 mb-3 h-100" >
                <div class="card-header"><i class="bi bi-clipboard-data-fill"></i>&nbspAtrybuty</div>
                <div class="card-body">
                    <h5 class="card-title">Atrybutów: [ilość]</h5>
                    <p class="card-text">Tutaj kilka nazw atrybutów, jeżeli się wszystkie nie mieszczą to na końcu ...</p>
                </div>
                <a href=<?php echo ROOT."/admin/list_of_attributes"?> id="orders_lists" class="nav-link text-white p-0">
                    <div class="card-footer p-3">
                                Przeglądaj atrybuty
                    </div>
                </a>
            </div>    
        </div>
        
      </div>
    </div>
</div>

<script>
    document.getElementById('gotoadmain').setAttribute( 'style', 'color:white !important' );
</script>



<?php
include 'adm_feet.php';

?>