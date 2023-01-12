<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>


<div class="homeMain">
    <div class="container d-flex">
        <div class="row vw-100 mt-3">
            <div class="col-sm-6 border border-0">
                <?php 
                $imagePath = APPPATH . "/resources/itemsPhotos/[" . $data['id'] . "].png";
                $imagePathCheck = PHOTOSPATH . "/[" . $data['id'] . "].png";

                if (!file_exists($imagePathCheck)) {
                    $imagePath = APPPATH . "/resources/itemsPhotos/brak_zdjecia.png";
                }

                echo "<img src='$imagePath' alt='zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain;'>";

                ?>
            </div>
            <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center border-0">

                <h1 class="text-wrap fs-1 text"><?= $data['itemParams']['name'] ?></h1>
                <h4 class="text-wrap text fw-light">Producent: <?= $data['itemParams']['manname'] ?></h3>
                    <h6 class="text-wrap text"><?= $data['itemParams']['price'] ?> zł</h6>
                    <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center">
                        <button class="btn btn-success py-2 px-4 mt-4 addItemToCartButton" id='<?php echo $data['id']."-".$data['itemParams']['price'].
                        "-".$data['itemParams']['amount']."-".$data['itemParams']['isDouble']?>' name='addToCart'>Dodaj do koszyka</button>    
                    </div>
            </div>
        </div>
    </div>
    <hr>
    <h3 class="text-muted p-2 ms-7 mb-3">Opis produktu</h3>

    <div class="container mb-5">
        <?php
        $descriptions = $data['itemDescrs'];
        if (!empty($descriptions)) {
            foreach ($descriptions as $description) {
                $desc = $description['description'];
                $title = $description['title'];
                echo "<h5 class='text-wrap text text-left mb-3'>$title</h5>
                <h6 class='text-muted text-wrap text text-left mb-5 fw-light fs-5'>$desc</h6>";
            }
        } else {
            echo "<h5 class='text-wrap text text-left border-0'>Ooops! Administrator serwisu nie dostarczył żadnego opisu dla tego produktu!</h5>";
        }
        ?>
    </div>

    <hr>
    <h3 class="text-muted p-2 ms-7 mb-3">Specyfikacja</h3>

    <div class="container mb-5">
        <div class="table-responsive">
            <?php
            $attributes = $data['itemAttrs'];
            if (!empty($attributes)) {
                echo "<table class='table table-striped table-hover border-top border-top'>
                <tbody>";
                foreach ($attributes as $attribute) {
                    $attrName = $attribute['attrName'];
                    $attrUnit = $attribute['attrUnit'];
                    $attrValue = $attribute['attrValue'];
                    echo "<tr>
                    <td class='align-middle fw-bold text-end'>$attrName</td>
                    <td class='align-middle fw-bold text-start'>$attrUnit</td>
                    <td></td>
                    <td></td>              
                    <td class='align-middle text-start'>$attrValue</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<h5 class='text-wrap text text-left border-0'>Ooops! Administrator serwisu nie dostarczył żadnych atrybutów dla tego produktu!</h5>";
            }
            ?>
        </div>
    </div>
</div>
<?php //include "sidebar_top.php"; 
?>
<?php //include "sidebar_bottom.php"; 
?>


<?php include dirname(__FILE__, 2) . "/footer.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<script>
    $(document).ready(function() {
        $(".addItemToCartButton").click(function(){
            $(this).addClass('animated bounce');
            setTimeout(function(){
                $('.addItemToCartButton').removeClass('animated bounce');
            },1000);
        });
    });

    $('[name="addToCart"]').click(function() {
        let idValueAmount = jQuery(this).attr("id").split("-");

        if (!sessionStorage.getItem(idValueAmount[0]))
            sessionStorage.setItem(idValueAmount[0], '1' + '-' + idValueAmount[1] + '-' + idValueAmount[2] + '-' + idValueAmount[3]);
        else {
            let valueAndAmount = sessionStorage.getItem(idValueAmount[0]).split("-");
            if (valueAndAmount[2] >= valueAndAmount[0] + 1) {
                var newValue = parseFloat(valueAndAmount[0]) + 1;
                sessionStorage.setItem(idValueAmount[0], newValue + '-' + idValueAmount[1] + '-' + idValueAmount[2] + '-' + idValueAmount[3]);
            }
        }
        var newCookie = "";

        Object.keys(sessionStorage).forEach(function(key, value) {
            if (!Number.isNaN(Number.parseInt(key)))
                newCookie += key + ', ';
        });
        var today = new Date();
        var expire = new Date();
        expire.setTime(today.getTime() + 3600000 * 24 * 7);
        document.cookie = 'itemsInCart =' + newCookie + ';3600, expires=' + expire.toGMTString() + '; path=/';
    });
</script>