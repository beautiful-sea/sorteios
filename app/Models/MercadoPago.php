<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MercadoPago extends Model
{
    use HasFactory;

    /**
     * @var MercadoPago\Preference
     */
    public $preference;
    /**
     * @var mixed
     */
    public $access_token;
    /**
     * @var mixed
     */
    public $public_key;

    public function __construct()
    {
        // Adicione as credenciais
        $this->access_token = env('MERCADO_PAGO_ACCESS_TOKEN');
        $this->public_key = env('MERCADO_PAGO_PUBLIC_KEY');
        \MercadoPago\SDK::setAccessToken($this->access_token);
        // Cria um objeto de preferência
        $this->preference = new \MercadoPago\Preference();
    }
}
