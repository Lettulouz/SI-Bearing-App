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
        $OrderArray = $data['OrderArray'];
        foreach($OrderArray as $OrderArray) 
        echo "
        
            <div class='row'>
                <div class='col-md-1'><img src='https://bootdey.com/img/Content/user_1.jpg' class='media-object img-thumbnail' /></div>
                <div class='col-md-11'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <span><strong>Order state ".$OrderArray['orderstate']."</strong></span> <br />
                            Quantity : 2, cost: $323.13 <br />
                            Forma dostawy: ".$OrderArray['shippingmethod']." <br />
                            Numer śledzenia: ".$OrderArray['trackingnumber']." <br />
                            Numer telefonu: ".$OrderArray['orderphonenumber']." <br />
                        </div>
                        <div class='col-md-12'>order destination: ".$OrderArray['ordercountry'].", ".$OrderArray['ordervoivodeship'].", 
                        ".$OrderArray['ordercity'].", ".$OrderArray['orderpostcode'].", ".$OrderArray['orderstreet'].", ".$OrderArray['orderhomenumber']."</div>
                    </div>
                </div>
            </div> "
        
        ?>
        </div>
        <div>miejsce na jakąć wiadomosć np. kliknij aby pokazac więcej</div>
    </div>
</div>


<?php include dirname(__FILE__,2) . "/footer.php"; ?>
