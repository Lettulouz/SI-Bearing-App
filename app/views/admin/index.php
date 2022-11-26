<?php
include 'adm_nav.php';

?>
<div class="container-fluid">
    <a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
            data-bs-toggle="collapse" href="#dashcollapse1" role="button" aria-expanded="true" aria-controls="dashcollapse1">Użytkownicy
        <span class="bi bi-chevron-down right-icon ms-auto"></span>
    </a>
    <div class="collapse multi-collapse show" id="dashcollapse1">
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-4 mb-3">
                <div class="card text-white bg-success mb-3 h-100" >
                    <div class="card-header"><i class="bi bi-person-fill"></i>&nbspUżytkownicy</div>
                    <div class="card-body">
                        <h5 class="card-title">Użytkowników: [ilość]</h5>
                        <p class="card-text">Tu kilka nazw użytkowników, jeżeli się wszyscy nie mieszczą to na końcu ...</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href=<?php echo ROOT."/admin/list_of_users"?> id="user_lists" class="nav-link text-white">
                                    Przeglądaj użytkowników
                                </a>
                            </div>
                        <div class="col-12">  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-3">
        <div class="card text-white bg-warning mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-fill-gear"></i>&nbspMenadżerowie contentu</div>
            <div class="card-body">
                <h5 class="card-title">Menadżerów: [ilość]</h5>
                <p class="card-text">Tutaj nicki menadżerów</p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <a href=<?php echo ROOT."/admin/list_of_content_managers"?> id="content_managers_lists" class="nav-link text-white">
                            Przeglądaj menadżerów contentu
                        </a>
                    </div>
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-3">
        <div class="card text-white bg-danger mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-vcard"></i>&nbspAdministratorzy</div>
            <div class="card-body">
                <h5 class="card-title">Administratorów: [ilość]</h5>
                <p class="card-text">Tutaj nicki administratorów</p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <a href=<?php echo ROOT."/admin/list_of_administrators"?> id="administrators_lists" class="nav-link text-white">
                            Przeglądaj administratorów
                        </a>
                    </div>
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-3">
        <div class="card text-white bg-custom-2 mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-vcard"></i>&nbspZamówienia</div>
            <div class="card-body">
                <h5 class="card-title">Zamówień: [ilość]</h5>
                <p class="card-text">Zamówień w ciągu ostanich 7 dni: </p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <a href=<?php echo ROOT."/admin/list_of_orders"?> id="orders_lists" class="nav-link text-white">
                            Przeglądaj zamówienia
                        </a>
                    </div>
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Second row on xl -->
    <a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
            data-bs-toggle="collapse" href="#dashcollapse1" role="button" aria-expanded="true" aria-controls="dashcollapse1">Produkty
        <span class="bi bi-chevron-down right-icon ms-auto"></span>
    </a>
    <div class="collapse multi-collapse show" id="dashcollapse1">
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-4 mb-3">
                <div class="card text-white bg-primary mb-3 h-100" >
                    <div class="card-header"><i class="bi bi-person-fill"></i>&nbspProdukty</div>
                    <div class="card-body">
                        <h5 class="card-title">Produktów: [ilość]</h5>
                        <p class="card-text">Tu kilka nazw produktów, jeżeli się wszyscy nie mieszczą to na końcu ...</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href=<?php echo ROOT."/admin/list_of_products"?> id="products_lists" class="nav-link text-white">
                                    Przeglądaj produkty
                                </a>
                            </div>
                        <div class="col-12">  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-3">
        <div class="card text-white bg-custom-3 mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-fill-gear"></i>&nbspKatalogi</div>
            <div class="card-body">
                <h5 class="card-title">Katalogów: [ilość]</h5>
                <p class="card-text">Tutaj kilka nazw katalogów, jeżeli się wszystkie nie mieszczą to na końcu ...</p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <a href=<?php echo ROOT."/admin/list_of_attributes"?> id="attributes_lists" class="nav-link text-white">
                            Przeglądaj katalogi
                        </a>
                    </div>
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-3">
        <div class="card text-white bg-custom-1 mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-fill-gear"></i>&nbspAtrybuty</div>
            <div class="card-body">
                <h5 class="card-title">Atrybutów: [ilość]</h5>
                <p class="card-text">Tutaj kilka nazw atrybutów, jeżeli się wszystkie nie mieszczą to na końcu ...</p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <a href=<?php echo ROOT."/admin/list_of_content_managers"?> id="content_managers_lists" class="nav-link text-white">
                            Przeglądaj atrybuty
                        </a>
                    </div>
                    <div class="col-12">
                    </div>
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