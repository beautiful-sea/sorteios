<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Cota extends Model
{
    use HasFactory;

    protected $fillable = ['numero','status','pedido_id'];

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }


}
