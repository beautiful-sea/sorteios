<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RifasImagem extends Model
{
    use HasFactory;
    protected $fillable = ['path','is_principal'];
    protected $table = 'rifas_imagens';
    public function rifa(){
        return $this->belongsTo(Rifa::class);
    }
}
