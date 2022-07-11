<?php Core\View::render('layout/header', ['admin' => true]); ?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center text-uppercase">
            <div class="card mt-5">
                <h5 class="card-header">Create new Post</h5>
                <div class="card-body">
                    <form action="<?= url('admin/posts/store') ?>" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text"
                                   class="form-control"
                                   name="title" id="title"
                                   aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                   value="<?= !empty($data['title']) ? $data['title'] : '' ?>">
                            <?php if (!empty($data['errors']['title'])): ?>
                                <div class="alert alert-danger"><?= $data['errors']['title'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Content</span>
                            <textarea name="body" id="body" rows="3" class="form-control"><?= !empty($data['body']) ? $data['body'] : '' ?></textarea>
                            <?php if (!empty($data['errors']['body'])): ?>
                                <div class="alert alert-danger"><?= $data['errors']['body'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Category</span>
                            <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="category">
                                <?php foreach ($category as $key):?>
                                    <option value="<?= $key->id ?>"><?= $key->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file"
                                   class="form-control"
                                   name="image"
                                   id="image"
                                   aria-label="Recipient's username"
                                   aria-describedby="button-addon2"
                                   value="<?= !empty($data['image']) ? $data['image'] : '' ?>"
                            >
                            <?php if (!empty($data['errors']['image'])): ?>
                                <div class="alert alert-danger"><?= $data['errors']['image'] ?></div>
                            <?php endif; ?>
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Core\View::render('layout/footer'); ?>
