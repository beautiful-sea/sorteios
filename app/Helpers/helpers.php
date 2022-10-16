<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Client;
use App\Models\BrandsRequest;
use App\Models\EntityProduct;
use App\Models\Product;
use Config;
use Illuminate\Support\Str;

class Helper
{
    const MESSAGES_PASSWORD_RESET = [
        'passwords.sent' => 'Link de redefinição de senha enviado para o email.',
        'passwords.reset' => 'Senha redefinida com sucesso.',
        'passwords.user' => 'Email não cadastrado.',
        'passwords.token' => 'O link de redefinição não é válido ou expirou.',
        'passwords.throttled' => 'Já existe uma solicitação de redefinição de senha para o email informado.',
    ];

    public static function applClasses()
    {
        // Demo
        $fullURL = request()->fullurl();
        $data = [];

        if (App()->environment() === 'production') {
            for ($i = 1; $i < 7; $i++) {
                $contains = Str::contains($fullURL, 'demo-' . $i);
                if ($contains === true) {
                    $data = config('custom.' . 'demo-' . $i);
                }
            }
        } else {
            $data = config('custom.custom');
        }


        // default data array
        $DefaultData = [
            'mainLayoutType' => 'vertical',
            'theme' => 'light',
            'sidebarCollapsed' => false,
            'navbarColor' => '',
            'horizontalMenuType' => 'floating',
            'verticalMenuNavbarType' => 'floating',
            'footerType' => 'static', //footer
            'layoutWidth' => 'boxed',
            'showMenu' => true,
            'bodyClass' => '',
            'pageClass' => '',
            'pageHeader' => true,
            'contentLayout' => 'default',
            'blankPage' => false,
            'defaultLanguage' => 'pt',
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($DefaultData, $data);

        // All options available in the template
        $allOptions = [
            'mainLayoutType' => array('vertical', 'horizontal'),
            'theme' => array('light' => 'light', 'dark' => 'dark-layout', 'bordered' => 'bordered-layout', 'semi-dark' => 'semi-dark-layout'),
            'sidebarCollapsed' => array(true, false),
            'showMenu' => array(true, false),
            'layoutWidth' => array('full', 'boxed'),
            'navbarColor' => array('bg-primary', 'bg-info', 'bg-warning', 'bg-success', 'bg-danger', 'bg-dark'),
            'horizontalMenuType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky'),
            'horizontalMenuClass' => array('static' => '', 'sticky' => 'fixed-top', 'floating' => 'floating-nav'),
            'verticalMenuNavbarType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky', 'hidden' => 'navbar-hidden'),
            'navbarClass' => array('floating' => 'floating-nav', 'static' => 'navbar-static-top', 'sticky' => 'fixed-top', 'hidden' => 'd-none'),
            'footerType' => array('static' => 'footer-static', 'sticky' => 'footer-fixed', 'hidden' => 'footer-hidden'),
            'pageHeader' => array(true, false),
            'contentLayout' => array('default', 'content-left-sidebar', 'content-right-sidebar', 'content-detached-left-sidebar', 'content-detached-right-sidebar'),
            'blankPage' => array(false, true),
            'sidebarPositionClass' => array('content-left-sidebar' => 'sidebar-left', 'content-right-sidebar' => 'sidebar-right', 'content-detached-left-sidebar' => 'sidebar-detached sidebar-left', 'content-detached-right-sidebar' => 'sidebar-detached sidebar-right', 'default' => 'default-sidebar-position'),
            'contentsidebarClass' => array('content-left-sidebar' => 'content-right', 'content-right-sidebar' => 'content-left', 'content-detached-left-sidebar' => 'content-detached content-right', 'content-detached-right-sidebar' => 'content-detached content-left', 'default' => 'default-sidebar'),
            'defaultLanguage' => array('en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt'),
            'direction' => array('ltr', 'rtl'),
        ];

