<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Generator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class Paggue
{
    use HasFactory;

    /**
     * @var mixed
     */
    private $client_key;
    /**
     * @var mixed
     */
    private $client_secret;
    /**
     * @var mixed
     */
    private $access_token;
    /**
     * @var mixed
     */
    private $base_url;

    private $company_id = null;


    public function __construct(){
        // Cria as propriedades com os dados de acesso ao paggue salvos no .env
        $this->client_key = env('PAGGUE_CLIENT_KEY');
        $this->client_secret = env('PAGGUE_CLIENT_SECRET');
        $this->base_url = env('PAGGUE_BASE_URL');
        return $this->login();
    }

    //Realiza a requisição no paggue
    public function curl($url, $data, $method = 'GET',$withToken = true): string
    {
        //Altera toda a funcao para usar o HTTP do Laravel
        $request = Http::withHeaders([
            'X-Company-ID' => $this->company_id,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);

        if($withToken){
            $request->withToken($this->access_token);
        }

        if($method == 'GET'){
            $response = $request->get($url, $data);
        }else{
            $response = $request->post($url, $data);
        }
        return $response->body();
    }

    //Realiza o login no paggue e retorna o token
    public function login(){
        $url = $this->base_url . '/auth/login';
        $data = [
            'client_key' => $this->client_key,
            'client_secret' => $this->client_secret,
        ];
        $request = $this->curl($url, $data, 'POST',false);
        $response = json_decode($request);
        try{
            //$this->>company_id está em $response->user->companies[0]->id, caso não tenha, é null
            //se existir $response->user->companies[0]->id, então $this->company_id = $response->user->companies[0]->id

            $this->company_id = $response->user->companies[0]->id;

            $this->access_token = $response->access_token;
            return $response->access_token;
        }catch(\Exception $e){
            Log::error(json_encode($response));
            return false;
        }

    }

    /**
     * This resource is used to create billing orders to charge your customers with Pix Web. By default, it blocks transfers to the same external_id or amount with float or string values.
     * Example Request:
     * curl --location 'https://ms.paggue.io/payments/api/billing_order' \
    --header 'X-Company-ID;' \
    --header 'Signature;' \
    --data '{
    "payer_name": "Nome do cliente",
    "amount": 100,
    "external_id": "meu_id_12",
    "description": "Compra do produto x"
    }'
     * Example response:
     * {
    "hash": "0c07f9b7-66f1-4bc1-a4fa-c149be78e380",
    "payer_name": "Nome do cliente",
    "amount": 100,
    "description": "Compra do produto x",
    "payment": "00020126890014BR.GOV.BCB.PIX0136bd53a471-0858-4279-bdb2-777c4e3f8b4d0227Nome Fantasia Empresa Teste52040000530398654041.005802BR5925Paggue Intermediacao De S6009Sao Paulo62180514BILLINGORDER3463040766",
    "external_id": "meu_id_12",
    "status": "pending",
    "paid_at": null,
    "created_at": "2022-04-13 02:04"
    }
     */
    public function billingOrder($payer_name, $amount, $external_id, $description): string
    {
        $url = $this->base_url . '/billing_order';
        $data = [
            'payer_name' => $payer_name,
            'amount' => $amount,
            'external_id' => $external_id. '_SORTEIO_' . time(),
            'description' => $description,
        ];
        return $this->curl($url, $data, 'POST');
    }

    public function getBillingOrders($hash): string
    {
        $url = $this->base_url . '/billing_order';
        $data = [
            'hash' => $hash,
            'order' => 'created_at,desc',
            'page' => 1,
        ];
        Log::info('getBillingOrders: ' . $url . ' - ' . json_encode($data));
        return $this->curl($url, $data, 'GET');
    }

    //Gerar o QrCodePix a partir da String recebida, salva a imagem e retorna o caminho
    public function gerarQrCodePix($chavePix,$idPagamento): string
    {
        try{
            //verifica se a pasta qr_code existe, se não, cria
            if(!file_exists(storage_path('app/public/qr_code'))){
                mkdir(storage_path('app/public/qr_code'));
            }
            $qrCode = new Generator;
            //Nome para a imagem é o id do pagamento + timestamp para evitar duplicidade
            $pngName = $idPagamento . '_' . time() . '.png';
            $qrCode->size(300)
                ->format('png')
                ->generate($chavePix, storage_path('app/public/qr_code/' . $pngName));

            return $pngName;
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

}
