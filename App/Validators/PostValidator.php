<?php

namespace App\Validators;

class PostValidator
{
    public array $errors = [];

    public function checkImage(string $image)
    {
        if (empty($image)) {
            $this->errors['image'] = 'Image is empty';

            return false;
        }

        return true;
    }

    public function checkTitle(string $fields): bool
    {
        if (!empty($fields) && strlen($fields) > 4) {

            return true;
        }
        $this->errors['title'] = 'Title is empty or short';

        return false;
    }

    public function checkBody(string $fields): bool
    {
        if (!empty($fields)) {

            return true;
        }
        $this->errors['body'] = 'Content is empty';

        return false;
    }

}