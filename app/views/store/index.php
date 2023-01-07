<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>
<?php include "sidebar_top.php"; ?>
<form method="POST" id="submitFilterSearchSort" action ="">
    <input type="submit" style="display:none;" id="searchFormSubmit" name="searchFormSubmit"/>
    <input type="hidden" name="search" id="searchField"/>
    <input type="hidden" name="page" id="page"/>
</form>
    <li>
        <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link"
        data-bs-toggle="collapse" role="button" data-bs-target="#manufacturersGroup" aria-controls="#manufacturersGroup" 
        aria-expanded="<?=!empty($_POST['checkBoxVarManufacturers']) ? 'true' : 'false' ?>">Producenci
            <span class="bi bi-chevron-right right-icon ms-auto"></span>
        </a>

        <div class='collapse <?=!empty( $data['manufacturersArray']) ? 'show' : '' ?>' id="manufacturersGroup">
            <?php
                $k = 0;
                $manufacturers = $data['manufacturersArray'];
                foreach($manufacturers as $manufacturer) 
                {
                    echo "<div class='form-check'>
                        <input class='form-check-input checkboxvar me-2' id='manufacturer".$k."' type='checkbox' name='checkBoxVarManufacturers[]' form='submitFilterSearchSort' value='".$manufacturer['id']."' ";
                        if ((!empty($_POST["checkBoxVarManufacturers"]) && in_array($manufacturer['id'], $_POST["checkBoxVarManufacturers"])))
                        {
                            echo "checked";
                        }
                        echo ">
                        <label style='margin-top:1px' for='manufacturer".$k."''>".$manufacturer['name']."</label>
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
            aria-expanded="<?=!empty($_POST['checkBoxVarCategories']) ? 'true' : 'false' ?>">Kategorie
                <span class="bi bi-chevron-right right-icon ms-auto"></span>
            </a>

            <div class='collapse <?=!empty($data['categoriesArray']) ? 'show' : '' ?>' id="categGroup">
                <?php
                    $k = 0;
                    $categories = $data['categoriesArray'];
                    foreach($categories as $category) 
                    {
                        echo "<div class='form-check'>
                            <input class='form-check-input checkboxvar me-2' id='category".$k."' type='checkbox' name='checkBoxVarCategories[]' form='submitFilterSearchSort' value='".$category['id']."' ";
                            if ((!empty($_POST["checkBoxVarCategories"]) && in_array($category['id'], $_POST["checkBoxVarCategories"])))
                            {
                                echo "checked";
                            }
                            echo ">
                          <label style='margin-top:1px' for='category".$k."''>".$category['name']."</label>
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
            aria-expanded="<?=!empty($_POST['checkBoxVarCatalogs']) ? 'true' : 'false' ?>">Katalogi
                <span class="bi bi-chevron-right right-icon ms-auto"></span>
            </a>

            <div class='collapse <?=!empty($data['catalogsArray']) ? 'show' : '' ?>' id="catGroup">
                <?php
                    $k = 0;
                    $catalogs = $data['catalogsArray'];
                    foreach($catalogs as $catalog) 
                    {
                        echo "<div class='form-check'>
                            <input class='form-check-input checkboxvar me-2' id='catalogs".$k."' type='checkbox' name='checkBoxVarCatalogs[]' form='submitFilterSearchSort' value='".$catalog['id']."' ";
                            if ((!empty($_POST["checkBoxVarCatalogs"]) && in_array($catalog['id'], $_POST["checkBoxVarCatalogs"])))
                            {
                                echo "checked";
                            }
                            echo ">
                          <label style='margin-top:1px' for='catalogs".$k."''>".$catalog['id']."</label>
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
            data-bs-toggle="collapse" role="button" data-bs-target="#attrGroup" aria-controls="#attrGroup" 
            aria-expanded="<?=!empty($_POST['checkBoxVarAttributes']) ? 'true' : 'false' ?>">Atrybuty
                <span class="bi bi-chevron-right right-icon ms-auto"></span>
            </a>

            <div class='collapse <?=!empty($data['attributesArray']) ? 'show' : '' ?>' id="attrGroup">
                <?php
                    $k = 0;
                    $attributes = $data['attributesArray'];
                    foreach($attributes as $attribute) 
                    {
                        echo "<div class='form-check'>
                            <input type='hidden' id='isrange' value='" . $attribute['isrange']  . "'/>
                            <input class='form-check-input checkboxvar checkboxvarattr me-2' id='attribute".$k."' type='checkbox' name='checkBoxVarAttributes[]' form='submitFilterSearchSort' value='".$attribute['id']."' ";
                            if ((!empty($_POST["checkBoxVarAttributes"]) && in_array($attribute['id'], $_POST["checkBoxVarAttributes"])))
                            {
                                echo "checked";
                            }
                            echo ">
                          <label style='margin-top:1px' for='attribute".$k."''>".$attribute['name']." " .$attribute['unit'] ."</label>";

                          if ((!empty($_POST["arrayOfAttrVal"])) && !empty($_POST["checkBoxVarAttributes"] && in_array($attribute['id'], $_POST["checkBoxVarAttributes"])))
                            {
                                if($_POST['arrayOfAttrVal'][$k] != ""){
                                    if($attribute['isrange'] == 1){                                
                                        $first = $_POST['arrayOfAttrVal'][$k];
                                        $second =  $_POST['arrayOfAttrVal'][$k];
                                        $first = substr($first .'-', 0, strpos($first , '-'));
                                        $second = substr($second, (strpos($second, '-') ?: -1) + 1);
                                        $html = '';    
                                        $html.='<div class="container mt-2 mb-2 d-flex justify-content-between" id="attributeVal">';
                                        $html.='<div class="row">';
                                        $html.='<div class="col-5">';
                                        $html.='<input type="number" class="form-control attrpart" style="margin-left:-10px" id="attrpart1" value="';
                                        $html.=$first;
                                        $html.='"/>';
                                        $html.='</div>';
                                        $html.='<div class="col-2">';
                                        $html.='<label class="form-control" style="margin-left:-9px; background:transparent; border:0px">-</label>';
                                        $html.='</div>';
                                        $html.='<div class="col-5">';
                                        $html.='<input type="number" class="form-control attrpart" style="margin-left:-10px" id="attrpart2" value="';
                                        $html.=$second;
                                        $html.='"/>';
                                        $html.='</div>';
                                        $html.='</div>';
                                        $html.='<input type="hidden" name="arrayOfAttrVal[]" id="partsoutput" form="submitFilterSearchSort" value="';
                                        $html.=$_POST['arrayOfAttrVal'][$k];
                                        $html.='"/>';
                                        $html.='</div>';      
                                    }else{
                                        $html = '';    
                                        $html.='<div class="container mt-2 mb-2" id="attributeVal" >';
                                        $html.='<div class="row">';
                                        $html.='<div class="col">';
                                        $html.='<input type="text" autocomplete="off" class="form-control" style="margin-left:-10px" name="arrayOfAttrVal[]" form="submitFilterSearchSort" value="';
                                        $html.=$_POST['arrayOfAttrVal'][$k];
                                        $html.='"/>';
                                        $html.='</div>';
                                        $html.='</div>';
                                        $html.='</div>';
                                    }
                                    echo $html;
                                }
                            }
                        echo" </div>";
                        
                        
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
                <button class="btn btn-light bg-custom-4 btn-lg ms-3 me-2 mt-7 mt-lg-6 " type="button" data-bs-toggle="offcanvas" href=".sidebar" role="button" aria-controls="sidebar">
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
                    $imagePath = APPPATH . "/resources/itemsPhotos/[" . $item['itemID'] . "].png";
                    $imagePathCheck = PHOTOSPATH . "/[" . $item['itemID'] . "].png";

                    if(!file_exists($imagePathCheck)){
                        $imagePath = APPPATH . "/resources/itemsPhotos/brak_zdjecia.png";
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

                                            <b> Cena: {$item['price']} zł </b>
                                                <input type='hidden' value=".$item['itemID']." name='itemID'>
                                                <button type='submit' class='btn btn-danger float-end ' id='".$item['itemID']."-".$item['itemPrice']."-".$item['amount']."' name='addToCart'>
                                                    <i class='bi bi-basket2'></i>
                                                </button>

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
    });

    $('[name="rgt"]').click(function(){
        a=$('#pageInside').val();
        $('#pageInside').val(++a);
        $('#page').val($('#pageInside').val());
        $('#submitFilterSearchSort').submit();
    });

    $('[name="lft"]').click(function(){
        a=$('#pageInside').val();
        $('#pageInside').val(--a);
        $('#page').val($('#pageInside').val());
        $('#submitFilterSearchSort').submit();
    });


    $('[name="remoteSearchFormSubmit"]').click(function(){
        if($('#searchRemote1').val()!=''){
            $('#searchField').val($('#searchRemote1').val());
        }else if($('#searchRemote2').val()!=''){
            $('#searchField').val($('#searchRemote2').val());
        }
       $('#submitFilterSearchSort').submit();
    });
    
   
    //filter items
    $('.filterSub').click(function(){
        $('#page').val(1);
        $('#pageInside').val(1);
        $('#submitFilterSearchSort').submit();
    });

    //reset filters
    $('.resetSub').click(function(){
        $('.checkboxvar').removeAttr('checked');
        $('#page').val(1);
        $('#pageInside').val(1);
        $('#submitFilterSearchSort').submit();
    });
    
    //clear searchBox
    $('.clrBtn').click(function(){
        $('#searchRemote1').val('');
        $('#searchRemote2').val('');
        $('#submitFilterSearchSort').submit();
    });

    $('.sub').click(function(){
        if(temp!=$('#searchRemote1').val()){
            $('#page').val(1);
            $('#pageInside').val(1);
        }else if(temp!=$('#searchRemote2').val()){
            $('#page').val(1);
            $('#pageInside').val(1);
        }
    });

    $('#pageInside').change(function(){
        $('#page').val($('#pageInside').val());
        $('#submitFilterSearchSort').submit();
    });

    $('#searchRemote1').change(function() {
        $('#searchRemote2').val('');
    });

    $('#searchRemote2').change(function() {
        $('#searchRemote1').val('');
    });

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            if($('#searchRemote1').val()!=''){
                $('#searchField').val($('#searchRemote1').val());
                $('#submitFilterSearchSort').submit();
            }else if($('#searchRemote2').val()!=''){
                $('#searchField').val($('#searchRemote2').val());
                $('#submitFilterSearchSort').submit();
            }
             
        }
    });

    $('[name="addToCart"]').click(function(){
        let idValueAmount = jQuery(this).attr("id").split("-");
        

        if(!localStorage.getItem(idValueAmount[0]))
            localStorage.setItem(idValueAmount[0], '1'+'-'+idValueAmount[1]+'-'+idValueAmount[2]); 
        else{
            let valueAndAmount = localStorage.getItem(idValueAmount[0]).split("-");
            if(valueAndAmount[2]>valueAndAmount[0]){
                var newValue = parseFloat(valueAndAmount[0])+1;
                localStorage.setItem(idValueAmount[0], newValue+'-'+idValueAmount[1]+'-'+idValueAmount[2]); 
            }
        }
        var newCookie = "";
        Object.keys(localStorage).forEach(function(key, value){
            newCookie += key + ', ';
        });
        console.log(newCookie);
        document.cookie = 'itemsInCart ='+newCookie+';3600, expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/';
    });

    $(".checkboxvarattr").click(function(e){
        var parent = $(this).parent();
        if(($(this).is(':checked'))){
            var toCheck = parent.find('input#isrange').val();
            if(toCheck == 0){
                var html = '';    
                html+='<div class="container mt-2 mb-2" id="attributeVal" >';
                html+='<div class="row">';
                html+='<div class="col">';
                html+='<input type="text" autocomplete="off" class="form-control" style="margin-left:-10px" name="arrayOfAttrVal[]" form="submitFilterSearchSort"/>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
            }else{
                var html = '';    
                html+='<div class="container mt-2 mb-2 d-flex justify-content-between" id="attributeVal">';
                html+='<div class="row">';
                html+='<div class="col-5">';
                html+='<input type="number" class="form-control attrpart" style="margin-left:-10px" id="attrpart1">';
                html+='</div>';
                html+='<div class="col-2">';
                html+='<label class="form-control" style="margin-left:-9px; background:transparent; border:0px">-</label>';
                html+='</div>';
                html+='<div class="col-5">';
                html+='<input type="number" class="form-control attrpart" style="margin-left:-10px" id="attrpart2"/>';
                html+='</div>';
                html+='</div>';
                html+='<input type="hidden" name="arrayOfAttrVal[]" id="partsoutput" form="submitFilterSearchSort">';
                html+='</div>';         
            } 
            $(parent).append(html);
        }else{
            var toDelete = parent.find('div#attributeVal');
            $(toDelete).remove();
        }

        $(".attrpart").on('input', function(){
            var part1;
            var part2;
            if(typeof $(this).parent().parent().find("input#attrpart1").val() === undefined){
                part1="";
            }else{
                part1 = $(this).parent().parent().find("input#attrpart1").val();
            }
            if(typeof $(this).parent().parent().find("input#attrpart2").val() === undefined){
                part2="";
            }else{
                part2 = $(this).parent().parent().find("input#attrpart2").val();
            }
        var output = part1+"-"+part2;

        $(this).parent().parent().parent().find("input#partsoutput").val(output);
    });

    $(".attrpart").on('change', function(){
        var part1;
        var part2;
        if(typeof $(this).parent().parent().find("input#attrpart1").val() === undefined){
            part1="";
        }else{
            part1 = $(this).parent().parent().find("input#attrpart1").val();
        }
        if(typeof $(this).parent().parent().find("input#attrpart2").val() === undefined){
            part2="";
        }else{
            part2 = $(this).parent().parent().find("input#attrpart2").val();
        }

        if(part1 != "" && part2 !=""){
            if(part2<part1)
            $(this).parent().parent().find("input#attrpart1").val($(this).parent().parent().find("input#attrpart2").val());
        }
    });
});
    







    </script>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>
