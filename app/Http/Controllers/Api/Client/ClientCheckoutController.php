<?php

namespace CodeDelivery\Http\Controllers\Api\Client;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ClientCheckoutController extends Controller
{

    private $userRepository, $orderRepository, $productRepository, $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;

        $orders = $this->orderRepository->with('items')->scopeQuery(function($query) use($clientId){
            return $query->where('client_id','=',$clientId);
        })->paginate();

        return $orders;

    }


    public function store(Request $request)
    {
        $id = Authorizer::getResourceOwnerId();
        $data = $request->all();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->orderService->create($data);
        $order = $this->orderRepository->with('items')->find($order->id);
        return $order;


    }

    public function show($id)
    {
        $order = $this->orderRepository->with(['items.product','client','cupom'])->find($id);
//        $order->items->each(function($item){
//            $item->product;
//        });
        return $order;
    }

}
