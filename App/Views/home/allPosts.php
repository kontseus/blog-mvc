<?php Core\View::render('\layout\header'); ?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Image</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $post->title ?></td>

            <?php foreach ($categories as $category): ?>
                <?php if ($post->category_id == $category->id ): ?>
                    <td><a href="<?= url("home/{$post->category_id}/showSingleCategories")?>"><?= $category->name ?></a></td>
                <?php endif; ?>
            <?php endforeach; ?>
            <td><img alt="post image" src="<?= IMG_URL . $post->image ?>" width="100"></td>
            <td>
                <form action="<?= url("home/{$post->id}/showSinglePost") ?>">
                    <button class="btn btn-danger">More details</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php Core\View::render('\layout\footer'); ?>


