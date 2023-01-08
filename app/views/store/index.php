<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>
<?php include "sidebar_top.php"; ?>
<form method="POST" id="submitFilterSearchSort" action ="">
    <input type="submit" style="display:none;" id="searchFormSubmit" name="searchFormSubmit"/>
    <input type="hidden" name="search" id="searchField"/>
    <input type="hidden" name="page" id="page"/>
</form>
    <li>
        <label class="text-muted small fw-bold text-uppercase text-decoration-none">Cena</label>
        <div class="form-check">     
            <div class="container mt-2 mb-2 d-flex justify-content-between" id="priceVal">
                <div class="row">
                    <div class="col-5">
                        <input type="number" min="0" step="0.01" class="form-control pricepart" style="margin-left:-10px" 
                        id="pricepartstart" name="pricepartstart" value="<?=$data['pricepartstart']?>"
                        form='submitFilterSearchSort'/>
                    </div>
                    <div class="col-2">
                        <label class="form-control" style="margin-left:-9px; background:transparent; border:0px">-</label>
                    </div>
                    <div class="col-5">
                        <input type="number" min="0" step="0.01" class="form-control pricepart" style="margin-left:-10px" 
                        id="pricepartend" name="pricepartend" value='<?=$data['pricepartend']?>'
                        form='submitFilterSearchSort'/>
                    </div>
                </div>
            </div>
        </div>
        <li class="my-1">
            <hr class="dropdown divider">
        </li>

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
                    $jk = 0;
                    $attributes = $data['attributesArray'];
                    foreach($attributes as $attribute) 
                    {
                        echo "<div class='form-check'>
                            <input type='hidden' id='isrange' value='" . $attribute['isrange']  . "' name='isItRange[]' form='submitFilterSearchSort'/>
                            <input class='form-check-input checkboxvar checkboxvarattr me-2' id='attribute".$k."' type='checkbox' name='checkBoxVarAttributes[]' form='submitFilterSearchSort' value='".$attribute['id']."' ";
                            if ((!empty($_POST["checkBoxVarAttributes"]) && in_array($attribute['id'], $_POST["checkBoxVarAttributes"])))
                            {
                                echo "checked";
                            }
                            echo ">
                          <label style='margin-top:1px' for='attribute".$k."''>".$attribute['name']." " .$attribute['unit'] ."</label>";

                          if ((!empty($_POST["arrayOfAttrVal"])) && !empty($_POST["checkBoxVarAttributes"]))
                            {
                                if(isset($_POST["checkBoxVarAttributes"][$jk])) {
                                    if($attribute['id'] == $_POST["checkBoxVarAttributes"][$jk]){
                                        if($_POST['arrayOfAttrVal'][0] != ""){
                                            if($attribute['isrange'] == 1){                                
                                                $first = $_POST['arrayOfAttrVal'][$jk];
                                                $second =  $_POST['arrayOfAttrVal'][$jk];
                                                $first = substr($first .'-', 0, strpos($first , '-'));
                                                $second = substr($second, (strpos($second, '-') ?: -1) + 1);
                                                $html = '';    
                                                $html.='<div class="container mt-2 mb-2 d-flex justify-content-between" id="attributeVal">';
                                                $html.='<div class="row">';
                                                $html.='<div class="col-5">';
                                                $html.='<input type="number" min="0" step="0.01" class="form-control attrpart" style="margin-left:-10px" id="attrpart1" value="';
                                                $html.=$first;
                                                $html.='"/>';
                                                $html.='</div>';
                                                $html.='<div class="col-2">';
                                                $html.='<label class="form-control" style="margin-left:-9px; background:transparent; border:0px">-</label>';
                                                $html.='</div>';
                                                $html.='<div class="col-5">';
                                                $html.='<input type="number" min="0" step="0.01" class="form-control attrpart" style="margin-left:-10px" id="attrpart2" value="';
                                                $html.=$second;
                                                $html.='"/>';
                                                $html.='</div>';
                                                $html.='</div>';
                                                $html.='<input type="hidden" name="arrayOfAttrVal[]" id="partsoutput" form="submitFilterSearchSort" value="';
                                                $html.=$_POST['arrayOfAttrVal'][$jk];
                                                $html.='"/>';
                                                $html.='</div>';      
                                            }else{
                                                $html = '';    
                                                $html.='<div class="container mt-2 mb-2" id="attributeVal" >';
                                                $html.='<div class="row">';
                                                $html.='<div class="col">';
                                                $html.='<input type="text" autocomplete="off" id="attrwhole" class="form-control attrnotrange" style="margin-left:-10px" name="arrayOfAttrVal[]" form="submitFilterSearchSort" value="';
                                                $html.=$_POST['arrayOfAttrVal'][$jk];
                                                $html.='"/>';
                                                $html.='</div>';
                                                $html.='</div>';
                                                $html.='</div>';
                                            }
                                            echo $html;
                                            $jk++;
                                        }
                                    }
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
 
                <div class="d-flex justify-content-end">

                    

                    <div class="mb-3" style="margin-right:-5x; margin-left:-20px;">
                        <button type='button' name='lft' class='btn d-inline shadow-none' style="margin-right:3px; margin-top:-2px; border:0px">
                            <i class="bi bi-arrow-left-circle" style="font-size:33px"></i>
                        </button>
                        <input type='number' style='text-align:center; box-shadow:none; font-size:15px;max-width:75px;' id='pageInside' class='d-inline form-control px-0' 
                        value='<?=isset($data['limit1']) ? $data['limit1'] : 1 ?>' name='limit1' form='submitFilterSearchSort'/>

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
                    <div class="mb-3" style="margin-right:-5px; margin-left:-20px;">
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

        document.querySelector(".attrpart").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which != 46 && evt.which != 44 && evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});

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
        var part1AsFl;
        var part2AsFl;
        var part1AsStr;
        var part2AsStr;
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
        
        if(part1 != ""){
            part1AsFl = (Math.round(parseFloat(part1)*100)/100);
            part1AsStr = parseFloat(part1).toFixed(2);
        }

        if(part2 != ""){
            part2AsFl = (Math.round(parseFloat(part2)*100)/100);
            part2AsStr = parseFloat(part2).toFixed(2);
        }
        
        if(part1AsStr != ""){
            if(part1AsFl == 0){
                $(this).parent().parent().find("input#attrpart1").val('');
                $(this).parent().parent().find("input#attrpart2").val(part2AsStr);
            }else{
                $(this).parent().parent().find("input#attrpart1").val(part1AsStr);
            }
        }

        if(part2AsStr != ""){
            if(part2AsFl == 0){
                $(this).parent().parent().find("input#attrpart2").val('');
                $(this).parent().parent().find("input#attrpart1").val(part1AsStr);
            }else{
                $(this).parent().parent().find("input#attrpart2").val(part2AsStr);
            }
        }
        if(part1AsStr != "" && part2AsStr !=""){
            if(part2AsFl<part1AsFl && part2AsFl != 0){
                $(this).parent().parent().find("input#attrpart1").val($(this).parent().parent().find("input#attrpart2").val());
            }
        }
    });
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
        $('.pricepart').trigger('change');
        $('.attrpart').trigger('input');
        $('.attrpart').trigger('change');
        //validationCheckboxForm();
        $('#page').val(1);
        $('#pageInside').val(1);
        $('#submitFilterSearchSort').submit();
    });

    //reset filters
    $('.resetSub').click(function(){
        $('#pricepartstart').val('');
        $('#pricepartend').val('');
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
                html+='<div class="container mt-2 mb-2 attributeFieldVal" id="attributeVal" >';
                html+='<div class="row">';
                html+='<div class="col">';
                html+='<input type="text" id="attrwhole" autocomplete="off" class="form-control" style="margin-left:-10px" name="arrayOfAttrVal[]" form="submitFilterSearchSort"/>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
            }else{
                var html = '';    
                html+='<div class="container mt-2 mb-2 d-flex justify-content-between attributeFieldVal" id="attributeVal">';
                html+='<div class="row">';
                html+='<div class="col-5">';
                html+='<input type="number" min="0" step="0.01" class="form-control attrpart" style="margin-left:-10px" id="attrpart1">';
                html+='</div>';
                html+='<div class="col-2">';
                html+='<label class="form-control" style="margin-left:-9px; background:transparent; border:0px">-</label>';
                html+='</div>';
                html+='<div class="col-5">';
                html+='<input type="number" min="0" step="0.01" class="form-control attrpart" style="margin-left:-10px" id="attrpart2"/>';
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

        document.querySelector(".attrpart").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which != 46 && evt.which != 44 && evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});

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
        var part1AsFl;
        var part2AsFl;
        var part1AsStr;
        var part2AsStr;
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
        
        if(part1 != ""){
            part1AsFl = (Math.round(parseFloat(part1)*100)/100);
            part1AsStr = parseFloat(part1).toFixed(2);
        }

        if(part2 != ""){
            part2AsFl = (Math.round(parseFloat(part2)*100)/100);
            part2AsStr = parseFloat(part2).toFixed(2);
        }
        
        if(part1AsStr != ""){
            if(part1AsFl == 0){
                $(this).parent().parent().find("input#attrpart1").val('');
                $(this).parent().parent().find("input#attrpart2").val(part2AsStr);
            }else{
                $(this).parent().parent().find("input#attrpart1").val(part1AsStr);
            }
        }

        if(part2AsStr != ""){
            if(part2AsFl == 0){
                $(this).parent().parent().find("input#attrpart2").val('');
                $(this).parent().parent().find("input#attrpart1").val(part1AsStr);
            }else{
                $(this).parent().parent().find("input#attrpart2").val(part2AsStr);
            }
        }
        if(part1AsStr != "" && part2AsStr !=""){
            if(part2AsFl<part1AsFl && part2AsFl != 0){
                $(this).parent().parent().find("input#attrpart1").val($(this).parent().parent().find("input#attrpart2").val());
            }
        }
    });

    
});


    </script>
    <script>

