<?php
include 'adm_nav.php';

?>

<h1 class="text-muted headers-padding">Lista użytkowników</h1>
    <hr class="divider mt-0">
    <div class="headers-padding" style="padding-right: 15px;">
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
            "<tr>
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
</script>

<?php
include 'adm_feet.php';

?>