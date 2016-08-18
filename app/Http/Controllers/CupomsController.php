<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CupomRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminCupomRequest;


class CupomsController extends Controller
{
    public function __construct(CupomRepository $cupomRepository){
        $this->cupomRepository = $cupomRepository;
    }

    public function index(){

        $cupoms = $this->cupomRepository->paginate(10);
        return view('admin.cupoms.index', array('cupoms'=>$cupoms));
    }

    public function create(){
        return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request){
        $data = $request->all();

        try{
            $this->cupomRepository->create($data);
            request()->session()->flash('message','Cupom inserido com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível criar o cupom!');
            request()->session()->flash('type','danger');
        }
        return redirect()->route('admin.cupoms.index');
    }

    public function edit($id){

        $cupom = $this->cupomRepository->find($id);
        return view('admin.cupoms.edit', compact('cupom'));
    }

    public function update(AdminCupomRequest $request, $id){

        $data = $request->all();

        try{
            $this->cupomRepository->update($data, $id);
            request()->session()->flash('message','Cupom atualizado com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível atualizar o cupom!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.cupoms.index');
    }

    public function destroy($id){

        try{
            $product = $this->cupomRepository->find($id);
            $product->delete();

            request()->session()->flash('message','Cupom removido com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível remover o cupom!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.products.index');

    }
}
