<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>


<div class="homeMain">

<div class="container d-flex" style="min-height: 400px;">
    <div class="row vw-100">
        <div class="col-sm-6 default-page-domin d-sm-block border border-0" style="min-height: 400px;"></div>
        <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center border-0"
            style="min-height: 400px;">

            <h1 class="text-wrap fs-1 text"><?=$data['itemParams']['name']?></h1>
            <h3 class="text-wrap text">Firma: <?=$data['itemParams']['manname']?></h3>
            <h6 class="text-wrap text"><?=$data['itemParams']['price']?> zł</h6>
            <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center">
                <a href="#" class="btn btn-primary btn-md py-2 px-4 mt-4">Dodaj do koszyka</a>
            
            </div>
        </div>
    </div>
</div>
<hr>
<h3 class="section-subheading text-muted p-2">Opis produktu</h3>

    <div class="container mb-5">
        <?php 
        $descriptions = $data['itemDescrs'];
        foreach($descriptions as $description) {
            $desc = $description['description'];
            $title = $description['title'];
            echo "<h3 class='text-wrap fs-1 text-center mb-4'>$title</h3>
            <h6 class='text-wrap text text-left mb-5'>$desc</h6>";


        } 
        ?>
    </div>

<hr>
<h3 id="section-spec" class="section-subheading text-muted p-2">Specyfikacja</h3>

    <div class="container mb-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover border-top border-top">
                <tbody>
                    <tr>
                        <td class="align-middle fw-bold text-center">Product designation</td>
                        <td class="align-middle text-start">For gamers</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Screen diagonal</td>
                        <td class="align-middle text-start">"25"</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Matrix surface</td>
                        <td class="align-middle text-start">Matte</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Matrix type</td>
                        <td class="align-middle text-start">LED, IPS</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Monitor type</td>
                        <td class="align-middle text-start">Flat</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Frameless monitor</td>
                        <td class="align-middle text-start">Yes</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Screen resolution</td>
                        <td class="align-middle text-start">1920 x 1080 (FullHD)</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Monitor format</td>
                        <td class="align-middle text-start">16:9</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">Screen refresh rate</td>
                        <td class="align-middle text-start">240 Hz</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">The number of colors displayed</td>
                        <td class="align-middle text-start">16,7 mln</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold text-center">HDR</td>
                        <td class="align-middle text-start">HDR 10</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</div>
<?php //include "sidebar_top.php"; ?>
<?php //include "sidebar_bottom.php"; ?> 


<?php include dirname(__FILE__,2) . "/footer.php"; ?>
