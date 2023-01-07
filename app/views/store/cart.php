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
                                            $imagePath = APPPATH . "/resources/itemsPhotos/[" . $item['itemID'] . "].png";
                                            $imagePathCheck = RESOURCEPATH . "/[" . $item['itemID'] . "].png";
                                            if(!file_exists($imagePathCheck)){
                                                $imagePath = APPPATH . "/resources/itemsPhotos/brak_zdjecia.png";
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
                                                    <input class='form-control' name='{$item['itemID']}' type='number' value=1>
                                                <td>
                                                    <div class='price-wrap'> <var class='price' id='{$item['itemID']}'></var> <small class='text-muted'> {$item['itemPrice']}zł każdy </small> </div>
                                                </td>
                                                <td class='text-right d-none d-md-block'><button type='button' class='btn btn-light btn-round remove' data-abc='true' name='{$item['itemID']}'> Remove</a> </td>
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
        var number = parseFloat($(this).val());

        if(!Number.isNaN(localStorage.getItem(jQuery(this).attr("name")))){
            let valueAndAmount = localStorage.getItem(jQuery(this).attr("name")).split("-");
            if(valueAndAmount[2]>number)
                localStorage.setItem(jQuery(this).attr("name"), number+'-'+valueAndAmount[1]+'-'+valueAndAmount[2]); 
            else if(valueAndAmount[2]<=number)
                localStorage.setItem(jQuery(this).attr("name"), valueAndAmount[2]+'-'+valueAndAmount[1]+'-'+valueAndAmount[2]); 
            else        
                localStorage.setItem(jQuery(this).attr("name"), 'NaN'+'-'+valueAndAmount[1]+'-'+valueAndAmount[2]); 
        }
        calculateTotalPrice();
        
    })

    $( document ).ready(function(){
        calculateTotalPrice();
    })

    $(".form-control").on("focusout", function() {
        var number = parseFloat($(this).val());
        let valueAndAmount = localStorage.getItem(jQuery(this).attr("name")).split("-");

        if(number >= 1)
            localStorage.setItem(jQuery(this).attr("name"), number+'-'+valueAndAmount[1]+'-'+valueAndAmount[2]); 
        else if(valueAndAmount[2]>number) 
            localStorage.setItem(jQuery(this).attr("name"), valueAndAmount[2]+'-'+valueAndAmount[1]+'-'+valueAndAmount[2]); 
        else
            localStorage.setItem(jQuery(this).attr("name"), 1+'-'+valueAndAmount[1]+'-'+valueAndAmount[2]); 
        

        calculateTotalPrice();
    })
    

    $( document ).ready(function(){
        calculateTotalPrice();
    })

    function calculateTotalPrice(){
        var totalPrice = 0;
        Object.keys(localStorage).forEach(function(key, value){
            let valueAndAmount = localStorage.getItem(key).split("-");
            var itemPrice = 0;
            if(valueAndAmount[0] >= 1){
                var itemPrice = parseFloat(valueAndAmount[0])*parseFloat(valueAndAmount[1])
                $('[name='+key+']').val(parseFloat(valueAndAmount[0]));
            }
            else if (Number.isNaN(valueAndAmount[0])){
                $('[name='+key+']').val(parseFloat(0));
            }
            document.getElementById(key).innerHTML = itemPrice + ' zł';
            totalPrice += itemPrice;
        });
        document.getElementById('totalCost').innerHTML = '&nbsp' + totalPrice + ' zł';
    }

    $('.remove').click(function() {
        localStorage.removeItem(jQuery(this).attr("name"));
        var newCookie = '';
        Object.keys(localStorage).forEach(function(key, value){
            newCookie += key + ', ';
        });
        document.cookie = 'itemsInCart ='+newCookie+';3600, expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/';
        location.reload();
    })

    
    
</script>