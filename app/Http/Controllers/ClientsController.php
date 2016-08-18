<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Services\ClientService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminClientRequest;
use PhpSpec\Exception\Exception;


class ClientsController extends Controller
{
    public function __construct(ClientRepository $clientRepository, ClientService $clientService){
        $this->clientRepository = $clientRepository;
        $this->clientService = $clientService;
    }

    public function index(){

        $clients = $this->clientRepository->paginate(10);
        return view('admin.clients.index', array('clients'=>$clients));
    }

    public function create(){

        return view('admin.clients.create', compact('client'));
    }

    public function store(AdminClientRequest $request){
        $data = $request->all();

        try{
            $this->clientService->create($data);
            request()->session()->flash('message','Cliente inserido com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível criar o cliente!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.clients.index');
    }

    public function edit($id){

        $client = $this->clientRepository->find($id);

        return view('admin.clients.edit', compact('client'));
    }

    public function update(AdminClientRequest $request, $id){

        $data = $request->all();


        try{
            $this->clientService->update($data, $id);
            request()->session()->flash('message','Cliente atualizado com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível atualizar o cliente!');
            request()->session()->flash('type','danger');
        }

        return redirect()->route('admin.clients.index');
    }

    public function destroy($id){

        try{
            $this->clientRepository->find($id)->delete();
            request()->session()->flash('message','Cliente removido com sucesso!');
            request()->session()->flash('type','success');
        }
        catch (\Exception $e){
            request()->session()->flash('message','Não foi possível remover o cliente!');
            request()->session()->flash('type','danger');
        }


        return redirect()->route('admin.clients.index');

    }
}
