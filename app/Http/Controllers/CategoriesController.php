<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){

        $categories = $this->categoryRepository->paginate(10);
        return view('admin.categories.index', array('categories'=>$categories));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $data = $request->all();
        $this->categoryRepository->create($data);

        return redirect()->route('admin.categories.index');
    }
}
