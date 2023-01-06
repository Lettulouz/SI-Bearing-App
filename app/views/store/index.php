<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>
<?php include "sidebar_top.php"; ?>
<form method="POST" id="nwm" action ="">
    <input type="submit" style="display:none;" id="searchFormSubmit" name="searchFormSubmit"/>
    <input type="hidden" name="search" id="searchField"/>
    <input type="hidden" name="page" id="page"/>
</form>
    <li>
        <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link"
        data-bs-toggle="collapse" role="button" data-bs-target="#manufacturersGroup" aria-controls="#manufacturersGroup" 
        aria-expanded="<?=!empty($_POST['checkboxvar']) ? 'true' : 'false' ?>">Producenci
            <span class="bi bi-chevron-right right-icon ms-auto"></span>
        </a>

        <div class='collapse <?=!empty($_POST['checkboxvar']) ? 'show' : '' ?>' id="manufacturersGroup">
            <?php
                $k = 0;
                $manufacturer = $data['manufacturerArray'];
                foreach($manufacturer as $manufacturer) 
                {
                    echo "<div class='form-check'>
                        <input class='form-check-input checkboxvar' id='manufacturer".$k."' type='checkbox' name='checkboxvar[]' value='".$manufacturer['id']."' ";
                        if ((!empty($_POST["checkboxvar"]) && in_array($manufacturer['id'], $_POST["checkboxvar"])))
                        {
                            echo "checked";
                        }
                        echo ">
                        <label class='form-check-label' for='manufacturer".$k."''>".$manufacturer['name']."</label>
                    </div>";
                    $k++;
                }
            ?>
        </div>
        </li>
        <li class="my-1">
            <hr class="dropdown divider">
        </li>
        <li>
            <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link"
            data-bs-toggle="collapse" role="button" data-bs-target="#categGroup" aria-controls="#categGroup" 
            aria-expanded="<?=!empty($_POST['checkboxvar']) ? 'true' : 'false' ?>">Kategorie
                <span class="bi bi-chevron-right right-icon ms-auto"></span>
            </a>

            <div class='collapse <?=!empty($_POST['checkboxvar']) ? 'show' : '' ?>' id="categGroup">
                <?php
                    $k = 0;
                    $categories = $data['categArray'];
                    foreach($categories as $category) 
                    {
                        echo "<div class='form-check'>
                            <input class='form-check-input checkboxvar' id='category".$k."' type='checkbox' name='checkboxvar[]' value='".$category['id']."' ";
                            if ((!empty($_POST["checkboxvar"]) && in_array($category['id'], $_POST["checkboxvar"])))
                            {
                                echo "checked";
                            }
                            echo ">
                          <label class='form-check-label' for='category".$k."''>".$category['name']."</label>
                        </div>";
                        $k++;
                    }
                ?>
            </div>
        </li>
        
        <li class="my-1">
            <hr class="dropdown divider">
        </li>
        <li>
            <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link"
            data-bs-toggle="collapse" role="button" data-bs-target="#catGroup" aria-controls="#catGroup" 
            aria-expanded="<?=!empty($_POST['checkboxvar']) ? 'true' : 'false' ?>">Katalogi
                <span class="bi bi-chevron-right right-icon ms-auto"></span>
            </a>

            <div class='collapse <?=!empty($_POST['checkboxvar']) ? 'show' : '' ?>' id="catGroup">
                <?php
                    $k = 0;
                    $catalogs = $data['catalogsArray'];
                    foreach($catalogs as $catalog) 
                    {
                        echo "<div class='form-check'>
                            <input class='form-check-input checkboxvar' id='category".$k."' type='checkbox' name='checkboxvar[]' value='".$category['id']."' ";
                            if ((!empty($_POST["checkboxvar"]) && in_array($catalog['id'], $_POST["checkboxvar"])))
                            {
                                echo "checked";
                            }
                            echo ">
                          <label class='form-check-label' for='category".$k."''>".$catalog['name']."</label>
                        </div>";
                        $k++;
                    }
                ?>
            </div>
        </li>   

    <div class="mt-2">
        <button type="button" class="btn btn-outline-primary filterSub">Prześlij</button>
        <button type="button" class="btn btn-outline-danger resetSub">Resetuj</button>
    </div>
    <?php include "sidebar_bottom.php"; ?>
    <div class="row mb-3 panelBtn"> 
        <div class="d-flex mt-2">
            <div>
                <button class="btn btn-light btn-lg ms-3 me-2 mt-7 mt-lg-6 " type="button" data-bs-toggle="offcanvas" href=".sidebar" role="button" aria-controls="sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>                                        
        </div>
    </div>
    <?php if(empty($data['numberOfItems'])) {?>
        <div class='homeMain container mb-1 mt-5W px-3'>
            <label>Ooops! Trochę tu pusto, nie znaleziono żadnych produktów!</label>
        </div>
    <?php }else{?>
        <div class='homeMain container mb-1 mt-5W px-3'>
            <?php if(!empty($data['numberOfItems'])){ ?>
            <div class="container d-flex justify-content-end">
                <div class="mb-3" style="margin-right:-20px; margin-left:-20px;">
                    <button type='button' name='lft' class='btn d-inline shadow-none' style="margin-right:3px; margin-top:-2px; border:0px">
                        <i class="bi bi-arrow-left-circle" style="font-size:33px"></i>
                    </button>
                    <input type='number' style='text-align:center; box-shadow:none; font-size:15px;max-width:75px;' id='pageInside' class='d-inline form-control px-0' 
                    value='<?=isset($data['limit1']) ? $data['limit1'] : 1 ?>' name='limit1'/>

                    <label class="form-control d-inline" style="border:0px;">z <?=$data['numberOfPages']?></label>
                    <button type='button' name='rgt' 
                    class='<?=$data['last']==1 ? 'btn disabled;' : 'btn '?> d-inline shadow-none justify-content-end' 
                    style="margin-left:-12px; margin-top:-2px; border:0px ">
                        <i class="bi bi-arrow-right-circle" style="font-size:33px"></i>
                    </button>
                </div>
            </div>   
            <input type="hidden" id="numberOfPages" value="<?=$data['numberOfPages']?>"/>
            <?php } ?>

            <div class="row items mw-75">          
                <?php        
                $j = 0;
                $three = 3;
                $items = $data['itemsArray'];
                foreach($items as $j => $item) 
                {
                    $imagePath = APPPATH . "/resources/[" . $item['itemID'] . "].png";
                    $imagePathCheck = RESOURCEPATH . "/[" . $item['itemID'] . "].png";

                    if(!file_exists($imagePathCheck)){
                        $imagePath = APPPATH . "/resources/brak_zdjecia.png";
                    }
                        echo "<div class='col-12 col-md-6 col-xl-3 mb-4'>
                                <div class='card h-100'>"; 

                                    // zdjecie jako link do itemku
                                    echo "<a href=";
                                    echo ROOT."/store/item/{$item['itemID']}";
                                    echo " >";
                                    echo "<img src='" . $imagePath . "'  alt='zdjęcie łożyska' class='card-img-top img-thumbnail' 
                                    style='object-fit:contain; height:286px;'>";
                                    echo "</a>";

                                    echo "<div class='card-body'>
                                        <h4  class='card-title'>";

                                        // nazwa jako link do itemku
                                        echo " <a href= ";
                                        echo ROOT."/store/item/{$item['itemID']}";
                                        echo " >";
                                        echo "<b>  {$item['name']} </b>";
                                        echo "</a>";

                                        echo "</h4> <div class='card-text'> 
                                        <h5>firma: {$item['name2']} </h5>
                                    </div>
                                    </div>
                                        <div class='card-footer'>
                                            <form method='post' class='m-0 p-0' action='#'>
                                            <b> Cena: {$item['price']} zł </b>
                                                <input type='hidden' value=".$item['itemID']." name='itemID'>
                                                <button type='submit' class='btn btn-danger float-end '>
                                                    <i class='bi bi-basket2'></i>
                                                </button>
                                            </form>
                                        </div>
                                </div>
                            </div> ";
                    
                    $j++;
                }
                ?>
            </div>
            <?php if(!empty($data['numberOfItems'])){ ?>
                <div class="container d-flex justify-content-end">
                    <div class="mb-3" style="margin-right:-20px; margin-left:-20px;">
                        <button type='button' name='lft' class='btn d-inline shadow-none' style="margin-right:3px; margin-top:-2px; border:0px">
                            <i class="bi bi-arrow-left-circle" style="font-size:33px"></i>
                        </button>
                        <input type='number' style='text-align:center; box-shadow:none; font-size:15px;max-width:75px;' id='page' class='d-inline form-control px-0' 
                        value='<?=isset($data['limit1']) ? $data['limit1'] : 1 ?>' name='limit1'/>

                        <label class="form-control d-inline" style="border:0px;">z <?=$data['numberOfPages']?></label>
                        <button type='button' name='rgt' 
                        class='<?=$data['last']==1 ? 'btn disabled;' : 'btn '?> d-inline shadow-none justify-content-end' 
                        style="margin-left:-12px; margin-top:-2px; border:0px ">
                            <i class="bi bi-arrow-right-circle" style="font-size:33px"></i>
                        </button>
                    </div>
                </div> 
            <?php } ?>
        </div>
    <?php } ?>



