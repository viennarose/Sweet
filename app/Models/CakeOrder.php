<?php

namespace App\Models;

use App\Models\User;
use App\Models\CakeCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CakeOrder extends Model
{
    use HasFactory;
    protected $table = 'cake_orders';

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(CakeCategory::class, 'category_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeSearch($query, $terms){
        collect(explode(" " , $terms))->filter()->each(function($term) use($query){
            $term = '%'. $term . '%';

            $query->where('theme', 'like', $term)
                ->orWhere('layers', 'like', $term);
        });
    }

}
