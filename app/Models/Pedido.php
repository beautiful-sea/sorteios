<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rifa(){
        return $this->belongsTo(Rifa::class);
    }
}
