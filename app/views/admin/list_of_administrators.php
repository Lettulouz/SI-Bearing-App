<?php
include 'adm_nav.php';

?>

<h1 class="text-muted headers-padding">Lista administratorów</h1>
    <hr class="divider ">
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
        </tr>
        </thead>
        <tbody>
        <?php 
        $users = $data['usersArray'];
        foreach($users as $i => $user) 
        {
            echo 
            "<tr>
            <td>".$i+'1'."</td>
            <td>{$user['login']}</td>
            <td>{$user['name']}</td>
            <td>{$user['lastName']}</td>
            <td>{$user['email']}</td>
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
    document.getElementById('ad_list').setAttribute( 'style', 'color:white !important' );
</script>

<?php
include 'adm_feet.php';

?>