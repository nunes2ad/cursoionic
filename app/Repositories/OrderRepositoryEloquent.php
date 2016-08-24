<?php

namespace CodeDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Order;
use CodeDelivery\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getByIdAndDeliveryman($id, $deliveryman){

        $result = $this->with(['items.product','client','cupom'])->findWhere([
           'id' => $id,
            'user_deliveryman_id' => $deliveryman
        ]);

        if($result instanceof Collection){
            $result = $result->first();
        }

        return $result;

    }
}