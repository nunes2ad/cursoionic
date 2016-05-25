<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminCategoryRequest;


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

    public function store(AdminCategoryRequest $request){
        $data = $request->all();
        $this->categoryRepository->create($data);

        $request->session()->flash('success', 'Categoria adicionada com sucesso');
        return redirect()->route('admin.categories.index');
    }

    public function edit($id){

        $category = $this->categoryRepository->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $request, $id){

        $data = $request->all();
        $this->categoryRepository->update($data, $id);

        $request->session()->flash('success', 'Categoria atualizada com sucesso');

        return redirect()->route('admin.categories.index');
    }
}
