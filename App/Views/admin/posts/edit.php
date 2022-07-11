<?php Core\View::render('layout/header', ['admin' => true]); ?>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="card w-75 mt-5">
                    <h5 class="card-header">Update post id</h5>
                    <div class="card-body">
                        <form action="<?= url("/admin/posts/{$post->id}/update") ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Title</label>
                                <input type="text" name="title" value="<?= $post->title ?>" class="form-control" id="title" placeholder="Post title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Post text</label>
                                <textarea name="body" id="description" cols="30" rows="10" class="form-control" placeholder="Description"><?= $post->body ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="image" />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Created  at</label>
                                <input type="text" name="created_at" value="<?= $post->created_at ?>" class="form-control" id="title" placeholder="Post title">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Updated at</label>
                                <input type="text" name="updated_at" value="<?= $post->updated_at ?>" class="form-control" id="title" placeholder="Post title">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
Core\View::render('layout/footer');