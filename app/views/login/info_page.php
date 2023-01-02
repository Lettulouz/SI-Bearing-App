<html>
    <head> 

        <title>PHP</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?=CUSTOMCSS?>/registerandlogin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?=APPPATH?>/scripts/login.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body style="display: flex; justify-content: center; align-items:center;  height:100vh;">   
        <div class="text-center d-flex flex-column" > 
            <?php if($data['infoPage']==1){?>
                <i class='bx bx-paper-plane' style="font-size:75px;"></i> 
                <span class="text-center fs-1">
                    Jeżeli konto o podanym adresie email istnieje
                    <br>
                    to zostanie na niego wysłany link do restowania hasła
                </span> 

                <a class="mt-5" href="<?=PUBLICPATH?>/login">
                    <i class="bi bi-signpost" style='font-size:75px; color:black;'></i>                   
                </a>       
                <a class="mt-3" href="<?=PUBLICPATH?>/login">
                    <label style="font-size:35px; color:black; font-weight:bold;">Powrót</label>
                </a>  
            <?php }else if($data['infoPage']==2){ ?>
                <i class='bx bxs-badge-check bx-lg bx-flashing' style="color:green"></i> 
                <span class="text-center fs-1">
                    Hasło do konta zostało zmienione
                </span> 

                <a class="mt-5" href="<?=PUBLICPATH?>/login">
                    <i class="bi bi-signpost" style='font-size:75px; color:black;'></i>                   
                </a>       
                <a class="mt-3" href="<?=PUBLICPATH?>/login">
                    <label style="font-size:35px; color:black; font-weight:bold;">Logowanie</label>
                </a>  
            <?php }else if($data['infoPage']==3){ ?>
                <div class="text-center d-flex flex-column" > 
                <i size="lg" class='bx bxs-error bx-lg bx-flashing' style="color:red"></i> 
                <span class="text-center fs-1" style="color:red">
                    Błąd!
                    <br>
                    Link aktywacyjny wygasł lub jest nieprawidłowy
                </span> 
                
                <a class="mt-5" href="<?=ROOT?>">
                    <i class="bi bi-signpost bi-10x" style='font-size:75px; color:black;'></i>                   
                </a>       
                <a class="mt-3" href="<?=ROOT?>">
                    <label style="font-size:35px; color:black; font-weight:bold;">Strona główna</label>
                </a>       
            </div>
            <?php }?>
        </div>
    </body>
</html>