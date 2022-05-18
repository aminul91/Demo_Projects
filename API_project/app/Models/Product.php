<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{  

    protected $fillable = [
        'product_name',
        'product_price',
        'product_category',
    ];
    protected $hidden = [
		'created_at','updated_at'
	];
    
}
