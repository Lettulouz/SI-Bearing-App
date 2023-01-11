<?php
include 'adm_nav.php';

?>

<h1 class="text-muted headers-padding">Lista użytkowników</h1>
    <hr class="divider mt-0">
    <div class="headers-padding" style="padding-right: 15px;">

    <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group">
                <input type="text" class="form-control" id="searchBox" placeholder="Wyszukaj użytkownika">
                <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                    <i class="bi bi-x"></i>
                </button>
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </div>

        <?php if($data['usersArray']) {?>
        <table class="table text-center">
        <thead>
        <tr>
        <th>Lp.</th>
        <th>Login</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $users = $data['usersArray'];
        $rmPath = $data['rmpath'];
        $editPath = $data['editpath'];
        foreach($users as $i => $user) 
        {
            echo 
            "<tr class='tabrow'>
            <td>".$i+'1'."</td>
            <td>{$user['login']}</td>
            <td>{$user['name']}</td>
            <td>{$user['lastName']}</td>
            <td>{$user['email']}</td>
            <td class='px-0 mx-0'>
            <a href='".$editPath."/".$user['id']."' type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm mx-1 tabBtn'>
            <i class='bi bi-gear-fill'></i>
            </a>
            <a href='".$rmPath."/".$user['id']."' type='button' data-toggle='collapse' class='btn btn-danger d-inline btn-sm mx-1 tabBtn'>
            <i class='bi bi-trash-fill'></i>
            </a>
            </td>
            </tr>";
        }
        ?>
        </tbody>
        </table>
        <?php } else {echo "Brak dodanych użytkowników.";}?>
    </div>

<script>
    document.getElementById('users_collapse').classList.add('show');
    document.getElementById('users_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('users_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('user_lists').setAttribute( 'style', 'color:white !important' );

    $(document).ready(function(){
  $("#searchBox").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".tabrow").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


$('.clrBtn').click(function(){
        $('#searchBox').val('');
        $(".tabrow").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf('') > -1)
    });
    })    

</script>

<?php
include 'adm_feet.php';

?>