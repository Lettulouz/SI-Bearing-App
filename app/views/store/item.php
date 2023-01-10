<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>


<div class="homeMain">
    <div class="container d-flex" style="min-height: 400px;">
        <div class="row vw-100">
            <div class="col-sm-6 border border-1" style="max-height: 400px;">
                <img src="<?= APPPATH ?>/resources/itemsPhotos/brak_zdjecia.png" alt='zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:286px;'>
            </div>
            <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center border-0" style="max-height: 400px;">

                <h1 class="text-wrap fs-1 text"><?= $data['itemParams']['name'] ?></h1>
                <h4 class="text-wrap text fw-light">Producent: <?= $data['itemParams']['manname'] ?></h3>
                    <h6 class="text-wrap text"><?= $data['itemParams']['price'] ?> zł</h6>
                    <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center">
                        <a href="#" class="btn btn-success py-2 px-4 mt-4">Dodaj do koszyka</a>

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
                    $attrValue = $attribute['attrValue'];
                    echo "<tr>
                    <td class='align-middle fw-bold text-center'>$attrName</td>
                    <td class='align-middle text-start'>$attrValue</td>
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