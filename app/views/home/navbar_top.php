<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light mb-3" style="z-index:100000;">
  <div class="container-fluid">
    <a class="navbar-brand" href=<?php echo ROOT."/public/index"?>> Grontsmar</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href=<?php echo ROOT."/public/index"?> >Home</a>
        </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> 
        <li class="nav-item d">
          <a class="nav-link mt-1" href="<?=PUBLICPATH?>/home/basket">
             <i class="bi bi-basket2 "></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Witaj użytkowniku!
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#" > Wyloguj</a></li>
          </ul>
        </li>
      </div>
</nav>
 

