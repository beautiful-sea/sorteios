<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cota extends Model
{
    use HasFactory;

    protected $fillable = ['numero','status'];

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }
}
