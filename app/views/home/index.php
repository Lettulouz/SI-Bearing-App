<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>
<?php include "sidebar_top.php"; ?>
<form method="POST" id="nwm" action ="">
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
                <button class="btn btn-light btn-lg ms-3 me-2" type="button" data-bs-toggle="offcanvas" href=".sidebar" role="button" aria-controls="sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>                                        
        </div>
    </div>
    <div class='homeMain container mb-1 mt-5W px-5'>
        <div class="row mb-3 mt-2 searchBar"> 
            <div class="d-flex">
                <div class='col-7 '>
                    <div class="input-group">
                        <input type='text' class='form-control form-sm' id='searchBox' 
                        value='<?=isset($data['search']) ? $data['search'] : '' ?>' name='search' placeholder="szukaj">
                        <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                            <i class="bi bi-x"></i>
                        </button>
                        <button class="btn btn-outline-primary sub" type="submit">szukaj</button>
                    </div>
                </div>
                <div class="ms-2 me-1 input-group d-flex">
                    <button type='button' id='lft' class='btn btn-outline-primary btn-sm'>
                        <i class='bi bi-arrow-left'></i>
                    </button>
                    <div class='col-3 col-md-2'>
                        <input type='number' style='text-align:center;' id='page' class='form-control px-0' 
                        value='<?=isset($data['limit1']) ? $data['limit1'] : 1 ?>' name='limit1'/>
                    </div>
                    <button type='button' id='rgt' 
                    class='<?=$data['last']==1 ? 'btn btn-outline-secondary disabled' : 'btn btn-outline-primary'?> btn-sm'>
                        <i class='bi bi-arrow-right'></i>
                    </button>
                </div>      
            </div>
        </div>
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
                    echo "<div class='col-12 col-md-6 col-lg-4 col-xl-3 mb-4'>
                            <div class='card h-100'>"; 

                                // zdjecie jako link do itemku
                                echo "<a href=";
                                echo ROOT.'/public/item'; 
                                echo " >";
                                echo "<img src='" . $imagePath . "'  alt='zdjęcie łożyska' class='card-img-top img-thumbnail' 
                                style='object-fit:contain; height:286px;'>";
                                echo "</a>";

                                echo "<div class='card-body'>
                                    <h4  class='card-title'>";

                                    // nazwa jako link do itemku
                                    echo " <a href= ";
                                    echo ROOT.'/item';
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
    </div>
</form>


<script>
    var temp;
    $(document).ready(function(){
        if($('#page').val()<=1){
            $('#lft').addClass('btn btn-outline-secondary disabled');
        }
        temp=$('#searchBox').val();

        //show sidebar at load page if at least one of checkboxes is checked
        //and window is wide enough
        if($(window).width()>1536 && $('.sidebar').find(':checkbox:checked').length > 0){
            $('.sidebar').offcanvas('show')
        }
    })

    $('#rgt').click(function(){
        a=$('#page').val();
        $('#page').val(++a);
        $('#nwm').submit();
    })

    $('#lft').click(function(){
        a=$('#page').val();
        $('#page').val(--a);
        $('#nwm').submit();
    })

    
   
    //filter items
    $('.filterSub').click(function(){
        $('#page').val(1);
        $('#nwm').submit();
    })

    //reset filters
    $('.resetSub').click(function(){
        $('.checkboxvar').removeAttr('checked');
        $('#page').val(1);
        $('#nwm').submit();
    })
    
    //clear searchBox
    $('.clrBtn').click(function(){
        $('#searchBox').val('');
    })

    $('.sub').click(function(){
        if(temp!=$('#searchBox').val()){
            $('#page').val(1);
        }
    })

    </script>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>
