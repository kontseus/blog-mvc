<?php Core\View::render('layout/header'); ?>
    <h3>This is a Home page
        <?php if (array_key_exists('user_data',$_SESSION)) : ?>
            <?= 'for logged in User with id ' . $_SESSION['user_data']['id'] ?>
        <?php else : ?>
            for logged out User
        <?php endif ?>
    </h3>
<?php Core\View::render('layout/footer'); ?>
