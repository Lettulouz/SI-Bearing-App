<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>
<div class="homeMain">
    <div class="container-fluid my-4">
        <form method="POST" action=<?php echo ROOT . "/store/summary" ?>>
            <div class="row d-flex justify-content-center">

                <aside class="col-lg-6">
                    <div class="card">
                        <div class="table-responsive">
                            <?php if (!empty($data['itemsArray'])) { ?>
                                <table class="table table-borderless table-shopping-cart">
                                    <thead class="text-muted">
                                        <tr class="small text-uppercase">
                                            <th scope="col">Produkt</th>
                                            <th scope="col">Ilość</th>
                                            <th scope="col">Cena</th>
                                            <th scope="col" class="text-right d-none d-md-block"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $items = $data['itemsArray'];
                                        foreach ($items as $j => $item) {
                                            $imagePath = APPPATH . "/resources/itemsPhotos/[" . $item['itemID'] . "].png";
                                            $imagePathCheck = RESOURCEPATH . "/itemsPhotos/[" . $item['itemID'] . "].png";
                                            if (!file_exists($imagePathCheck)) {
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
                                                        <input class='form-control numberInput' name='{$item['itemID']}' step='0.01' type='number' value=1>
                                                    </td>
                                                    <td>
                                                        <div class='price-wrap'> <var class='price' id='{$item['itemID']}'></var> <small class='text-muted'>{$item['itemPrice']} zł każdy </small> </div>
                                                    </td>
                                                    <td class='text-right d-none d-md-block'><button type='button' class='btn btn-lg btn-light btn-round remove fs-6' data-abc='true' name='{$item['itemID']}'> Usuń</a> </td>
                                                </tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            <?php } else {
                                echo "Nie dodano do koszyka żadnych produktów!";
                            } ?>
                        </div>
                    </div>
                </aside>
                <aside class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <dl class="dlist-align">
                                <dt>Razem:</dt>
                                <dd class="text-right text-dark b ml-3"><strong id='totalCost'>0.00 zł</strong></dd>
                            </dl>
                            <hr>
                            <?php if($data['isLogged']==1){ ?>
                            <button type='submit' class="btn btn-out btn-primary btn-square btn-main" data-abc="true" <?php if (empty($data['itemsArray'])) echo "disabled" ?>> Dokonaj zakupu </button>
                            <?php } else {?> 
                                <a href="<?php echo ROOT . "/login" ?>" class="btn btn-out btn-primary btn-square btn-main" <?php if (empty($data['itemsArray'])) echo "disabled" ?>> Dokonaj zakupu</a>
                            <?php } ?>
                            <a href=<?php echo ROOT . "/store" ?> class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Kontynuuj zakupy</a>
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
</div>
<?php include dirname(__FILE__, 2) . "/footer.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
<script>

    $('.numberInput').mask('09999.99');
    window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
    $(document).ready(function() {
        calculateTotalPrice();
    })

    $(".numberInput").on("focusout", function() {
        var number = parseFloat($(this).val());
        let valueAndAmount = sessionStorage.getItem(jQuery(this).attr("name")).split("-");

        if (valueAndAmount[3] != '1' || number % 1 <= 0)
            number = Math.trunc(number - number % 1);

        if (number > 0)
            sessionStorage.setItem(jQuery(this).attr("name"), number + '-' + valueAndAmount[1] + '-' + valueAndAmount[2] + '-' + valueAndAmount[3]);
        else if (valueAndAmount[2] < number)
            sessionStorage.setItem(jQuery(this).attr("name"), valueAndAmount[2] + '-' + valueAndAmount[1] + '-' + valueAndAmount[2] + '-' + valueAndAmount[3]);
        else
            sessionStorage.setItem(jQuery(this).attr("name"), 1 + '-' + valueAndAmount[1] + '-' + valueAndAmount[2] + '-' + valueAndAmount[3]);


        calculateTotalPrice();
    })


    $(document).ready(function() {
        calculateTotalPrice();
    })

    function calculateTotalPrice() {
        var totalPrice = 0;
        Object.keys(sessionStorage).forEach(function(key, value) {

            var id = parseInt(key);

            if (!Number.isNaN(id)) {
                let valueAndAmount = sessionStorage.getItem(key).split("-");
                var itemPrice = 0;
                if (valueAndAmount[0] > 0) {
                    var itemPrice = parseFloat(valueAndAmount[0]) * parseFloat(valueAndAmount[1])
                    if(valueAndAmount[3] == '1')
                        $('[name=' + key + ']').val(Math.trunc(parseFloat(valueAndAmount[0])*100)/100).toFixed(2);
                    else
                        $('[name=' + key + ']').val(parseFloat(valueAndAmount[0]));
                } else if (Number.isNaN(valueAndAmount[0])) {
                    if(valueAndAmount[3] == '1')
                        $('[name=' + key + ']').val(parseFloat(0).toFixed(2));
                    else
                        $('[name=' + key + ']').val(parseFloat(0));    
                }

                document.getElementById(key).innerHTML = (Math.trunc(itemPrice*100)/100).toFixed(2) + ' zł';
                totalPrice += itemPrice;
            }
        });
        document.getElementById('totalCost').innerHTML = '&nbsp' + (Math.trunc(totalPrice*100)/100).toFixed(2)  + ' zł';
    }

    $('.remove').click(function() {
        sessionStorage.removeItem(jQuery(this).attr("name"));
        var newCookie = '';
        Object.keys(sessionStorage).forEach(function(key, value) {
            if (!Number.isNaN(Number.parseInt(key)))
                newCookie += key + ', ';
        });
        var today = new Date();
        var expire = new Date();
        expire.setTime(today.getTime() + 3600000 * 24 * 7);
        document.cookie = 'itemsInCart =' + newCookie + ';3600, expires=' + expire.toGMTString() + '; path=/';
        location.reload();
    })

    
</script>

