<?php

namespace app\controllers;

use app\models\Category;
use core\controllers\Controller;
use core\Request;
use core\Response;

class CategoryController extends Controller
{
    public function category(Request $request, string $slug): string
    {   
        $category = new Category;
        $query = Category::select('*')
        ->from($category->tableName())
        ->where('slug = :slug');
        $result = $category->dbExecute($query, ['slug' => $slug]);
        $categories = $result->fetchAll(\PDO::FETCH_ASSOC);
        if(empty($categories)){
           
        }
        return $this->render('Home/home');
    }
}