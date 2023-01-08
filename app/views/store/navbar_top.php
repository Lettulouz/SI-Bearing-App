<div class="mb-7 mb-lg-6">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-custom-4 mb-5" style="z-index:100000;">
        <div class="container-fluid">
            <button class="navbar-toggler position-absolute top-0 end-0 me-2 mt-2 d-default d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> 

            <a class="navbar-brand" href=<?php echo ROOT."/home"?> style="margin-top:-4px">Grontsmar</a>                 

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=<?php echo ROOT."/home"?>>Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=<?php echo ROOT."/store"?>>Sklep</a>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-none d-lg-flex flex-grow-1" id="searchBoxUl"> 
                <div class="input-group">
                    <input type='text' class='form-control form-sm' id='searchRemote1' 
                    value='<?=isset($data['search']) ? $data['search'] : '' ?>' name='searchRemote1' placeholder="szukaj" autocomplete="off">
                    <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                        <i class="bi bi-x"></i>
                    </button>
                    <button class="btn btn-outline-primary sub" name="remoteSearchFormSubmit" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </ul>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> 
                    <li class="nav-item d">
                        <a class="nav-link mt-1" href="<?=PUBLICPATH?>/store/cart">
                            <i class="bi bi-basket2 "></i>
                        </a>
                    </li>
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
        <div class="container-fluid d-block d-lg-none">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 mt-3" id="searchBoxUl"> 
                <div class="input-group">
                    <input type='text' class='form-control form-sm' id='searchRemote2' 
                    value='<?=isset($data['search']) ? $data['search'] : '' ?>' name='searchRemote2' placeholder="szukaj" autocomplete="off">
                    <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                        <i class="bi bi-x"></i>
                    </button>
                    <button class="btn btn-outline-primary sub" name="remoteSearchFormSubmit" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </ul>
        </div>
    </nav>
</div>
 

