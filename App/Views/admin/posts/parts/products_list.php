<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Category</th>
        <th scope="col">Image</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($posts as $post): ?>
        <tr>
            <th scope="row"><?= $post->id ?></th>
            <td><?= $post->title ?></td>
            <td><?= $post->body ?></td>

            <?php foreach ($categories as $category): ?>
                <?php if ($post->category_id == $category->id): ?>
                    <td><a href="<?= url("home/{$post->category_id}/showSingleCategories")?>"><?= $category->name ?></a></td>
                <?php endif; ?>
            <?php endforeach; ?>
            <td><img alt="post image" src="<?= IMG_URL . $post->image ?>" width="100"></td>
            <td>
                <a href="<?= url("admin/posts/{$post->id}/edit") ?>" class="btn btn-info">Edit</a>
                <form action="<?= url("admin/posts/{$post->id}/destroy") ?>" method="post">
                    <button class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

