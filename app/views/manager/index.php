<?php
include 'mng_nav.php';

?>

<div class="container-fluid">
    <!-- First row on xl -->
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
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_item"?>" >
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
                                    else if(($i==5 && $data['itemsCount']<=5))
                                        echo $item['manufacturer']."-".$item['item'];
                                    else if($i==5 && $data['itemsCount']>5)
                                        echo "...";                                    
                                }
                                ?>
                            </p>
                        </div>
                        <a href=<?php echo ROOT."/manager/list_of_items"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj produkty
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-3 h-100" >
                        <div class="card-header"><i class="bi bi-journals"></i>&nbspKatalogi
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_catalog"?>" >
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
                        <a href="<?php echo ROOT."/manager/list_of_catalogs"?>" id="orders_lists" class="nav-link text-white p-0">
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
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_attribute"?>" >
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
                        <a href=<?php echo ROOT."/manager/list_of_attributes"?> id="orders_lists" class="nav-link text-white p-0">
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
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_manufacturer"?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                            <a style='float:right;' class="text-white me-2" 
                            href="<?php echo ROOT."/manager/add_countries_to_manufacturer"?>" >
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
                        <a href=<?php echo ROOT."/manager/list_of_manufacturers"?> id="orders_lists" class="nav-link text-white p-0">
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
                            <a style='float:right;' class="text-white" href="<?php echo ROOT."/manager/add_category"?>" >
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
                        <a href=<?php echo ROOT."/manager/list_of_categories"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Przeglądaj kategorie
                            </div>
                        </a>
                    </div>    
                </div>  
            </div>
        </div>

        <!-- Second row on xl -->
        <p class="mb-0">
            <a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
                data-bs-toggle="collapse" href="#dashcollapse3" role="button" aria-expanded="true" aria-controls="dashcollapse3">Sklep
                <span class="bi bi-chevron-down right-icon ms-auto"></span>
            </a>
        </p>
        <div class="collapse collapse show" id="dashcollapse3">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-18 h-100">
                        <div class="card-header">
                            <i class="bi bi-credit-card"></i>&nbspMetody płatności
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Dodanych metod płatności: <?=$data['paymentMethodsCount']?></h5>
                            <p class="card-text text-truncate"><?=$data['paymentMethodsString']?></p>
                        </div>
                        <a href=<?php echo ROOT."/manager/list_of_orders"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Edytuj metody płatności
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-3">
                    <div class="card text-white bg-custom-19 h-100">
                        <div class="card-header">
                            <i class="bi bi-truck"></i></i>&nbspMetody wysyłki
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Dodanych metod wysyłki: <?=$data['shippingMethodsCount']?></h5>
                            <p class="card-text text-truncate"><?=$data['shippingMethodsString']?></p>
                        </div>
                        <a href=<?php echo ROOT."/manager/list_of_orders"?> id="orders_lists" class="nav-link text-white p-0">
                            <div class="card-footer p-3">
                                Edytuj metody wysyłki
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

       





<script>
    document.getElementById('gotomngmain').setAttribute( 'style', 'color:white !important' );
</script>


<?php
include 'mng_feet.php';

?>