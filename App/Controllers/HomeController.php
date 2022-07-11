<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;
use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public function index()
    {
        View::render('home/index');
    }
    public function showCategories()
    {
        $categories = Category::all();

        View::render('home/allCategories', ['categories' => $categories]);
    }
    public function showSingleCategories($id)
    {
        $categories = Category::find($id);

        View::render('home/singleCategories', ['categories' => $categories]);
    }
    public function showPost()
    {
        $categories = Category::all();
        $posts = Post::all();

        View::render('home/allPosts', ['posts' => $posts, 'categories' => $categories]);
    }
    public function showSinglePost($id)
    {
        $categories = Category::all();
        $posts = Post::find($id);

        View::render('home/singlePost', ['posts' => $posts, 'categories' => $categories]);
    }
}
