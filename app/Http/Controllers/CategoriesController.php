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

        $request->session()->flash('message', 'Categoria adicionada com sucesso');
        request()->session()->flash('type','success');
        return redirect()->route('admin.categories.index');
    }

    public function edit($id){

        $category = $this->categoryRepository->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $request, $id){

        $data = $request->all();
        $this->categoryRepository->update($data, $id);

        $request->session()->flash('message', 'Categoria atualizada com sucesso');
        request()->session()->flash('type','success');

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id){

        try{
            $category = $this->categoryRepository->find($id);
            $category->delete();

            request()->session()->flash('message','Categoria removida com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível remover o categoria!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.categories.index');

    }
}
