<?php include "homeHeader.php"; ?>
<?php include "navbar_top.php"; ?>

<div class="mt-5">
    <div class="container-fluid d-flex">
        <div class="row vw-100 w-25 mb-5">
            <div class="col-sm-12 px-0 dominik-test d-sm-block" style="height: 300px; background-image:url(<?= APPPATH . "/resources/upload/baner.png"?>)">
              


            </div>
        </div>
    </div>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?=$data['siteName']['sitename']?></h2>
                <h3 class="section-subheading text-muted mb-4">Nasze usługi</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="<?=$data['homeData']['icon1']?> icon-size-dom"></i>

                    </span>
                    <h4 class="my-3"><?=$data['homeData']['title1']?></h4>
                    <p class="text-muted"><?=$data['homeData']['desc1']?></p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="<?=$data['homeData']['icon2']?> icon-size-dom"></i>
                    </span>
                    <h4 class="my-3"><?=$data['homeData']['title2']?></h4>
                    <p class="text-muted"><?=$data['homeData']['desc2']?></p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="<?=$data['homeData']['icon3']?> icon-size-dom"></i>
                    </span>
                    <h4 class="my-3"><?=$data['homeData']['title3']?></h4>
                    <p class="text-muted"><?=$data['homeData']['desc3']?></p>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid d-flex mt-4">
        <div class="row vw-100 wh-100">
            <iframe class="embed-responsive-item" style="width: 100vw;height: 100vh;position: relative;"
                src="<?=$data['homeData']['youtubeUrl']?>" allowfullscreen></iframe>
        </div>
    </div>

    <!-- Products-->

        <div class="container mt-5 mb-5">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?=$data['siteName']['sitename']?></h2>
                <h3 class="section-subheading text-muted mb-4">Nasze produkty</h3>
            </div>

            <div class="d-block container align-items-center">
                <div class="row">
                    <?php if(!empty($data['selectedItems'])) {?>
                        <?php if(!empty($data['selectedItems'][0]['id'])){ ?> 
                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="card h-100 mt-3">
                                    <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][0]['id']?>">
                                        <?php if(file_exists(PHOTOSPATH . "/[" . $data['selectedItems'][0]['id'] . "].png")){ ?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/[<?=$data['selectedItems'][0]['id']?>].png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php }else{?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/brak_zdjecia.png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php } ?>
                                    </a>
                                    <div class="card-body" style="min-height:130px;">
                                        <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][0]['id']?>">
                                            <h5 class="text-dark text-center"><?=$data['selectedItems'][0]['name']?></h5>
                                            <h6 class="card-text text-center text-muted fw-light"><?=$data['selectedItems'][0]['manname']?></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(!empty($data['selectedItems'][1]['id'])){ ?> 
                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="card h-100 mt-3">
                                    <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][1]['id']?>">
                                        <?php if(file_exists(PHOTOSPATH . "/[" . $data['selectedItems'][1]['id'] . "].png")){ ?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/[<?=$data['selectedItems'][1]['id']?>].png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php }else{?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/brak_zdjecia.png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php } ?>
                                    </a>
                                    <div class="card-body" style="min-height:130px;">
                                        <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][1]['id']?>">
                                            <h5 class="text-dark text-center"><?=$data['selectedItems'][1]['name']?></h5>
                                            <h6 class="card-text text-center text-muted fw-light"><?=$data['selectedItems'][1]['manname']?></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(!empty($data['selectedItems'][2]['id'])){ ?> 
                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="card h-100 mt-3">
                                    <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][2]['id']?>">
                                        <?php if(file_exists(PHOTOSPATH . "/[" . $data['selectedItems'][2]['id'] . "].png")){ ?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/[<?=$data['selectedItems'][2]['id']?>].png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php }else{?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/brak_zdjecia.png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php } ?>
                                    </a>
                                    <div class="card-body" style="min-height:130px;">
                                        <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][2]['id']?>">
                                            <h5 class="text-dark text-center"><?=$data['selectedItems'][2]['name']?></h5>
                                            <h6 class="card-text text-center text-muted fw-light"><?=$data['selectedItems'][2]['manname']?></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(!empty($data['selectedItems'][3]['id'])){ ?> 
                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="card h-100 mt-3"    >
                                    <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][3]['id']?>">
                                        <?php if(file_exists(PHOTOSPATH . "/[" . $data['selectedItems'][3]['id'] . "].png")){ ?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/[<?=$data['selectedItems'][3]['id']?>].png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php }else{?>
                                            <img src='<?=APPPATH?>/resources/itemsPhotos/brak_zdjecia.png' 
                                            alt='Zdjęcie łożyska' class='card-img-top img-thumbnail' style='object-fit:contain; height:240px;'>
                                        <?php } ?>
                                    </a>
                                    <div class="card-body" style="min-height:130px;">
                                        <a href="<?=ROOT?>/store/item/<?=$data['selectedItems'][3]['id']?>">
                                            <h5 class="text-dark text-center"><?=$data['selectedItems'][3]['name']?></h5>
                                            <h6 class="card-text text-center text-muted fw-light"><?=$data['selectedItems'][3]['manname']?></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>


</div>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>