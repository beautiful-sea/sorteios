<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rifa extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'resumo',
        'premio',
        'status',
        'mostrar_data_sorteio',
        'periodo',
        'valor_por_numero',
        'quantidade_de_numeros',
        'quantidade_maxima_de_numeros',
        'porcentagem_comissao_vendas',
        'has_compra_minima',
        'contato_whatsapp',
        'is_compra_automatica',
        'has_top_five',
        'premio_top_five',
        'definir_ganhador_top_five',
        'nome_ganhador_top_five',
        'telefone_ganhador_top_five',
        'total_cotas_ganhador_top_five',
        'has_botao_whatsapp',
        'texto_botao_whatsapp',
        'tipo_botao_whatsapp',
        'contato_botao_whatsapp',
        'id_grupo_botao_whatsapp',
        'numero_sorteado'];

    public function imagens()
    {
        return $this->hasMany(RifasImagem::class);
    }

}
