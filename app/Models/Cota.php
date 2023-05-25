<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cota extends Model
{
    use HasFactory;

    protected $fillable = ['numero','status','pedido_id'];
    protected $appends = ['numero_formatado'];

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }

    //Retorna o numero no formato de 4 digitos. Ex: 0001
    public function getNumeroFormatadoAttribute(){
        return str_pad($this->numero, 4, '0', STR_PAD_LEFT);
    }
}
