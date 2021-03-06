<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminOrderRequest;


class OrdersController extends Controller
{
    public function __construct(OrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    public function index(){

        $orders = $this->orderRepository->paginate(10);
        $list_status = [0=>"Pendente", 1=>"A caminho", 2=>"Entregue"];

        return view('admin.orders.index', compact('orders','list_status'));
    }

    public function create(UserRepository $userRepository){

        $list_status = [0=>"Pendente", 1=>"A caminho", 2=>"Entregue"];
        $deliveryman = $userRepository->getDeliverymen();

        return view('admin.orders.edit', compact('order','list_status','deliveryman'));
    }

    public function store(AdminOrderRequest $request){
        $data = $request->all();

        try{
            $this->orderRepository->create($data);

            request()->session()->flash('message','Pedido criado com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi criar seu pedido!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.orders.index');
    }

    public function edit($id, UserRepository $userRepository){

        $list_status = [0=>"Pendente", 1=>"A caminho", 2=>"Entregue"];
        $deliveryman = $userRepository->getDeliverymen();

        $order = $this->orderRepository->find($id);
        return view('admin.orders.edit', compact('order','list_status','deliveryman'));
    }

    public function update(AdminOrderRequest $request, $id){

        $data = $request->all();

        try{
            $this->orderRepository->update($data, $id);

            request()->session()->flash('message','Pedido atualizado com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi atualizar seu pedido!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.orders.index');
    }
}
