<!doctype html>
<html >
  <head>
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

  <style>
  

  </style>

  </head>
<body>
    <!-- Navbar -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<nav class="navbar navbar-expand navbar-dark fixed-top" style="background-color:#363338;">
  <div class="container-fluid">
    <!--Sidebar button-->
    <button class="btn btn-dark side-btn mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
    <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand fw-bold text-white" href=<?php echo ROOT."/service"?>>Obsługa sklepu</a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
    <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">

            <li><a class="dropdown-item" href="<?=ROOT?>/service/logout">Wyloguj</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Sidebar -->

<div class="offcanvas offcanvas-start text-white sidebar " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" 
 style="background:#332f36;" id="sidebar" aria-labelledby="offcanvasDarkLabel">
  <div class="offcanvas-body mng_side">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li class="my-2"><a id="gotosrvmain" class="text-muted small fw-bold text-uppercase text-decoration-none"  href=<?php echo ROOT."/service"?>>Strona główna</a></li>
        <li class="my-3">
          <hr class="dropdown divider">
        </li>
        <li>
          <a href="" id="ord_list" class="nav-link text-muted">
            Zamówienia
          </a>
          <a href="" id="sales_report" class="nav-link text-muted">
            Raporty sprzedaży
          </a>
          

        </li>
      </ul>
    </nav>
  </div>
</div>
<main class="mt-5 pt-3" id="adm-main">

