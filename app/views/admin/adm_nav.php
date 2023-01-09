<!doctype html>
<html>
    <head>
        <title>Panel administratora</title>
        <link rel="icon" type="image" href="<?=MAINPATH?>/resources/shopPhotos/siteicon.png">
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?=CUSTOMCSS?>/admin.css">

        <!--Bootstrap JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

    </head>
    <body>
        <!-- Navbar -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <!--Sidebar button-->
                <button class="btn btn-dark side-btn mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand fw-bold" href=<?php echo ROOT."/admin/"?>>Admin</a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">

                                <li><a class="dropdown-item" href="<?=ROOT?>/admin/logout"> Wyloguj</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <div class="offcanvas offcanvas-start sidecustomcolor text-white sidebar" data-bs-scroll="true" 
            data-bs-backdrop="false" tabindex="-1" id="sidebar" aria-labelledby="offcanvasDarkLabel">
            <div class="offcanvas-body sidebar_body">
                <nav class="navbar-dark">
                    <ul class="navbar-nav">
                        <li class="my-2">
                            <a id="gotoadmain" class="text-muted small fw-bold text-uppercase text-decoration-none" 
                            href=<?php echo ROOT."/admin/"?>>Strona główna</a>
                        </li>
                        <li class="my-3">
                            <hr class="dropdown divider">
                        </li>
                        <li>
                            <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link"
                            data-bs-toggle="collapse" href="#users_collapse" role="button"  aria-controls="users_collapse" 
                            aria-expanded="false" id="users_collapse_btn">Użytkownicy
                                <span class="bi bi-chevron-right right-icon ms-auto"></span>
                            </a>
                            <div class="collapse" id="users_collapse">
                                <a href=<?php echo ROOT."/admin/list_of_users"?> id="user_lists" class="nav-link text-muted">
                                    Lista użytkowników
                                </a>
                                <a href="<?php echo ROOT."/admin/add_user"?>" class="nav-link text-muted" id="addus">
                                    Dodawanie użytkowników
                                </a>
                                <hr class="divider ">
                                <a href="<?php echo ROOT."/admin/list_of_content_managers"?>" id="mn_list" class="nav-link text-muted">
                                    Lista menedżerów contentu
                                </a>
                                <a href="<?php echo ROOT."/admin/add_manager"?>" class="nav-link text-muted" id="addman">
                                    Dodawanie menedżerów contentu
                                </a>
                                <hr class="divider">
                                <a href="<?php echo ROOT."/admin/list_of_administrators"?>" id="ad_list" class="nav-link text-muted">
                                    Lista administratorów
                                </a>
                                <a href="<?php echo ROOT."/admin/add_admin"?>" class="nav-link text-muted" id="addad">
                                    Dodawanie administratorów
                                </a>
                                <hr class="divider ">
                                <a href="<?php echo ROOT."/admin/list_of_service_accounts"?>" id="sa_list" class="nav-link text-muted">
                                    Lista obsługi sklepu
                                </a>
                                <a href="<?php echo ROOT."/admin/add_shop_service"?>" id="addsa" class="nav-link text-muted">
                                    Dodawanie obsługi sklepu
                                </a>
                                <hr class="divider">
                                <a href="<?php echo ROOT."/admin/list_of_orders"?>" id="ord_list" class="nav-link text-muted">
                                    Zamówienia
                                </a>
                                <a href="<?php echo ROOT."/admin/sales_report"?>" id="sales_report" class="nav-link text-muted">
                                    Raporty sprzedaży
                                </a>
                            </div>
                        </li>
                        <li class="my-3">
                            <hr class="dropdown divider">
                        </li>
                        <li>
                            <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link "
                            data-bs-toggle="collapse" id="content_collapse_btn" href="#content_collapse" role="button" 
                            aria-expanded="false" aria-controls="content_collapse">Produkty
                                <span class="bi bi-chevron-right right-icon ms-auto"></span>
                            </a>
                            <div class="collapse" id="content_collapse">
                                <a href="<?php echo ROOT."/admin/list_of_items"?>" id="prd_list" class="nav-link text-muted">
                                    Lista produktów
                                </a>
                                <a href="<?php echo ROOT."/admin/list_of_uncategorized_items"?>" id="uc_prd_list" class="nav-link text-muted">
                                    Lista produktów bez kategorii
                                </a>
                                <a href="<?php echo ROOT."/admin/add_item"?>" id="additem" class="nav-link text-muted">
                                    Dodaj produkty
                                </a>

                                <hr class="divider">

                                <a href="<?php echo ROOT."/admin/list_of_catalogs"?>" class="nav-link text-muted" id="cat_list">
                                    Lista katalogów
                                </a>
                                <a href="<?php echo ROOT."/admin/add_catalog"?>" id="addcat" class="nav-link text-muted">
                                    Dodaj katalog
                                </a>

                                <hr class="divider">

                                <a href="<?php echo ROOT."/admin/list_of_attributes"?>" id="attr_list" class="nav-link text-muted">
                                    Lista atrybutów
                                </a>
                                <a href="<?php echo ROOT."/admin/add_attribute"?>" id="addattr" class="nav-link text-muted">
                                    Dodaj atrybut
                                </a>

                                <hr class="divider">

                                <a href="<?php echo ROOT."/admin/list_of_manufacturers"?>" id="manuf_list" class="nav-link text-muted">
                                    Lista producentów
                                </a>
                                <a href="<?php echo ROOT."/admin/add_manufacturer"?>" id="addmanuf" class="nav-link text-muted">
                                    Dodaj producenta
                                </a>
                                <a href="<?php echo ROOT."/admin/add_countries_to_manufacturer"?>" id="addcounttomanuf" 
                                class="nav-link text-muted">
                                    Kraje producenta
                                </a>

                                <hr class="divider ">

                                <a href="<?php echo ROOT."/admin/list_of_categories"?>" id="categ_list" class="nav-link text-muted">
                                    Lista kategorii
                                </a>
                                <a href="<?php echo ROOT."/admin/add_category"?>" id="addcateg" class="nav-link text-muted">
                                    Dodaj kategorię
                                </a>                        
                            </div>
                        </li>
                        <li class="my-3">
                            <hr class="dropdown divider">
                        </li>
                        <li>
                            <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link "
                            data-bs-toggle="collapse" id="pages_collapse_btn" href="#pages_collapse" role="button" 
                            aria-expanded="false" aria-controls="pages_collapse">Podstrony
                                <span class="bi bi-chevron-right right-icon ms-auto"></span>
                            </a>
                            <div class="collapse" id="pages_collapse">
                                <a href="<?php echo ROOT."/admin/edit_page/1"?>" id="editpage1" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c1r1']) ? $data['siteLinks']['c1r1'] : 'Strona 1' ?>
                                </a>
                                <a href="<?php echo ROOT."/admin/edit_page/2"?>" id="editpage2" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c1r2']) ? $data['siteLinks']['c1r2'] : 'Strona 2' ?>
                                </a>          
                                <a href="<?php echo ROOT."/admin/edit_page/3"?>" id="editpage3" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c1r3']) ? $data['siteLinks']['c1r3'] : 'Strona 3' ?>
                                </a>
                                <a href="<?php echo ROOT."/admin/edit_page/4"?>" id="editpage4" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c1r4']) ? $data['siteLinks']['c1r4'] : 'Strona 4' ?>
                                </a>   
                                <a href="<?php echo ROOT."/admin/edit_page/5"?>" id="editpage5" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c2r1']) ? $data['siteLinks']['c2r1'] : 'Strona 5' ?>
                                </a>
                                <a href="<?php echo ROOT."/admin/edit_page/6"?>" id="editpage6" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c2r2']) ? $data['siteLinks']['c2r2'] : 'Strona 6' ?>
                                </a>          
                                <a href="<?php echo ROOT."/admin/edit_page/7"?>" id="editpage7" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c2r3']) ? $data['siteLinks']['c2r3'] : 'Strona 7' ?>
                                </a>
                                <a href="<?php echo ROOT."/admin/edit_page/8"?>" id="editpage8" class="nav-link text-muted">
                                    <?=!empty($data['siteLinks']['c2r4']) ? $data['siteLinks']['c2r4'] : 'Strona 8' ?>
                                </a>   
                                <a href="<?php echo ROOT."/admin/edit_page/9"?>" id="editpage9" class="nav-link text-muted">
                                    Dolny tekst
                                </a>   
                            </div>
                        </li>
                        <li class="my-3">
                            <hr class="dropdown divider">
                        </li>
                        <li>
                            <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link "
                            data-bs-toggle="collapse" id="settings_collapse_btn" href="#settings_collapse" role="button" 
                            aria-expanded="false" aria-controls="settings_collapse">Ustawienia
                                <span class="bi bi-chevron-right right-icon ms-auto"></span>
                            </a>
                            <div class="collapse" id="settings_collapse">
                                <a href="<?php echo ROOT."/admin/edit_informations"?>" id="infoedit" class="nav-link text-muted">
                                    Informacje
                                </a>
                                <a href="<?php echo ROOT."/admin/edit_footer"?>" id="footedit" class="nav-link text-muted">
                                    Stopka
                                </a>          
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <main class="mt-5 pt-3" id="adm-main">

