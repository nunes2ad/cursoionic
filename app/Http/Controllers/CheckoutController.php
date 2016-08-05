<?php

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;



class CheckoutController extends Controller
{
    /**
     * @var orderRepository
     */
    private $orderRepository;

    /**
     * @var userRepository
     */
    private $userRepository;

    /**
     * @var productRepository
     */
    private $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function create()
    {
        $products = $this->productRepository->listsProduct();
        return view('customer.order.create', compact('products'));

    }

}
