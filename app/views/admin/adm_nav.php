<!doctype html>
<html >
  <head>
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
            <li><a class="dropdown-item" href="#">troche tego</a></li>
            <li><a class="dropdown-item" href="#">troche tamtego</a></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/admin/logout"> Wyloguj</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Sidebar -->

<div class="offcanvas offcanvas-start sidecustomcolor text-white sidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="sidebar" aria-labelledby="offcanvasDarkLabel">
  <div class="offcanvas-body">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li class="my-2"><a id="gotoadmain" class="text-muted small fw-bold text-uppercase text-decoration-none"  href=<?php echo ROOT."/admin/"?>>Strona główna</a></li>
        <li class="my-3">
          <hr class="dropdown divider">
        </li>
        <li>
        <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link"
         data-bs-toggle="collapse" href="#users_collapse" role="button"  aria-controls="users_collapse" aria-expanded="false" id="users_collapse_btn">Użytkownicy
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
          <a href="#" class="nav-link text-muted">
           Dodawanie menedżerów contentu
          </a>
          <hr class="divider">
          <a href="<?php echo ROOT."/admin/list_of_administrators"?>" id="ad_list" class="nav-link text-muted">
            Lista administratorów
          </a>
          <a href="#" class="nav-link text-muted">
            Dodawanie administratorów
          </a>
          <hr class="divider  ">
          <a href="<?php echo ROOT."/admin/list_of_orders"?>" id="ord_list" class="nav-link text-muted">
            Zamówienia
          </a>
         </div>
        </li>
        <li class="my-3">
          <hr class="dropdown divider">
        </li>
        <li>
        <a class="text-muted small fw-bold text-uppercase text-decoration-none sidebar-link "
         data-bs-toggle="collapse" id="content_collapse_btn" href="#content_collapse" role="button" aria-expanded="false" aria-controls="content_collapse">Produkty
         <span class="bi bi-chevron-right right-icon ms-auto"></span>
        </a>
         <div class="collapse" id="content_collapse">
          <a href="<?php echo ROOT."/admin/list_of_products"?>" id="prd_list" class="nav-link text-muted">
            Lista produktów
          </a>
          <a href="<?php echo ROOT."/admin/add_item"?>" id="additem" class="nav-link text-muted">
            Dodaj produkty
          </a>

          <hr class="divider  ">

          <a href="<?php echo ROOT."/admin/list_of_catalogs"?>" class="nav-link text-muted" id="cat_list">
            Lista katalogów
          </a>
          <a href="<?php echo ROOT."/admin/add_catalog"?>" id="addcat" class="nav-link text-muted">
            Dodaj katalog
          </a>

          <hr class="divider ">

          <a href="<?php echo ROOT."/admin/list_of_attributes"?>" id="attr_list" class="nav-link text-muted">
            Lista atrybutów
          </a>
          <a href="<?php echo ROOT."/admin/add_attribute"?>" id="addattr" class="nav-link text-muted">
            Dodaj atrybut
          </a>

          <hr class="divider ">

          <a href="<?php echo ROOT."/admin/list_of_manufacturers"?>" id="manuf_list" class="nav-link text-muted">
            Lista producentów
          </a>
          <a href="<?php echo ROOT."/admin/add_manufacturer"?>" id="addmanuf" class="nav-link text-muted">
            Dodaj producenta
          </a>

          <hr class="divider ">

          <a href="<?php echo ROOT."/admin/list_of_categories"?>" id="categ_list" class="nav-link text-muted">
            Lista kategorii
          </a>
          <a href="<?php echo ROOT."/admin/add_categories"?>" id="addcateg" class="nav-link text-muted">
            Dodaj kategorię
          </a>
          
         </div>
        </li>
      </ul>
    </nav>
  </div>
</div>
<main class="mt-5 pt-3" id="adm-main">

