<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DolarValue extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'valor'];
}
