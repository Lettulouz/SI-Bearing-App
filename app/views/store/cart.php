<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>
<div class="homeMain">
    <div class="container-fluid my-4">
        <div class="row d-flex justify-content-center">
            <aside class="col-lg-6">
                <div class="card">
                    <div class="table-responsive">
                        <?php if(!empty($data['itemsArray'])){ ?>
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                    <tr class="small text-uppercase">
                                        <th scope="col" >Produkt</th>
                                        <th scope="col" >Ilość</th>
                                        <th scope="col" >Cena</th>
                                        <th scope="col" class="text-right d-none d-md-block" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $items = $data['itemsArray'];
                                        foreach($items as $j => $item) 
                                        {
                                            $imagePath = APPPATH . "/resources/[" . $item['itemID'] . "].png";
                                            $imagePathCheck = RESOURCEPATH . "/[" . $item['itemID'] . "].png";
                                            if(!file_exists($imagePathCheck)){
                                                $imagePath = APPPATH . "/resources/brak_zdjecia.png";
                                            }
                                            echo "
                                            <tr>
                                                <td>
                                                    <figure class='itemside align-items-center'>
                                                        <div class='aside'><img src='$imagePath' class='img-sm'></div>
                                                        <figcaption class='info'> <a href='#' class='title text-dark' data-abc='true'>{$item['name']}</a>
                                                            <p class='text-muted small'> Firma: {$item['name2']} </p>
                                                        </figcaption>
                                                    </figure>
                                                </td>
                                                <td> 
                                                    <input class='form-control' id='{$item['itemID']}-{$item['itemPrice']}' type='number' value=1>
                                                <td>
                                                    <div class='price-wrap'> <var class='price' id='{$item['itemID']}'></var> <small class='text-muted'> {$item['itemPrice']}zł każdy </small> </div>
                                                </td>
                                                <td class='text-right d-none d-md-block'><a href='' class='btn btn-light btn-round' data-abc='true'> Remove</a> </td>
                                            </tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php }
                         else{
                            echo "Nie dodano do koszyka żadnych produktów!"; 
                        } ?>
                    </div>
                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right text-dark b ml-3"><strong id='totalCost'>$59.97</strong></dd>
                        </dl>
                        <hr> <a href="#" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make Purchase </a> <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>

<script>
    $(".form-control").on("change paste keyup", function() {
        var number = parseInt($(this).val());
        localStorage.setItem(jQuery(this).attr("id"), number); 

        calculateTotalPrice();
    })

    $( document ).ready(function(){
        calculateTotalPrice();
    })

    $(".form-control").on("focusout", function() {
        var number = parseInt($(this).val());
        if(number >= 1)
            localStorage.setItem(jQuery(this).attr("id"), number); 
        else
            localStorage.setItem(jQuery(this).attr("id"), 1); 

        calculateTotalPrice();
    })

    $( document ).ready(function(){
        calculateTotalPrice();
    })

    function calculateTotalPrice(){
        var totalPrice = 0;
        Object.keys(localStorage).forEach(function(key, value){
            let idAndValue = key.split("-");
            var itemPrice = 0;
            if(localStorage.getItem(key) >= 1){
                var itemPrice = parseFloat(idAndValue[1])*parseInt(localStorage.getItem(key))
                $('#'+key).val(localStorage.getItem(key));
            }
            document.getElementById(idAndValue[0]).innerHTML = itemPrice + ' zł';
            totalPrice += itemPrice;
        });
        document.getElementById('totalCost').innerHTML = '&nbsp' + totalPrice + ' zł';
    }
    
</script>