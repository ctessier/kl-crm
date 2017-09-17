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
        return Consumer::select(
            DB::raw("CONCAT(first_name,' ',last_name) AS name"),
            'id')
            ->where('user_id', $user->id)
            ->pluck('name', 'id')
            ->prepend(trans('placeholder.select-consumer'), '');
    }
}
