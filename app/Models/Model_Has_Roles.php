<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model_Has_Roles extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
