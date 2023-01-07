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
        for($i = 1; $i < 5; $i++)
        echo "
        
            <div class='row'>
                <div class='col-md-1'><img src='https://bootdey.com/img/Content/user_1.jpg' class='media-object img-thumbnail' /></div>
                <div class='col-md-11'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <span><strong>Order name ".$i."</strong></span> <br />
                            Quantity : 2, cost: $323.13 <br />
                            <a data-placement='top' class='btn btn-success btn-xs glyphicon glyphicon-ok' href='#' title='View'></a>
                            <a data-placement='top' class='btn btn-danger btn-xs glyphicon glyphicon-trash' href='#' title='Danger'></a>
                            <a data-placement='top' class='btn btn-info btn-xs glyphicon glyphicon-usd' href='#' title='Danger'></a>
                        </div>
                        <div class='col-md-12'>order made on: 05/31/2014 by <a href='#'>Jane Doe </a></div>
                    </div>
                </div>
            </div> "
        
        ?>
        </div>
        <div>miejsce na jakąć wiadomosć np. kliknij aby pokazac więcej</div>
    </div>
</div>


<?php include dirname(__FILE__,2) . "/footer.php"; ?>
