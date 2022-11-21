<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rifa extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_LABEL = [
        0   =>  'EM ANDAMENTO',
        1   =>  'ENCERRADO'
    ];

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

    protected $appends = ['valor_por_numero_em_real','periodo_formatado'];

    public function imagens()
    {
        return $this->hasMany(RifasImagem::class);
    }

    public function getPrimeiraImagemAttribute(){
        return (count($this->imagens))?$this->imagens[0]:(object)['path'=>null];
    }

    public function getValorPorNumeroEmRealAttribute(){
        $valor = number_format($this->valor_por_numero,2,',','.');
        return "R$ $valor";
    }

    public function getPeriodoFormatadoAttribute(){
        return Carbon::parse($this->periodo)->format('d/m/Y');
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }

    public function cotas(){
        return $this->hasMany(Cota::class);
    }

    public function getStatusLabelAttribute(){
        return self::STATUS_LABEL[$this->status]??'ENCERRADO';
    }

    public function getCreatedAtDiffAttribute(){
        $data = $this->created_at;
        $data->setLocale('pt_BR');
        return $data->diffForHumans();
    }

}
