<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(CategoryRepository $categoryRepository){

        $categories = $categoryRepository->paginate(5);
        return view('admin.categories.index', array('categories'=>$categories));
    }

    public function create(){
        return view('admin.categories.create');
    }
}
