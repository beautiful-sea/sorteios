<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['rifa','cotas'];
    protected $appends = ['created_at_diff','created_at_data_hora','valor_da_compra_em_real','telefone_cliente_formatado'];

    public function rifa(){
        return $this->belongsTo(Rifa::class);
    }

    public function cotas(){
        return $this->hasMany(Cota::class);
    }


    public function setTelefoneClienteAttribute($value){
        $this->attributes['telefone_cliente'] = preg_replace('/[^0-9]/', '', $value);//remove tudo que não for numero
    }

    public function getCreatedAtDiffAttribute(){
        if(!$this->created_at){
            return null;
        }
        //Em pt-br
        return $this->created_at->locale('pt-br')->diffForHumans();
    }

    public function getCreatedAtDataHoraAttribute(){
        if(!$this->created_at){
            return null;
        }
        //Em pt-br
        return $this->created_at->locale('pt-br')->format('d/m/Y H:i:s');
    }

    public function getValorDaCompraEmRealAttribute(){
        if(!$this->valor_da_compra){
            return null;
        }
        //Em pt-br
        return 'R$ '.number_format($this->valor_da_compra, 2, ',', '.');
    }

    public function getTelefoneClienteFormatadoAttribute(){
        if(!$this->telefone_cliente){
            return null;
        }
        //Em pt-br
        return '('.substr($this->telefone_cliente,0,2).') '.substr($this->telefone_cliente,2,5).'-'.substr($this->telefone_cliente,7,4);
    }
}
