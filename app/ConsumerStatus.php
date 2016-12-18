<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumerStatus extends Model
{
    const TEST_PROGRAM = 1;
    const PRIVILEGED_CUSTOMER = 2;
    const STOPPED = 3;
    const IN_BREAK = 4;
    const OTHER = 5;
}
