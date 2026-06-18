<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model
{
    use HasFactory;

    protected $fillable = ['code','customer_name','email','phone','model','color','notes','status','deadline','reference_image'];

    protected $casts = [
        'deadline' => 'date',
    ];
}