        //if mainLayoutType value empty or not match with default options in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (array_key_exists($key, $DefaultData)) {
                if (gettype($DefaultData[$key]) === gettype($data[$key])) {
                    // data key should be string
                    if (is_string($data[$key])) {
                        // data key should not be empty
                        if (isset($data[$key]) && $data[$key] !== null) {
                            // data key should not be exist inside allOptions array's sub array
                            if (!array_key_exists($data[$key], $value)) {
                                // ensure that passed value should be match with any of allOptions array value
                                $result = array_search($data[$key], $value, 'strict');
                                if (empty($result) && $result !== 0) {
                                    $data[$key] = $DefaultData[$key];
                                }
                            }
                        } else {
                            // if data key not set or
                            $data[$key] = $DefaultData[$key];
                        }
                    }
                } else {
                    $data[$key] = $DefaultData[$key];
                }
            }
        }

        //layout classes
        $layoutClasses = [
            'theme' => $data['theme'],
            'layoutTheme' => $allOptions['theme'][$data['theme']],
            'sidebarCollapsed' => $data['sidebarCollapsed'],
            'showMenu' => $data['showMenu'],
            'layoutWidth' => $data['layoutWidth'],
            'verticalMenuNavbarType' => $allOptions['verticalMenuNavbarType'][$data['verticalMenuNavbarType']],
            'navbarClass' => $allOptions['navbarClass'][$data['verticalMenuNavbarType']],
            'navbarColor' => $data['navbarColor'],
            'horizontalMenuType' => $allOptions['horizontalMenuType'][$data['horizontalMenuType']],
            'horizontalMenuClass' => $allOptions['horizontalMenuClass'][$data['horizontalMenuType']],
            'footerType' => $allOptions['footerType'][$data['footerType']],
            'sidebarClass' => '',
            'bodyClass' => $data['bodyClass'],
            'pageClass' => $data['pageClass'],
            'pageHeader' => $data['pageHeader'],
            'blankPage' => $data['blankPage'],
            'blankPageClass' => '',
            'contentLayout' => $data['contentLayout'],
            'sidebarPositionClass' => $allOptions['sidebarPositionClass'][$data['contentLayout']],
            'contentsidebarClass' => $allOptions['contentsidebarClass'][$data['contentLayout']],
            'mainLayoutType' => $data['mainLayoutType'],
            'defaultLanguage' => $allOptions['defaultLanguage'][$data['defaultLanguage']],
            'direction' => $data['direction'],
        ];
        // set default language if session hasn't locale value the set default language
        if (!session()->has('locale')) {
            app()->setLocale($layoutClasses['defaultLanguage']);
        }

        // sidebar Collapsed
        if ($layoutClasses['sidebarCollapsed'] == 'true') {
            $layoutClasses['sidebarClass'] = "menu-collapsed";
        }

        // blank page class
        if ($layoutClasses['blankPage'] == 'true') {
            $layoutClasses['blankPageClass'] = "blank-page";
        }

        return $layoutClasses;
    }

    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        $fullURL = request()->fullurl();
        if (App()->environment() === 'production') {
            for ($i = 1; $i < 7; $i++) {
                $contains = Str::contains($fullURL, 'demo-' . $i);
                if ($contains === true) {
                    $demo = 'demo-' . $i;
                }
            }
        }
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set('custom.' . $demo . '.' . $config, $val);
                }
            }
        }
    }

    /**
     * Converte a mascara de dinheiro para o valor em float
     * @param $string
     * @return float
     */
    public static function moneyToNumber($string)
    {
        return (float)str_replace(['R$', ' '], '', $string);
    }

    /**
     * Retorna a notificação renderizada
     * @param $notification
     * @return mixed|string
     */
    public static function renderNotification($notification)
    {
        if ($notification->type === 'App\Notifications\NewProduct') {
            return '';
//            $product = $notification->data['product'];
//            $product = Product::find($product['id']);
//            return view('_partials._notifications.new-product', [
//                'product' => $product
//            ])->render();
        }
//        if($notification->type === 'App\Notifications\NewUserClient'){
//            $profile = $notification->data['profile'];
//            $user = Client::find($profile['id'])->user;
//            return view('_partials._notifications.new-user',[
//                'user'   =>  $user
//            ])->render();
//        }
        if ($notification->type === 'App\Notifications\NewBrandRequest') {
            $brand_request = $notification->data['brand_request'];
            $brand_request = BrandsRequest::find($brand_request['id']);
            return view('_partials._notifications.new-brand-request', [
                'brand_request' => $brand_request
            ])->render();
        }

        if ($notification->type === 'App\Notifications\BrandRequestApproved') {
            $brand_request = $notification->data['brand_request'];
            $brand_request = BrandsRequest::find($brand_request['id']);
            return view('_partials._notifications.approved-brand-request', [
                'brand_request' => $brand_request
            ])->render();
        }
        return $notification->type;
    }

    /**
     * Verifica se a quantidade atual de produtos é permitida no plano e bloqueia os excedentes
     */
    public static function verifyProductsLimit($plan,$entity = null)
    {
        if(!$entity) $entity = auth()->user()->entity;
        $product_limit = $plan->product_limit;
        $count_user_products = $entity->count_products;
        EntityProduct::where('entity_id', $entity->id)->update([
            'locked' => false
        ]);
        if ($count_user_products > $product_limit) {
            $products = $entity->products()->limit($count_user_products - $product_limit)->get();
            $products_id = $products->pluck('id');
            EntityProduct::whereIn('product_id', $products_id)->update([
                'locked' => true
            ]);
            return true;
        }
        $products = $entity->products;
        $products_id = $products->pluck('id');
        EntityProduct::whereIn('product_id', $products_id)->update([
            'locked' => false
        ]);
        return true;
    }

    public static function getColumnsInfosTranslated($without = [])
    {
        $columns = [
            'vehicle_submodel_info' => "Versão",
            'vehicle_body_type_info' => "Tipo Carroceria",
            'vehicle_body_type_mfr_name_info' => "Nome Carroceria",
            'vehicle_body_generation_info' => "Código Carroceria",
            'vehicle_num_door_info' => "Número Portas",
            'vehicle_engine_liter_info' => "Cilindrada",
            'vehicle_engine_valve_info' => "Válvulas",
            'vehicle_engine_cylinder_info' => "Cilindros",
            'vehicle_engine_version_info' => "Motor",
            'vehicle_engine_aspiration_info' => "Aspiração",
            'vehicle_engine_power_info' => "Potência",
            'vehicle_transmission_control_type_info' => "Transmissão",
            'vehicle_transmission_mfr_name_info' => "Modelo Transmissão",
            'vehicle_drive_type_info' => "Tração",
            'vehicle_drive_type_mfr_name_info' => "Modelo Tração",
            'vehicle_fuel_type_info' => "Tipo Combustível",
            'vehicle_fuel_mfr_name_info' => "Sistema Combustível",
            'vehicle_load_capacity_info' => "Capacidade Carga",
            'vehicle_mfr_code_info' => "Código Veículo",
            'quantity' => "Quantidade",
            'position' => "Posição",
            'note' => "Anotação",
        ];

        return array_diff($columns,$without);
    }

    public static function getTableInfosName($column = '')
    {
        return Helper::getColumnsInfosTranslated()[$column];
    }

    public static function getNameInfosTable($name = '',$with_table_name = false)
    {
        $columns = collect(Helper::getColumnsInfosTranslated())->flip();
        if($with_table_name){
            $columns = collect($columns)->map(function($c){
                if($c == 'quantity' or $c == 'note') return $c;
                if($c == 'position') return 'fitment_positions';
                return $c.'s';
            })->toArray();
        }
        return $columns[$name];
    }

    /**
     * Remove acentos e deixa tudo minusculo
     * @param $string
     * @return string
     */
    public static function sanitize($string): string
    {
        return strtolower(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string));
    }
}
