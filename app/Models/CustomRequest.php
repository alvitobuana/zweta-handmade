<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model
{
    use HasFactory;

    protected $fillable = ['code','customer_name','email','phone','model','color','notes','status','deadline','reference_image', 'estimated_price', 'manufacturing_fee', 'rejection_reason'];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'custom_request_material')
                    ->withPivot('qty')
                    ->withTimestamps();
    }
}
