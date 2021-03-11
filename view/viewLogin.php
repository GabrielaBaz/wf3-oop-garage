<?php $title = 'Login into El Taller' ?>

<?php ob_start() ?>


<section class="container">

    <form action="index.php?action=login" method="post">
        <label for="name" class="form-label">User Name</label>
        <input type="text" class="form-control mb-3" id="userId" name="userId">

        <label for="brand" class="form-label">Password</label>
        <input type="password" class="form-control mb-3" id="userPassword" name="userPassword">

        <button class="btn btn-success mt-3" type="submit">Login</button>

    </form>

</section>

<?php
$content = ob_get_clean();

require('templateDisconnected.php');
?>