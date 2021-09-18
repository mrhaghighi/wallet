<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * Guarded fields
     *
     * @var array
     */
    protected $guarded = [];
}
