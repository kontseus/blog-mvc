<?php Core\View::render('\layout\header'); ?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $category->name ?></td>
            <td><img alt="category image" src="<?= IMG_URL . $category->image ?>" width="100"></td>
            <td>
                <form action="<?= url("home/{$category->id}/showSingleCategories") ?>">
                    <button class="btn btn-danger">More details</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php Core\View::render('\layout\footer'); ?>

