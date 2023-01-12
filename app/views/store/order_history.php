<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>


<div class="homeMain">
    <div class="container bootdey">
        <div class="panel panel-default panel-order">
            <div class="panel-heading">
                <h1>Historia zamówień</h1>
                <hr/>
                <div class="btn-group pull-right">
                </div>
            </div>
            <div class='panel-body'>
                <?php
                if(!empty($data['ordersArray'])){
                $ordersArray = $data['ordersArray'];
                foreach ($ordersArray as $order)
                    if(empty($order['ordercountry']) && empty($order['ordervoivodeship']) && empty($order['orderpostcode']) 
                    && empty($order['ordercity']) && empty($order['orderstreet']) && empty($order['orderhomenumber'])) {
                        echo "
                        <a href=' " . ROOT . "/store/orderview/". $order['id'] ."' class='text-dark'>
                        <div class='row'>
                            
                            <div class='col-12 col-xl-1'><i class='bi bi-basket2 img-thumbnail' style='font-size:75px'></i></div>
                            <div class='col-12 col-xl-11'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <span><strong>Stan zamówienia: " . $order['orderstate'] . "</strong></span> <br />
                                        Cena: " . $order['price'] . " zł<br />
                                        Forma dostawy: " . $order['smName'] . " <br />
                                        Numer paczki: " . $order['trackingnumber'] . " <br />
                                        Numer telefonu: " . $order['orderphonenumber'] . " <br />
                                    </div>
                                    <div class='col-md-12'>Adres dostawy: Nie dotyczy
                                    <br/> Data złożenia zamówienia: " . $order['orderdate'] . "
                                    </div>
                                </div>
                            </div>
                        
                        </div>    </a><hr class='divider mt-3'>";
                    }else{
                        echo "
                            <a href=' " . ROOT . "/store/orderview/". $order['id'] ."' class='text-dark'>
                            <div class='row'>
                                
                                <div class='col-12 col-xl-1'><i class='bi bi-basket2 img-thumbnail' style='font-size:75px'></i></div>
                                <div class='col-12 col-xl-11'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <span><strong>Stan zamówienia: " . $order['orderstate'] . "</strong></span> <br />
                                            Cena: " . $order['price'] . " zł<br />
                                            Forma dostawy: " . $order['smName'] . " <br />
                                            Numer paczki: " . $order['trackingnumber'] . " <br />
                                            Numer telefonu: " . $order['orderphonenumber'] . " <br />
                                        </div>
                                        <div class='col-md-12'>Adres dostawy: " . $order['ordercountry'] . ", woj. " . $order['ordervoivodeship'] . ", 
                                        " . $order['orderpostcode'] . ", " . $order['ordercity'] . " ul. " . $order['orderstreet'] . " " . $order['orderhomenumber'] ."
                                        <br/> Data złożenia zamówienia: " . $order['orderdate'] . "
                                        </div>
                                    </div>
                                </div>
                            
                            </div>    </a><hr class='divider mt-3'>";
                    }
                }else{
                    echo "Ooops! Trochę tu pusto, wygląda na to, że dokonałeś żadnego zakupu w naszym sklepie :(";
                }

                ?>
            </div>
        </div>
    </div>
</div>


<?php include dirname(__FILE__, 2) . "/footer.php"; ?>