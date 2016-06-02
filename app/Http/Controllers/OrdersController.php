<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\OrderRepository;
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
        return view('admin.orders.index', array('orders'=>$orders));
    }

    public function create(){
        return view('admin.orders.create');
    }

    public function store(AdminOrderRequest $request){
        $data = $request->all();
        $this->orderRepository->create($data);

        $request->session()->flash('success', 'Categoria adicionada com sucesso');
        return redirect()->route('admin.orders.index');
    }

    public function edit($id){

        $order = $this->orderRepository->find($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(AdminOrderRequest $request, $id){

        $data = $request->all();
        $this->orderRepository->update($data, $id);

        $request->session()->flash('success', 'Categoria atualizada com sucesso');

        return redirect()->route('admin.orders.index');
    }
}
