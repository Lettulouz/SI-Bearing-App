<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>

    <div>
            
             <form method="POST" class="d-flex mb-0" id="nwm" action ="">
                 <div class=' col-xs-3 px-2'>
                 <div class="input-group">
                    <input type='text' class='form-control' id='searchBox' 
                        value='<?=isset($data['search']) ? $data['search'] : '' ?>' name='search' placeholder="szukaj">
                        <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                        <i class="bi bi-x"></i>
                        </button>
                        <button class="btn btn-outline-primary" type="submit">szukaj</button>
                </div>
                 </div>
                 <div class='d-flex px-3'>
                    <div class="input-group">
                        <button type='button' id='lft' class='btn btn-outline-primary'><i class='bi bi-arrow-left'></i></button>
                            <div class='col-4 col-sm-2'>
                                <input type='number' style='text-align:center;'  id='page' class='form-control px-0' 
                                value='<?=isset($data['limit1']) ? $data['limit1'] : 1 ?>' name='limit1'/>
                            </div>
                        <button type='button' id='rgt' class='btn btn-outline-primary'><i class='bi bi-arrow-right'></i></button>
                    </div>
                 </div>

            

    </div>
<?php include "navbar_bottom.php"; ?>

<button class="btn btn-light btn-lg panelBtn mx-3" type="button" data-bs-toggle="offcanvas" href=".sidebar" role="button" aria-controls="sidebar">
    <i class="bi bi-list"></i>
        </button>

<?php include "sidebar_top.php"; ?>
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

 </form>
</div>
<div class="mt-2">
    <button type="button" class="btn btn-outline-primary filterSub">Prześlij</button>
    <button type="button" class="btn btn-outline-danger">Resetuj</button>
    </div>
<?php include "sidebar_bottom.php"; ?>
<div class='homeMain container mw-75 mb-1 px-5'>
<div class="row ">          
    <?php
    
    $j = 0;
    $three = 3;
    $items = $data['itemsArray'];
    foreach($items as $j => $item) 
    {
            echo "<div class='col-12 col-md-6 col-lg-3 mb-4'>
                    <div class='card h-100'>
                        <img src='https://i.imgur.com/uqTzNBt.jpg'  alt='zdjęcie łożyska' class='card-img-top'>
                        <div class='card-body'>
                            <h4  class='card-title'><b>  {$item['name']} </b></h5>
                            <div class='card-text'> 
                            <h5>firma: {$item['name2']} </h5>
                            <p> <b> {$item['title']} </b> <br/>
                            {$item['description']}</p>
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
    $(document).ready(function(){
        if($('#page').val()<=1){
            $('#lft').addClass('btn btn-outline-secondary disabled');
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

    //show sidebar at load page if at least one of checkboxes is checked
    //and window is wide enough
    $( document ).ready(function() {
        if($(window).width()>1536 && $(".sidebar").find(':checkbox:checked').length > 0){
            $(".sidebar").addClass('show');
        }
    });

    $('.filterSub').click(function(){
        $('#nwm').submit();
    })

    $('.resetSub').click(function(){
        $('.checkboxvar').removeAttr('checked');
        $('#nwm').submit();
    })
    
    $('.clrBtn').click(function(){
        $('#searchBox').val('');
        
    })

    </script>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>
