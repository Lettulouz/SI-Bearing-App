<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>


<div class="homeMain">
    <div class="container bootdey">
        <div class="panel panel-default panel-order">
            <div class="panel-heading">
                <h1>Historia zamówień</h1>
                <div class="btn-group pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Filter history <i class="fa fa-filter"></i></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#">Approved orders</a></li>
                            <li><a href="#">Pending orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class='panel-body'>
                <?php
                $ordersArray = $data['ordersArray'];
                foreach ($ordersArray as $order)
                    echo "
            
                <div class='row'>
                    <div class='col-md-1'><i class='bi bi-basket2 img-thumbnail' style='font-size:75px'></i></div>
                    <div class='col-md-11'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <span><strong>Stan zamówienia: " . $order['orderstate'] . "</strong></span> <br />
                                Cena: " . $order['price'] . " zł<br />
                                Forma dostawy: " . $order['smName'] . " <br />
                                Numer śledzenia: " . $order['trackingnumber'] . " <br />
                                Numer telefonu: " . $order['orderphonenumber'] . " <br />
                            </div>
                            <div class='col-md-12'>Adres dostawy: " . $order['ordercountry'] . ", " . $order['ordervoivodeship'] . ", 
                            " . $order['ordercity'] . ", " . $order['orderpostcode'] . ", " . $order['orderstreet'] . ", " . $order['orderhomenumber'] . "</div>
                        </div>
                    </div>
                </div> "

                ?>
            </div>
            <div>miejsce na jakąć wiadomosć np. kliknij aby pokazac więcej</div>
        </div>
    </div>
</div>


<?php include dirname(__FILE__, 2) . "/footer.php"; ?>