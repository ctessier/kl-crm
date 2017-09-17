<?php

namespace App\Repository;

use App\ConsumerOrder;
use App\User;

class ConsumerOrdersRepository
{
    /**
     * Return the collection of consumer orders with a consumer of a given user.
     *
     * @param User $user
     *
     * @return ConsumerOrder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUsersConsumerOrders(User $user)
    {
        return ConsumerOrder::where('user_id', $user->id)
            ->withConsumer()
            ->orderBy('month', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
