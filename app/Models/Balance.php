<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'balances';

    /**
     * Guarded fields
     *
     * @var array
     */
    protected $guarded = [];
}
