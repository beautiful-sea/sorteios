<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

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
            case 'ENCERRADO':
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

    //Atualiza o status da cota na lista de cotas da rifa no cache
    public static function atualizarStatusDaCotaNoCache($rifa_id, $numero_cota, $status,$pedido_id = null){
        $cotas = Cache::get('cotas_rifa_'.$rifa_id);
        foreach ($cotas as $key => $cota) {
            if($cota['numero'] == $numero_cota){
                $cotas[$key]['pedido_id'] = $pedido_id;
                $cotas[$key]['status'] = $status;
                break;
            }
        }
        Cache::put('cotas_rifa_'.$rifa_id, $cotas);
    }

    /**
     * Cria a lista de cotas da rifa no cache
     * @param $cotas
     * @param $rifa_id
     * @return void
     */
    public static function criarCotasNoCache($cotas,$rifa_id){
        Cache::put('cotas_rifa_'.$rifa_id, $cotas);
    }

    /**
     * Retorna a lista de cotas da rifa no cache
     * @param $rifa_id
     * @return mixed
     */
    public static function getCotasNoCache($rifa_id){
        //Verifica se a lista de cotas da rifa está no cache
        if(!Cache::has('cotas_rifa_'.$rifa_id)){
            //Se não estiver, cria a lista de cotas da rifa no cache
            $cotas = Cota::where('rifa_id',$rifa_id)->get();
            $cotas = $cotas->map(function($cota){
                return [
                    'numero'=>$cota->numero,
                    'status'=>$cota->status,
                    'pedido_id'=>$cota->pedido_id
                ];
            });
            self::criarCotasNoCache($cotas,$rifa_id);
        }
        return Cache::get('cotas_rifa_'.$rifa_id);
    }

    /**
     * Deleta a lista de cotas da rifa no cache
     * @param $rifa_id
     * @return void
     */
    public static function deletarCotasNoCache($rifa_id){
        Cache::forget('cotas_rifa_'.$rifa_id);
    }

    /**
     * Cria
     * @param $cotas
     * @param $rifa_id
     * @return void
     */

}
