<?php include "header.php"; ?>
<?php// include "menu.php"; ?>

    <center> <h1>Firma Grontsmar</h1> </center>
    <?php
    $search = '';
    if(isset($data['search']))
        $search = $data['search'];

    echo '<form method="POST" action ="" >';
    echo "<input type='submit' value='Szukaj' />";
    echo "<input type='text' value='".$search."' name='search'/>";


    ?>

    <?php
    $j = 0;
    $three = 3;
    $items = $data['itemsArray'];
    echo "<div class='container'>";
    echo "<div class='row'>";
    foreach($items as $j => $item) 
    {



            echo "<div class='col-12 col-md-6 col-lg-3'>
                    <div class='card'>
                        <img src='https://i.imgur.com/uqTzNBt.jpg'  alt='zdjęcie łożyska' class='card-img-top'>
                        <div class='card-body'>
                            <h4  class='card-title'><b>  {$item['name']} </b></h5>
                            <div class='card-text'> 
                            <p> <b> {$item['title']} </b> <br/>
                            {$item['description']}</p>
                            </div>
                        </div>
                    </div>
                </div> ";
        
        


    
        $j++;
            /*
        echo 
        "<tr>
        <td>".$j."</td>
        <td>{$item['itemName']}</td>
        <td>{$item['manufacturerName']}</td>
        <td>{$item['amount']}</td>
        <td>{$item['price']} zł</td>
        </tr>";
        */
    }
    echo "</div>";
    echo  "</div>";
    ?>
    <!--
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img src="https://i.imgur.com/dMNzMwu.jpg"  alt="zdjęcie łożyska" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"> nazwa łożyska z bazy danych </h5>
                        <p class="card-text"> Opis łożyska z bazy danych</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <img src="https://i.imgur.com/dMNzMwu.jpg"  alt="zdjęcie łożyska" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"> nazwa łożyska z bazy danych </h5>
                        <p class="card-text"> Opis łożyska z bazy danych</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <img src="https://i.imgur.com/dMNzMwu.jpg"  alt="zdjęcie łożyska" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"> nazwa łożyska z bazy danych </h5>
                        <p class="card-text"> Opis łożyska z bazy danych</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
<?php include dirname(__FILE__,2) . "/footer.php"; ?>