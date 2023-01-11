<div class="container">
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Zamówienie </h2>
        </div>

        <a href="<?=ROOT.$data['orderpath']?>list_of_orders" class="text-dark ms-2" style="font-size:18px;">
            <i class="bi bi-backspace" style="font-size:18px"></i> Powrót
        </a>

        <!-- Main content -->
        <div class="row mt-3">
            <div class="col-lg-12">
                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <label class="me-3"><?=$data['orderInfo']['orderDate']?></label>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <?php
                                    $items = $data['itemsArray'];
                                    foreach ($items as $j => $item) {
                                        $amountOfItems = $item['itemAmount'];
                                        $priceOfItem = $item['itemPrice'];
                                        $total = $amountOfItems*$priceOfItem;
                                        echo "
                                        
                                    <tr>     
                                        <td> 
                                            <div class='price-wrap'> {$item['itemName']}</div>
                                        </td>   
                                        <td> 
                                            <div class='price-wrap'> {$item['itemManName']}</div>
                                        </td>                                
                                        <td> 
                                            <div class='price-wrap'> {$amountOfItems} szt.</div>
                                        </td>
                                        <td>
                                            <div class='price-wrap'> <var class='price' id='{$item['itemID']}'> {$total} zł </var> 
                                            <br><small class='text-muted'>{$priceOfItem} zł każdy </small> </div>
                                        </td>
                                    </tr>";
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Kwota zamówienia <strong id='totalItemPrice'> <?=$data['orderInfo']['orderPrice'] ?> zł</strong></td>
                                    <td class="text-end"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Wysyłka <strong id='orderPrice'><?=$data['orderInfo']['shippingPrice'] ?> zł</strong></td>
                                    <td class="text-end"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Prowizja formy płatności <strong id='orderPrice'><?=$data['orderInfo']['paymentFee'] ?> zł</strong></td>
                                    <td class="text-end"></td>
                                </tr>
                                <tr class="fw-bold">
                                    <input type='hidden' id='totalOrderPriceH' value='<?php echo $data['totalOrderPrice'] ?>'>
                                    <td colspan="2">Razem <strong id='totalOrderPrice'> <?php echo $data['totalOrderPrice'] ?> zł</strong></td>
                                    <td class="text-end"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Payment -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="h6">Dostawa</h3>
                                <div class='row'>
                                    <div class="col-12 p-1">
                                        <input class="form-control form-control-sm" type="text" name="name" placeholder="Dostawa" value="<?=$data['orderInfo']['shippingName'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <?php if($data['orderInfo']['needAddress'] == 1) {?>
                                <div class="col-lg-12">
                                    <h3 class="h6 mt-2">Dane dostawy</h3>
                                    <div class='row'>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="name" placeholder="Imię" value="<?=$data['orderInfo']['ordername'] ?>" readonly>
                                        </div>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="surname" placeholder="Nazwisko" value="<?=$data['orderInfo']['orderlastname'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="city" placeholder="Miasto" value="<?=$data['orderInfo']['ordercity'] ?>" readonly>
                                        </div>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="postcode" placeholder="Kod pocztowy" value="<?=$data['orderInfo']['orderpostcode'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="street" placeholder="Ulica" value="<?=$data['orderInfo']['orderstreet'] ?>" readonly>
                                        </div>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="number" name="housenumber" placeholder="Numer" value="<?=$data['orderInfo']['orderhomenumber'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="country" placeholder="Kraj" value="<?=$data['orderInfo']['ordercountry'] ?>" readonly>
                                        </div>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="voivoden" placeholder="Województwo" value="<?=$data['orderInfo']['ordervoivodeship'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-12 p-1">
                                            <input class="form-control form-control-sm" type="tel" name="phonenumber" placeholder="Numer telefonu" value="<?=$data['orderInfo']['orderphonenumber'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{?>
                                <div class="col-lg-12">
                                    <h3 class="h6 mt-2">Dane dostawy</h3>
                                    <div class='row'>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="name" placeholder="Imię" value="<?=$data['orderInfo']['ordername'] ?>" readonly>
                                        </div>
                                        <div class="col-12 col-md-6 p-1">
                                            <input class="form-control form-control-sm" type="text" name="surname" placeholder="Nazwisko" value="<?=$data['orderInfo']['orderlastname'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-12 p-1">
                                            <input class="form-control form-control-sm" type="tel" name="phonenumber" placeholder="Numer telefonu" value="<?=$data['orderInfo']['orderphonenumber'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <div class="col-lg-12 mt-3">
                                <h3 class="h6">Płatność</h3>
                                <div class='row'>
                                    <div class="col-12 p-1">
                                        <input class="form-control form-control-sm" type="text" name="name" placeholder="Dostawa" value="<?=$data['orderInfo']['paymentName'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>