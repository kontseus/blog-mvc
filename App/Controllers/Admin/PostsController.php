<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Services\FileUploaderService;
use App\Validators\PostValidator;
use Core\View;

class PostsController extends BaseController
{
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        View::render('admin/posts/index', ['posts' => $posts, 'categories'=> $categories]);
    }

    public function create()
    {
        $category = Category::all();

        View::render('admin/posts/create', ['category' => $category]);
    }

    public function store()
    {
        $category = Category::all();
        $imagePath = FileUploaderService::upload($_FILES['image'], POSTS_IMG_DIR);
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $validator = new PostValidator();
        if ($validator->checkTitle($fields['title'])
            && $validator->checkBody($fields['body'])
            && $validator->checkImage($_FILES['image']['name'])
        ) {
            Post::create([
                'title'             => $fields['title'],
                'body'              => $fields['body'],
                'category_id'       => $fields['category'],
                'user_id'           => $_SESSION['user_data']['id'],
                'image'             => $imagePath
            ]);
            redirect('admin/posts');
        }
        $data['title']      = $fields['title'];
        $data['body']       = $fields['body'];
        $data['errors']     = $validator->errors;

        View::render('\admin\posts\create', ['data' => $data, 'category' => $category]);
    }

    public function show(int $id)
    {
        $posts = Post::find($id);

        View::render('admin/posts/index', ['posts' => $posts]);
    }

    public function edit(int $id)
    {
        $post = Post::find($id);

        View::render('admin/posts/edit', ['post' => $post]);
    }

    public function update(int $id)
    {
        $category = Category::all();
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $validator = new PostValidator();
        $posts = Post::find($id);

        if($validator->checkTitle($fields['title']) && $validator->checkBody($fields['body'])){
            $postData = $_POST;
            if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0){
                FileUploaderService::remove(POSTS_IMG_DIR . '/' . $posts->image);
                $imagePath = FileUploaderService::upload($_FILES['image'], POSTS_IMG_DIR);
                $postData['image'] = $imagePath;
            }
            $posts->update($postData);

            redirect('admin/posts');
        }
        $data['title']  = $fields['title'];
        $data['body']   = $fields['body'];
        $data['errors'] = $validator->errors;

        View::render('admin/posts/edit', ['data' => $data, 'category' => $category, 'posts' => $posts]);
    }

    public function destroy(int $id)
    {
        Post::delete($id);
        redirect('admin/posts');
    }
}
