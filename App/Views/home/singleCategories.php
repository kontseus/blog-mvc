<?php Core\View::render('\layout\header'); ?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"><?= $categories->id ?></th>
            <td><?= $categories->name ?></td>
            <td><?= $categories->description ?></td>
            <td><img alt="category image" src="<?= IMG_URL . $categories->image ?>" width="300"></td>
        </tr>
    </tbody>
</table>

<?php Core\View::render('\layout\footer'); ?>



