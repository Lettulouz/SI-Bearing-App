<?php
include 'adm_nav.php';

?>
<div class="container-fluid">
<a class="text-muted small fw-bold text-uppercase text-decoration-none dash-list"
         data-bs-toggle="collapse" href="#dashcollapse1" role="button" aria-expanded="true" aria-controls="dashcollapse1">Użytkownicy
         <span class="bi bi-chevron-down right-icon ms-auto"></span>
        </a>
        <div class="collapse multi-collapse show" id="dashcollapse1">
            <div class="row">
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-success mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-fill"></i>&nbspUżytkownicy</div>
            <div class="card-body">
                <h5 class="card-title">Tytuł jakiś</h5>
                <p class="card-text">Tu będzie liczba użytkowników czy coś, dopracuje to</p>
            </div>
            <div class="card-footer">
                <div class="row">
                <div class="col-12">
                <a href=<?php echo ROOT."/admin/list_of_users"?> id="user_lists" class="nav-link text-white">
                    Przeglądaj użytkowników
                </a>
                </div>
                <div class="col-12">
                    
                </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
            <div class="card text-white bg-warning mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-fill-gear"></i>&nbspMenadżerowie</div>
            <div class="card-body">
                <h5 class="card-title">Warning card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer">Footer</div>
            </div>
          
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-3">
        <div class="card text-white bg-danger mb-3 h-100" >
            <div class="card-header"><i class="bi bi-person-vcard"></i>&nbspAdministratorzy</div>
            <div class="card-body">
                <h5 class="card-title">Danger card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer">Footer</div>
            </div>
        </div>
        
        
        </div>
    </div>
  </div>
</div>
<script>
    document.getElementById('gotoadmain').setAttribute( 'style', 'color:white !important' );
</script>

<?php
include 'adm_feet.php';

?>