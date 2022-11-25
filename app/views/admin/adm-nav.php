<!doctype html>
<html >
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSSPATH?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <!-- temp -->
    <!-- style tu bo nie działają -->
    <style>
              :root{
            --offcanvas-width: 400px;
            --topNavbarHeight:56px;
        }

        .sidebar{
            width: var( --offcanvas-width);
            top: var( --topNavbarHeight);
            height: calc(100%-var( --topNavbarHeight));
        }
        
        @media (min-width:992px){
          body{
            overflow: auto !important;
          }
          .offcanvas-backdrop::before{
            display: none;
          }
          .sidebar{
            transform: none;
            visibility: visible !important;
          }
          .side-btn{
            display:none;
          }
        }
    </style>


  </head>
<body>
    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark bg-dark">
  <div class="container-fluid">
    <!--Sidebar button-->
    <button class="btn btn-dark side-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
    <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand fw-bold" href="#">Admin</a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
    <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">troche tego</a></li>
            <li><a class="dropdown-item" href="#">troche tamtego</a></li>
            <li><a class="dropdown-item" href="#">Wyloguj</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Sidebar -->

    <div class="offcanvas offcanvas-start bg-dark text-white sidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="sidebar" aria-labelledby="offcanvasDarkLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Tu będą rzeczy</h5>
  </div>
  <div class="offcanvas-body">
    <p>Tu będzie więcej rzeczy</p>
  </div>
</div>

