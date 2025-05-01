<?php

namespace App\Models\Infinite;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $connection = 'csvs';
    protected $table = 'restaurant_inspections';
}
