<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class DeliverymanCheckoutController extends Controller
{

    private $userRepository, $orderRepository, $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $orders = $this->orderRepository->with('items')->scopeQuery(function($query) use($id){
            return $query->where('user_deliveryman_id','=',$id);
        })->paginate();

        return $orders;

    }

    public function show($id)
    {
        $deliveryman = Authorizer::getResourceOwnerId();
        return $this->orderRepository->getByIdAndDeliveryman($id,$deliveryman);
    }

    public function updateStatus(Request $request, $id){
        $deliveryman = Authorizer::getResourceOwnerId();
        $order = $this->orderService->updateStatus($id, $deliveryman, $request->get('status'));

        if($order){
            return $order;
        }

        abort(400,"Order not found");
    }

}
