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
                            <h5 class="card-title">Produktów: <?php echo $data['itemsCount']?></h5>
                            <p class="card-text"><?php
                            foreach($data['items'] as $item)
                            echo $item['manufacturer']."-".$item['item']."<br>";
                            ?>
                            ...</p>
                        </div>
                        <a href="<?php echo ROOT."/manager/list_of_items"?>" id="orders_lists" class="nav-link text-white p-0">
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
                    <h5 class="card-title">Katalogów: <?php echo $data['catalogsCount']?></h5>
                    <p class="card-text"><?php
                            foreach($data['catalogs'] as $catalog)
                            echo $catalog['name']."<br>";
                            ?> ...</p>
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
                    <h5 class="card-title">Atrybutów: <?php echo $data['attributesCount']?></h5>
                    <p class="card-text"><?php
                            foreach($data['attributes'] as $attribute)
                            echo $attribute['name']."<br>";
                            ?>  ...</p>
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