document.querySelector(".pricepart").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which != 46 && evt.which != 44 && evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});
    function validationCheckboxForm(){
        var amountOfCheckedCheckBoxes = $(".checkboxvar:checked").parent().length; 
        var inputElements1 = $(".checkboxvar:checked").parent().find('#attrpart1');


        var inputElements2 = $(".checkboxvar:checked").parent().find('#attrpart2');


        var inputElements3 = $(".checkboxvar:checked").parent().find('#attrwhole');

        for(let i = 0; i < amountOfCheckedCheckBoxes; i++){
            console.log(inputElements1[i].val());
            console.log(inputElements2[i]);
            console.log(inputElements3[i]);
        }


    }
   $(".pricepart").on('change', function(){
        var part1;
        var part2;
        var part1AsFl;
        var part2AsFl;
        var part1AsStr;
        var part2AsStr;
        if(typeof $(this).parent().parent().find("input#pricepartstart").val() === undefined){
            part1="";
        }else{
            part1 = $(this).parent().parent().find("input#pricepartstart").val();
        }
        if(typeof $(this).parent().parent().find("input#pricepartend").val() === undefined){
            part2="";
        }else{
            part2 = $(this).parent().parent().find("input#pricepartend").val();
        }

        if(part1 != ""){
            part1AsFl = (Math.round(parseFloat(part1)*100)/100);
            part1AsStr = parseFloat(part1).toFixed(2);
        }

        if(part2 != ""){
            part2AsFl = (Math.round(parseFloat(part2)*100)/100);
            part2AsStr = parseFloat(part2).toFixed(2);
        }
        
        if(part1AsStr != ""){
            if(part1AsFl == 0){
                $(this).parent().parent().find("input#pricepartstart").val('');
                $(this).parent().parent().find("input#pricepartend").val(part2AsStr);
            }else{;
                $(this).parent().parent().find("input#pricepartstart").val(part1AsStr);
            }
        }

        if(part2AsStr != ""){
            if(part2AsFl == 0){
                $(this).parent().parent().find("input#pricepartend").val('');
                $(this).parent().parent().find("input#pricepartstart").val(part1AsStr);
            }else{
                $(this).parent().parent().find("input#pricepartend").val(part2AsStr);
            }
        }
        if(part1AsStr != "" && part2AsStr !=""){
            if(part2AsFl<part1AsFl && part2AsFl != 0){
                $(this).parent().parent().find("input#pricepartstart").val($(this).parent().parent().find("input#pricepartend").val());
            }
        }
    });
 
</script>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>
