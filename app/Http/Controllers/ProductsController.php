<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminProductRequest;
use PhpSpec\Exception\Exception;


class ProductsController extends Controller
{
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository){
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){

        $products = $this->productRepository->paginate(10);
        return view('admin.products.index', array('products'=>$products));
    }

    public function create(){
        $categories = $this->categoryRepository->listsCategory();
        return view('admin.products.create', compact('product','categories'));
    }

    public function store(AdminProductRequest $request){
        $data = $request->all();
        $this->productRepository->create($data);

        return redirect()->route('admin.products.index');
    }

    public function edit($id){

        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->listsCategory();

        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(AdminProductRequest $request, $id){

        $data = $request->all();
        $this->productRepository->update($data, $id);

        return redirect()->route('admin.products.index');
    }

    public function destroy($id){

        try{
            $this->productRepository->find($id)->delete();
            request()->session()->flash('success','Produto removido com sucesso!');
        }
        catch (\Mockery\CountValidator\Exception $e){
            request()->session()->flash('error','Não foi possível remover o produto!');
        }

        return redirect()->route('admin.products.index');

    }
}
