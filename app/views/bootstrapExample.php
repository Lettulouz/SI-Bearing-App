<!doctype html>
<html>
    <head> 

        <title>PHP</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" 
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <!--
    sm -> 576px
    md -> 768px
    lg -> 992px
    xl -> 1200px

    col-(prefix)-{column_amount}
    max(column_amount) = 12
    -->

    <h1 style="text-align: center">Witaj w naszym sklepie z łożyskami!</h1>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-4 border">
                    <p style="text-align: center;"> <b>Użytkownicy</b></p>
                    <p>
                        <ul>
                            <li>Dominik</li>
                            <li>Kornel</li>
                            <li>Mikołaj</li>
                        </ul>
                    </p>
                </div>
                <div class="col-12 col-md-6 col-xl-4 border">
                    <p style="text-align: center;"> <b>Kategorie</b></p>
                    <p>
                        <ul>
                            <li>Łożyska</li>
                            <li>Simmeringi</li>
                            <li>Segery</li>
                        </ul>
                    </p>
                </div>
                <div class="col-12 col-xl-4 border">
                    <p style="text-align: center;"> <b>Towar</b></p>
                    <p>
                        <ul>
                            <li>ZVL 6004ZZ</li>
                            <li>SKF 20x47x7</li>
                            <li>Segery</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" 
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" 
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
            crossorigin="anonymous"></script>
    </body>

</html>