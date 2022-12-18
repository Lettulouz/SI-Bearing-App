<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>

    <div class="row">
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
                echo "<div class='col-2'>";
                echo "<input type='number' style='text-align:center;'  id='page' class='form-control' value='".$limit1."' name='limit1'/>";
                echo "</div>";
                echo "<button type='button' id='rgt' class='btn btn-primary'/><i class='bi bi-arrow-right'></i></button>";
                echo "</div>";

            ?>

    </div>
<?php include "navbar_bottom.php"; ?>

<?php include "sidebar_top.php"; ?>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="check" id="manufacturer1" value="optionpr1">
        <label class="form-check-label" for="manufacturer">Producent1</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="check" id="manufacturer1" value="optionpr1">
        <label class="form-check-label" for="manufacturer">Producent1</label>
    </div>
<?php include "sidebar_bottom.php"; ?>

<div class='homeMain container mb-1'>
<div class="row">          
    <?php
    
    $j = 0;
    $three = 3;
    $items = $data['itemsArray'];
    foreach($items as $j => $item) 
    {
            echo "<div class='col-12 col-md-6 col-lg-3'>
                    <div class='card'>
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
    <div class="row">
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

    // wykomentowałem, bo to nie powinno tak działać. Wojtek
    //$('#searchBox').click(function(){
        //$(this).val('');
        
    //})

    </script>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>
