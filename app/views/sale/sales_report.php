<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>


<h1 class="text-muted headers-padding">Raporty sprzedaży</h1>
    <hr class="divider mt-0">
        <div class="container">
            <form method="post" autocomplete="off" class="m-0" action="">
                <div class="row justify-content-center mx-0 px-1 mb-5  needs-validation">
                    <div class="col-4 ms-lg-4 me-1 px-0">
                        <input class="form-control" type="date" name="dateFrom"
                        value="<?=isset($_POST['dateFrom']) ? $_POST['dateFrom'] : '' ?>" required>
                    </div>
                    <div class="col-4 me-1 px-0">
                        <input class="form-control" type="date"  name="dateTo"
                        value="<?=isset($_POST['dateTo']) ? $_POST['dateTo'] : '' ?>" required>
                    </div>

                    <div class="col-1 ms-lg-5 px-0">
                        <button type="submit" class="btn btn-primary" name="reportSub">Generuj</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container">
            <?php
            if(isset($_POST['reportSub'])){

            echo "
            <div class='container'>
            <div class='text-white bg-secondary p-1 mb-3'>
            <h5 class='m-0'>Raport sprzedaży w okresie od ".$_POST['dateFrom']." do ".$_POST['dateTo']."</h5></div>

            <table class='table table-striped'>
                <thead>
                    <tr>
                         <th>Przedmiot</th>
                         <th>Cena</th>
                         <th>Producent</th>
                         <th>Kraj</th>
                         <th>Wartość sprzedaży</th>
                         <th>Łączna sprzedaż</th>
                    </tr>
                </thead>
                <tbody>";
                    foreach($data['selling'] as $item){
                        echo "<tr>
                        <td>{$item['item']}</td>
                        <td>{$item['price']}</td>
                        <td>{$item['mnf']}</td>
                        <td>{$item['country']}</td>
                        <td>{$item['earnings']}</td>
                        <td>{$item['sellAmount']}</td>
                        </tr>";
                    }
                echo "</tbody>
            </table>

            <b class='m-1'>Sprzedane produkty: ".$data['amount']."</b><br>
            <b class='m-1'>Wartość sprzedaży: ".$data['earnings']." zł</b>
            </div>";
                }
            ?>
        </div>

    <script>
    document.getElementById('store_collapse').classList.add('show');
    document.getElementById('store_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('store_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('sales_report').setAttribute( 'style', 'color:white !important' );

    </script>