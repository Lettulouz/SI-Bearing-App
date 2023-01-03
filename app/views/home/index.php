<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>



<?php include "sidebar_top.php"; ?>
<form method="POST" id="nwm" action ="">
<a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link"
         data-bs-toggle="collapse" role="button" data-bs-target="#manufacturersGroup"  aria-controls="#manufacturersGroup" 
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
                 echo ">";
                echo "<label class='form-check-label' for='manufacturer".$k."''>".$manufacturer['name']."</label>
            </div>";
            $k++;
        }
        


    ?>

</div>
<div class="mt-2">
    <button type="button" class="btn btn-outline-primary filterSub">Prześlij</button>
    <button type="button" class="btn btn-outline-danger resetSub">Resetuj</button>
    </div>
<?php include "sidebar_bottom.php"; ?>
<div class="row mb-3 panelBtn"> 
    <div class="d-flex ">
        <div>
            <button class="btn btn-light btn-lg ms-3 me-2" type="button" data-bs-toggle="offcanvas" href=".sidebar" role="button" aria-controls="sidebar">
                <i class="bi bi-list"></i>
                    </button>
        </div>
                    
                   
    </div>
    </div>
<div class='homeMain container mb-1 mt-5W px-5'>
<div class="row mb-3 searchBar"> 
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
                            <button type='button' id='lft' class='btn btn-outline-primary btn-sm'><i class='bi bi-arrow-left'></i></button>
                                <div class='col-3 col-md-2'>
                                    <input type='number' style='text-align:center;'  id='page' class='form-control px-0' 
                                    value='<?=isset($data['limit1']) ? $data['limit1'] : 1 ?>' name='limit1'/>
                                </div>
                            <button type='button' id='rgt' class='<?=$data['last']==1 ? 'btn btn-outline-secondary disabled' : 'btn btn-outline-primary'?> btn-sm'>
                            <i class='bi bi-arrow-right'></i></button>
                        </div>
                   
    </div>
    </div>
    </form>
<div class="row items mw-75">          
    <?php
    
    $j = 0;
    $three = 3;
    $items = $data['itemsArray'];
    foreach($items as $j => $item) 
    {
            echo "<div class='col-12 col-md-6 col-lg-4 col-xl-3 mb-4'>
                    <div class='card h-100'>
                        <img src='https://i.imgur.com/uqTzNBt.jpg'  alt='zdjęcie łożyska' class='card-img-top'>
                        <div class='card-body'>
                            <h4  class='card-title'><b>  {$item['name']} </b></h5>
                            <div class='card-text'> 
                            <h5>firma: {$item['name2']} </h5>
                            <p> <b> {$item['title']} </b> <br/>
                            {$item['description']}</p>
                            </div>
                            <div class='card-basket position-absolute bottom-0 w-100'>
                                <b> Cena: 1500zł </b>
                                
                                <button type='button' class='btn btn-danger btn-basket end-0 position-absolute'><i class='bi bi-basket2'></i></button>
                            </div>
                        </div>
                    </div>
                </div> ";
        
        $j++;
    }
    ?>
    </div>

</div>


<script>
    var temp;
    $(document).ready(function(){
        if($('#page').val()<=1){
            $('#lft').addClass('btn btn-outline-secondary disabled');
        }
        temp=$('#searchBox').val();
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

    //show sidebar at load page if at least one of checkboxes is checked
    //and window is wide enough
    $( document ).ready(function() {
        if($(window).width()>1536 && $(".sidebar").find(':checkbox:checked').length > 0){
            $(".sidebar").addClass('show');
        }
    });

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
