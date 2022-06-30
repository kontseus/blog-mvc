<?php

namespace App\Controllers;

class PostsController
{

    public function show(int $id)
    {
        dd(__METHOD__, $id);
    }

}