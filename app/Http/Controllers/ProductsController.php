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
    /**
     * The application's global HTTP middleware stack.
     *
     * @var \CodeDelivery\Repositories\ProductRepository;
     */
    private $productRepository;

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

        try{
            $this->productRepository->create($data);
            request()->session()->flash('message','Produto inserido com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível inserir o produto!');
            request()->session()->flash('type','danger');
        }



        return redirect()->route('admin.products.index');
    }

    public function edit($id){

        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->listsCategory();

        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(AdminProductRequest $request, $id){

        $data = $request->all();

        try{
            $this->productRepository->update($data, $id);
            request()->session()->flash('message','Produto atualizado com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível atualizar o produto!');
            request()->session()->flash('type','danger');
        }


        return redirect()->route('admin.products.index');
    }

    public function destroy($id){

        try{
            $product = $this->productRepository->find($id);
            $product->delete();

            request()->session()->flash('message','Produto removido com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível remover o produto!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.products.index');

    }
}
