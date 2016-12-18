<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumerStatus extends Model
{
    const TEST = 1;
    const PRIVILEGED = 2;
    const STOPPED = 3;
    const PAUSED = 4;
    const OTHER = 5;
}
