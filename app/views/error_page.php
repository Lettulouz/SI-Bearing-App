<html>
    <head> 

        <title>Błąd!</title>
        <link rel="icon" type="image" href="<?=MAINPATH?>/resources/shopPhotos/siteicon.png">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?=CUSTOMCSS?>/registerandlogin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?=APPPATH?>/scripts/login.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body style="display: flex; justify-content: center; align-items:center;  height:100vh;">
        <div style="display: default;" id="errorLoginPage">
            <div class="text-center d-flex flex-column" > 
                <i size="lg" class='bx bxs-error bx-lg bx-flashing' style="color:red"></i> <span class="text-center fs-1" style="color:red"><?=$data['firstLine']?><br><?=$data['secondLine']?></span> 
            </div>
        </div>
    </body>
</html>