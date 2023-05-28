<?php

namespace App\Jobs;

use App\Models\Cota;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class CadastrarCotasEmLoteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var mixed
     */
    private $cotas;
    /**
     * @var mixed
     */
    private $rifa_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($quantidade_de_numeros, $rifa_id)
    {
        //Cadastrar cotas da rifa
        $cotas = [];
        for ($i = 1; $i <= $quantidade_de_numeros; $i++) {
            $cotas[] = [
                'rifa_id' => $rifa_id,
                'numero' => $i,
                'status' => 'DISPONIVEL',
            ];
        }
        $this->cotas = $cotas;
        $this->rifa_id = $rifa_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Separar as cotas de 100 em 100 mil
        $cotas = array_chunk($this->cotas, 100000);

        foreach ($cotas as $cota) {
            Cota::insert($cota);
        }
        //Cria o numero formatado para cada cota. É adicionado 0 a esquerda do numero da cota de acordo com o tamanho de caracteres do maior numero da rifa
        $maior_numero = collect($this->cotas)->max('numero');
        $tamanho_maior_numero = strlen($maior_numero);
        $cotas = collect($cotas)->map(function ($cotas) use ($tamanho_maior_numero) {
            return collect($cotas)->map(function ($cota) use ($tamanho_maior_numero) {
                $cota['numero_formatado'] = str_pad($cota['numero'], $tamanho_maior_numero, '0', STR_PAD_LEFT);
                return $cota;
            });
        });

        Cache::put('cotas_rifa_'.$this->rifa_id,$this->cotas);

    }
}
