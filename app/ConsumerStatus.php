<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumerStatus extends Model
{
    const TEST_PROGRAM = 1;
    const MAIN_MEMBER = 2;
    const DEPENDANT_MEMBER = 3;
    const STOPPED = 4;
}
