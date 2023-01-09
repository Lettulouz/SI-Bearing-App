<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

<h1 class="text-muted headers-padding">Raporty sprzedaży</h1>
    <hr class="divider mt-0">
        <form method="post" autocomplete="off" class="m-0" action="">
            <div class="row justify-content-center mx-0 px-1 mb-5  needs-validation">
                <div class="col-4 col-lg-3 me-1 px-0">
                    <input class="form-control" type="date" name="dateFrom"
                    value="<?=isset($_POST['dateFrom']) ? $_POST['dateFrom'] : '' ?>" required>
                </div>
                <div class="col-4 col-lg-3 px-0">
                    <input class="form-control" type="date"  name="dateTo"
                    value="<?=isset($_POST['dateTo']) ? $_POST['dateTo'] : '' ?>" required>
                </div>

                <div class="col-2 ms-1 px-0">
                    <button type="submit" class="btn btn-primary" name="reportSub">Generuj</button>
                </div>
            </div>
        </form>
        <div class="container">
            <?php
            if(isset($_POST['reportSub']))
            echo "<div class='text-white bg-secondary p-1 mb-2'>
            <h5 class='m-0'>Raport sprzedaży w okresie od ".$_POST['dateFrom']." do ".$_POST['dateTo']."</h5></div>
            <p>Sprzedane produkty: ".$data['amount']."</p>";
            
            ?>
        </div>

    <script>
    document.getElementById('users_collapse').classList.add('show');
    document.getElementById('users_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('users_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('sales_report').setAttribute( 'style', 'color:white !important' );
    </script>