<?php Core\View::render('\layout\header'); ?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Category</th>
        <th scope="col">Image</th>
    </tr>
    </thead>
    <tbody>

        <tr>
            <td><?= $posts->id ?></td>
            <td><?= $posts->title ?></td>
            <td><?= $posts->body ?></td>
            <?php foreach ($categories as $category): ?>
                <?php if ($posts->category_id == $category->id ): ?>
                    <td><a href="<?= url("home/{$posts->category_id}/showSingleCategories")?>"><?= $category->name ?></a></td>
                <?php endif; ?>
            <?php endforeach; ?>
            <td><img alt="post image" src="<?= IMG_URL . $posts->image ?>" width="100"></td>
        </tr>
    </tbody>
</table>

<?php Core\View::render('\layout\footer'); ?>


