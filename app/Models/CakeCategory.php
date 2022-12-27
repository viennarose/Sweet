<?php

namespace App\Models;

use App\Models\CakeOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CakeCategory extends Model
{
    use HasFactory;
    protected $table = 'cake_categories';

    protected $fillable = [
        'category_name',
        'image',
        'status',
        'description',
    ];

    public function order(){
        return $this->belongsTo(CakeOrder::class, 'category_id', 'id');
    }

}
