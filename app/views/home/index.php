<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>

    <div>
            <?php
            if(isset($data['limit1'])){
                $limit1 = $data['limit1'];
            }
            else{
                $limit1=1;
            }

            if(isset($data['search'])){
                $search = $data['search'];
            }

            echo '<form method="POST" class="d-flex mb-0" id="nwm" action ="" >';
                echo "<input type='submit' class='btn btn-primary' value='Szukaj' />";
                echo "<div class=' col-xs-3 px-2'>";
                echo "<input type='text' class='form-control' id='searchBox' value='".$search."' name='search'/>";
                echo "</div>";
                echo "<div class='d-flex px-3'>";
                echo "<button type='button' id='lft' class='btn btn-primary'/><i class='bi bi-arrow-left'></i></button>";
                echo "<div class='col-4 col-sm-2'>";
                echo "<input type='number' style='text-align:center;'  id='page' class='form-control px-0' value='".$limit1."' name='limit1'/>";
                echo "</div>";
                echo "<button type='button' id='rgt' class='btn btn-primary'/><i class='bi bi-arrow-right'></i></button>";
                echo "</div>";

            ?>

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
        

        /* //
        if (isset($_POST['checkboxvar'])) 
        {
            print_r($_POST['checkboxvar']); 
        }
        */
        echo "</form>";
    ?>
</div>
<?php include "sidebar_bottom.php"; ?>
<div class='homeMain container mw-75 mb-1 px-5'>
<div class="row">          
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
            $('#lft').addClass('disabled');
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

    $('.checkboxvar').click(function(){
        $('#nwm').submit();
    })
    // wykomentowałem, bo to nie powinno tak działać. Wojtek
    //$('#searchBox').click(function(){
        //$(this).val('');
        
    //})

    </script>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>