<script>
    var temp;
    $(document).ready(function(){
        if($('#pageInside').val()<=1){
            $('[name="lft"]').addClass('btn btn-outline-secondary disabled');
        }
        if($('#pageInside').val()>=$('#numberOfPages').val()){
            $('[name="rgt"]').addClass('btn btn-outline-secondary disabled');
        }
        temp=$('#searchBox').val();

        //show sidebar at load page if at least one of checkboxes is checked
        //and window is wide enough
        if($(window).width()>1536 && $('.sidebar').find(':checkbox:checked').length > 0){
            $('.sidebar').offcanvas('show')
        }
    })

    $('[name="rgt"]').click(function(){
        a=$('#pageInside').val();
        $('#pageInside').val(++a);
        $('#page').val($('#pageInside').val());
        $('#nwm').submit();
    })

    $('[name="lft"]').click(function(){
        a=$('#pageInside').val();
        $('#pageInside').val(--a);
        $('#page').val($('#pageInside').val());
        $('#nwm').submit();
    })


    $('[name="remoteSearchFormSubmit"]').click(function(){
        if($('#searchRemote1').val()!=''){
            $('#searchField').val($('#searchRemote1').val());
        }else if($('#searchRemote2').val()!=''){
            $('#searchField').val($('#searchRemote2').val());
        }
       $('#nwm').submit();
    })
    
   
    //filter items
    $('.filterSub').click(function(){
        $('#page').val(1);
        $('#pageInside').val(1);
        $('#nwm').submit();
    })

    //reset filters
    $('.resetSub').click(function(){
        $('.checkboxvar').removeAttr('checked');
        $('#page').val(1);
        $('#pageInside').val(1);
        $('#nwm').submit();
    })
    
    //clear searchBox
    $('.clrBtn').click(function(){
        $('#searchRemote1').val('');
        $('#searchRemote2').val('');
        $('#nwm').submit();
    })

    $('.sub').click(function(){
        if(temp!=$('#searchRemote1').val()){
            $('#page').val(1);
            $('#pageInside').val(1);
        }else if(temp!=$('#searchRemote2').val()){
            $('#page').val(1);
            $('#pageInside').val(1);
        }
    })

    $('#pageInside').change(function(){
        $('#page').val($('#pageInside').val());
        $('#nwm').submit();
    });

    $('#searchRemote1').change(function() {
        $('#searchRemote2').val('')
    });

    $('#searchRemote2').change(function() {
        $('#searchRemote1').val('')
    });

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            if($('#searchRemote1').val()!=''){
                $('#searchField').val($('#searchRemote1').val());
                $('#nwm').submit();
            }else if($('#searchRemote2').val()!=''){
                $('#searchField').val($('#searchRemote2').val());
                $('#nwm').submit();
            }
             
        }
    });
    </script>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>
