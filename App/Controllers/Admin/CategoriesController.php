<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Services\FileUploaderService;
use App\Validators\CategoryValidator;
use Core\View;

class CategoriesController extends BaseController
{
    public function index()
    {
        $categories = Category::all();

        View::render('admin/categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        View::render('admin/categories/create');
    }

    public function store()
    {
        $imagePath = FileUploaderService::upload($_FILES['image'], CATEGORIES_IMG_DIR);
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $validator = new CategoryValidator();
        if($validator->checkName($fields['name']) && $validator->checkDescription($fields['description']) && $validator->checkImage($_FILES['image']['name'])){
            Category::create([
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'image' => $imagePath
            ]);
            redirect('admin/categories');
        }
        $data['name'] = $fields['name'];
        $data['description'] = $fields['description'];
        $data['errors'] = $validator->errors;

        View::render('\admin\categories\create', ['data' => $data]);
    }

    public function edit(int $id)
    {
        $category = Category::find($id);

        View::render('admin/categories/edit', ['category' => $category]);
    }

    public function update(int $id)
    {
        $validator = new CategoryValidator();
        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        if ($validator->checkName($fields['name']) && $validator->checkDescription($fields['description'])) {
            $category = Category::find($id);
            $categoryData = $_POST;
            if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0) {
                FileUploaderService::remove(CATEGORIES_IMG_DIR . '/' . $category->image);
                $imagePath = FileUploaderService::upload($_FILES['image'], CATEGORIES_IMG_DIR);
                $categoryData['image'] = $imagePath;
            }
            $category->update($categoryData);
            redirect('admin/categories');
        }
        $category = Category::find($id);
        $data['name'] = $fields['name'];
        $data['description'] = $fields['description'];
        $data['errors'] = $validator->errors;

        View::render('admin/categories/edit', ['data' => $data, 'category' => $category]);
    }

    public function destroy(int $id)
    {
        Category::delete($id);
        redirect('admin/categories');
    }
}