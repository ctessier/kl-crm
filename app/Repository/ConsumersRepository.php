<?php

namespace App\Repository;

use App\Consumer;
use App\User;
use Illuminate\Support\Facades\DB;

class ConsumersRepository
{
    /**
     * Return the drop down list of user's consumers with their full name.
     *
     * @param User $user
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUsersConsumersList(User $user)
    {
        return Consumer::where('user_id', $user->id)
            ->get()
            ->pluck('full_name', 'id')
            ->prepend(trans('placeholder.select-consumer'), '');
    }
}
