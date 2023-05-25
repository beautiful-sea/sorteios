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
        'quantidade_minima_de_numeros',
        'porcentagem_comissao_vendas',
        'has_compra_minima',
        'contato_whatsapp',
        'is_compra_automatica',
        'compra_automatica_numeros',
        'has_top_five',
        'premio_top_five',
        'definir_ganhador_top_five',
        'nome_ganhador_top_five',
        'slug',
        'telefone_ganhador_top_five',
        'total_cotas_ganhador_top_five',
        'has_botao_whatsapp',
        'texto_botao_whatsapp',
        'tipo_botao_whatsapp',
        'contato_botao_whatsapp',
        'id_grupo_botao_whatsapp',
        'numero_sorteado',
        'is_principal'
    ];

    protected $appends = ['valor_por_numero_em_real','periodo_formatado','imagem_principal'];

    protected $with = ['imagens'];

    protected $dates = ['periodo'];
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

    //Retorna o pedido ganhador da rifa usando o numero sorteado da rifa
    public function getGanhadorAttribute(){
        $numero_sorteado = $this->numero_sorteado;
        $cota = $this->cotas->where('numero',$numero_sorteado)->first();
        if($cota){
            return $cota->pedido;
        }
        return null;
    }

    public function getStatusLabelAttribute(){
        $status = $this->status;
        switch ($status) {
            case 'EM_ANDAMENTO':
                return 'Em andamento';
                break;
            case 'FINALIZADO':
                return 'Finalizado';
                break;
            case 'EM_BREVE':
                return 'Em breve';
                break;
        }
    }

    public function getCreatedAtDiffAttribute(){
        $data = $this->created_at;
        $data->setLocale('pt_BR');
        return $data->diffForHumans();
    }

    public function setIsPrincipalAttribute($value){
        $this->attributes['is_principal'] = (boolean)$value;
    }

    public function getImagemPrincipalAttribute(){
        $imagens = $this->imagens;
        return $imagens->where('is_principal',true)->first()??$imagens->first();
    }

    public function getCompraAutomaticaNumerosAttribute($value){
        return json_decode($value);
    }

    public function setCompraAutomaticaNumerosAttribute($value){
        //Converte os valores para inteiro
        $value = array_map(function($item){
            return (int)$item;
        },$value);
        $this->attributes['compra_automatica_numeros'] = json_encode($value);
    }

    public function getNumeroSorteadoFormatadoAttribute(){
        return str_pad($this->numero_sorteado, 4, '0', STR_PAD_LEFT);
    }

    public function getValorEmRealAttribute(){
        $valor = number_format($this->valor_por_numero,2,',','.');
        return "R$ $valor";
    }

}
