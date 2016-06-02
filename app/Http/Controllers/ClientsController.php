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
        $this->clientService->create($data);

        return redirect()->route('admin.clients.index');
    }

    public function edit($id){

        $client = $this->clientRepository->find($id);

        return view('admin.clients.edit', compact('client'));
    }

    public function update(AdminClientRequest $request, $id){

        $data = $request->all();
        $this->clientService->update($data, $id);

        return redirect()->route('admin.clients.index');
    }

    public function destroy($id){

        try{
            $this->clientRepository->find($id)->delete();
            request()->session()->flash('success','Cliente removido com sucesso!');
        }
        catch (\Mockery\CountValidator\Exception $e){
            request()->session()->flash('error','Não foi possível remover o cliente!');
        }

        return redirect()->route('admin.clients.index');

    }
}
