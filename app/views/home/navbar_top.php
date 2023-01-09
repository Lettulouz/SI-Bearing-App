<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-custom-4 mb-3" style="z-index:100000;">
    <div class="container-fluid">
        <a class="navbar-brand" href=<?php echo ROOT."/home"?>><?=$data['siteName']['sitename']?></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href=<?php echo ROOT."/home"?>>Strona główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href=<?php echo ROOT."/store"?>>Sklep</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> 
                     <?php if($data['isLogged'] == "true"){?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                                Witaj <?=$data['loggedUser_name']?>!
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="<?=ROOT?>/logout">Wyloguj</a>
                                </li>
                            </ul>
                        </li>
                    <?php }else{ ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=ROOT?>/login">Zaloguj</a>
                        </li>
                    <?php }?>
            </ul>
        </div>
    </div>
</nav>
 

