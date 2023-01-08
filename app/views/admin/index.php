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
                    <div class="card text-white bg-success h-100" >
                        <div class="card-header">
                            <i class="bi bi-person-fill"></i>&nbspUżytkownicy
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/admin/add_user"?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Użytkowników: <?php echo $data['usersCount']?></h5>
                            <p class="card-text">
                                <?php
                                $i = 0;
                                foreach($data['users'] as $user){
                                    $i++;
                                    if($i<5)
                                        echo $user['login']."<br>";
                                    else if(($i==5 && $data['usersCount']<=5))
                                        echo $user['login'];
                                    else if($i==5 && $data['usersCount']>5)
                                        echo "...";                                    
                                }
                                ?>
                            </p>                       
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_users"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj użytkowników
                                
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-warning  h-100" >
                        <div class="card-header"><i class="bi bi-person-fill-gear"></i>&nbspMenadżerowie contentu
                            <a style='float:right;' class="text-white" href="#" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Menadżerów: <?php echo $data['managersCount']?></h5>
                            <p class="card-text">
                                <?php
                                $i = 0;
                                foreach($data['managers'] as $manager){
                                    $i++;
                                    if($i<5)
                                        echo $manager['login']."<br>";
                                    else if(($i==5 && $data['managersCount']<=5))
                                        echo $manager['login'];
                                    else if($i==5 && $data['managersCount']>5)
                                        echo "...";                                    
                                }
                                ?>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_content_managers"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj menadżerów contentu
                            </div>
                        </a>
                    </div>    
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-danger h-100" >
                        <div class="card-header">
                            <i class="bi bi-person-vcard"></i>&nbspAdministratorzy
                            <a style='float:right;' class="text-white" href="#" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Administratorów:  <?php echo $data['adminsCount']?></h5>
                            <p class="card-text">
                                <?php
                                $i = 0;
                                foreach($data['admins'] as $admin){
                                    $i++;
                                    if($i<5)
                                        echo $admin['login']."<br>";
                                    else if(($i==5 && $data['adminsCount']<=5))
                                        echo $admin['login'];
                                    else if($i==5 && $data['adminsCount']>5)
                                        echo "...";                                    
                                }
                                ?>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_administrators"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj adminstratorów
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-17 h-100" >
                        <div class="card-header">
                            <i class="bi bi-people-fill"></i>&nbspObsługa sklepu
                            <a style='float:right;' class="text-white" href="#" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Osób obsługi sklepu: 0</h5>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_administrators"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj obsługę sklepu
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-2 h-100">
                        <div class="card-header">
                            <i class="bi bi-cart4"></i>&nbspZamówienia
                        </div>
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
        <p class="mb-0">
            <a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
                data-bs-toggle="collapse" href="#dashcollapse2" role="button" aria-expanded="true" aria-controls="dashcollapse2">Produkty
            <span class="bi bi-chevron-down right-icon ms-auto"></span>
            </a>
        </p>
        <div class="collapse collapse show" id="dashcollapse2">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-primary h-100" >
                        <div class="card-header">
                            <i class="bi bi-box-seam-fill"></i>&nbspProdukty
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/admin/add_item"?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body mb-0">
                            <h5 class="card-title">Produktów: <?php echo $data['itemsCount']?></h5>
                            <p class="card-text">
                                <?php
                                $i = 0;
                                foreach($data['items'] as $item){
                                    $i++;
                                    if($i<5)
                                        echo $item['manufacturer']."-".$item['item']."<br>";
                                    else if(($i==5 && $data['attributesCount']<=5))
                                        echo $item['manufacturer']."-".$item['item'];
                                    else if($i==5 && $data['attributesCount']>5)
                                        echo "...";                                    
                                }
                                ?>
                            </p>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_items"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj produkty
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-3 h-100" >
                        <div class="card-header"><i class="bi bi-journals"></i>&nbspKatalogi
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/admin/add_catalog"?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Katalogów: <?php echo $data['catalogsCount']?></h5>
                            <p class="card-text">
                                <?php
                                    $i = 0;
                                    foreach($data['catalogs'] as $catalog){
                                        $i++;
                                        if($i<5)
                                            echo $catalog['name']."<br>";
                                        else if(($i==5 && $data['catalogsCount']<=5))
                                            echo $catalog['name'];
                                        else if($i==5 && $data['catalogsCount']>5)
                                            echo "...";                                
                                    } 
                                ?>
                            </p>
                        </div>
                        <a href="<?php echo ROOT."/admin/list_of_catalogs"?>" id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj katalogi
                            </div>
                        </a>
                    </div>    
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-1 h-100" >
                        <div class="card-header">
                            <i class="bi bi-journal-richtext"></i>&nbspAtrybuty
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/admin/add_attribute"?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Atrybutów: <?php echo $data['attributesCount']?></h5>
                            <p class="card-text">
                                <?php
                                    $i = 0;
                                    foreach($data['attributes'] as $attributes){
                                        $i++;
                                        if($i<5)
                                            echo $attributes['name']."<br>";
                                        else if(($i==5 && $data['attributesCount']<=5))
                                            echo $attributes['name'];
                                        else if($i==5 && $data['attributesCount']>5)
                                            echo "...";
                                    } 
                                ?> 
                            </p>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_attributes"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj atrybuty
                            </div>
                        </a>
                    </div>    
                </div> 
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-4 h-100" >
                        <div class="card-header">                           
                            <i class="bi bi-buildings"></i>&nbspProducenci
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/admin/add_manufacturer"?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                            <a style='float:right;' class="text-white me-2" 
                            href="<?php echo ROOT."/admin/add_countries_to_manufacturer"?>" >
                                <i class="bi bi-globe-americas"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Producentów: <?php echo $data['manufacturersCount']?></h5>
                            <p class="card-text">
                                <?php
                                    $i = 0;
                                    foreach($data['manufacturers'] as $manufacturers){
                                        $i++;
                                        if($i<5)
                                            echo $manufacturers['name']."<br>";
                                        else if(($i==5 && $data['manufacturersCount']<=5))
                                            echo $manufacturers['name'];
                                        else if($i==5 && $data['manufacturersCount']>5)
                                            echo "...";
                                    } 
                                ?> 
                            </p>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_manufacturers"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj producentów
                            </div>
                        </a>
                    </div>    
                </div>  
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-5 h-100" >
                        <div class="card-header">
                            <i class="bi bi-bar-chart-steps"></i>&nbspKategorie
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/admin/add_category"?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kategorii: <?php echo $data['categoriesCount']?></h5>
                            <p class="card-text">
                                <?php
                                    $i = 0;
                                    foreach($data['categories'] as $categories){
                                        $i++;
                                        if($i<5)
                                            echo $categories['name']."<br>";
                                        else if(($i==5 && $data['categoriesCount']<=5))
                                            echo $categories['name'];
                                        else if($i==5 && $data['categoriesCount']>5)
                                            echo "...";
                                    } 
                                ?> 
                            </p>
                        </div>
                        <a href=<?php echo ROOT."/admin/list_of_categories"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj kategorie
                            </div>
                        </a>
                    </div>    
                </div>  
            </div>
        </div>
        <!-- Third row on xl -->
        <p class="mb-0">
            <a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
                data-bs-toggle="collapse" href="#dashcollapse3" role="button" aria-expanded="true" aria-controls="dashcollapse3">Podstrony
                <span class="bi bi-chevron-down right-icon ms-auto"></span>
            </a>
        </p>
        <div class="collapse collapse show" id="dashcollapse3">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-6 h-100">
                        <a href=<?php echo ROOT."/admin/edit_page/1"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c1r1']) ? $data['siteLinks']['c1r1'] : 'Strona 1' ?>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-7 h-100">
                        <a href="<?php echo ROOT."/admin/edit_page/2"?>" id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c1r2']) ? $data['siteLinks']['c1r2'] : 'Strona 2' ?>
                            </div>
                        </a>
                    </div>    
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-8 h-100">
                        <a href=<?php echo ROOT."/admin/edit_page/3"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c1r3']) ? $data['siteLinks']['c1r3'] : 'Strona 3' ?>
                            </div>
                        </a>
                    </div>    
                </div> 
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-9 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_page/4"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c1r4']) ? $data['siteLinks']['c1r4'] : 'Strona 4' ?>
                            </div>
                        </a>
                    </div>    
                </div>  
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-10 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_page/5"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c2r1']) ? $data['siteLinks']['c2r1'] : 'Strona 5' ?>
                            </div>
                        </a>
                    </div>    
                </div>     
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-11 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_page/6"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c2r2']) ? $data['siteLinks']['c2r2'] : 'Strona 6' ?>
                            </div>
                        </a>
                    </div>    
                </div>   
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-12 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_page/7"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c2r3']) ? $data['siteLinks']['c2r3'] : 'Strona 7' ?>
                            </div>
                        </a>
                    </div>    
                </div>  
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-13 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_page/8"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                            <?=!empty($data['siteLinks']['c2r4']) ? $data['siteLinks']['c2r4'] : 'Strona 8' ?>
                            </div>
                        </a>
                    </div>    
                </div>     
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-14 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_page/9"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Edytuj dolny tekst
                            </div>
                        </a>
                    </div>    
                </div>   
            </div>
        </div>
          
        <!-- Fourth row on xl -->
        <p class="mb-0">
            <a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
            data-bs-toggle="collapse" href="#dashcollapse4" role="button" aria-expanded="true" 
            aria-controls="dashcollapse4">Ustawienia
                <span class="bi bi-chevron-down right-icon ms-auto"></span>
            </a>
        </p> 
        <div class="collapse collapse show" id="dashcollapse4">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-15 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_page/8"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Edytuj informacje
                            </div>
                        </a>
                    </div>    
                </div>  
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-16 h-100" >
                        <a href=<?php echo ROOT."/admin/edit_footer"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Edytuj stopkę
                            </div>
                        </a>
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