<?php

namespace Population\Models\Features\Qa;

use Informate\Models\Model;
use Informate\Traits\EloquentGetTableNameTrait;
use Informate\Traits\ComplexRelationamentInTrait;

class AnalyzerResult extends Model
{
    use EloquentGetTableNameTrait, ComplexRelationamentInTrait;

    protected $organizationPerspective = true;

    /**
     * Possui um relacionamento com a tabela Task
     */
    protected static $COMPLEX_RELATIONAMENT_IN_MODELS = [
        \Informate\Models\Entytys\Digital\Bot\Task::class
    ];

    /**
     * Pendente
     */
    public static $STATUS_PENDDING = 0;

    /**
     * Em analise
     */
    public static $STATUS_ANALYSIS = 1;

    /**
     * Aprovado
     */
    public static $STATUS_APPROVED = 2;

    /**
     * Reprovado
     */
    public static $STATUS_REPROVED = 3;

    /**
     * Error
     */
    public static $STATUS_ERROR = 4;

    protected static function paramsForOldVersionZeroPointOne(Array $params)
    {
        // Será feita em versẽs futuras
        // if ($params['status']==0) {
        //     $params['status'] = 
        // }
    }

    protected $casts = [
        'customer_info' => 'json',
        'fraud_analysis' => 'json',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'origin',
        'company_token',
        'total',
        'card_description',
        'gateway_id',
        'gateway_token_mundipagg',
        'gateway_token_cielo',
        'gateway_token_rede',
        'tid',
        'reference',
        'description',
        'payment_type_id',
        'money_id',
        'installments',
        'is_active',
        'status',
        'customer_info',
        'device_token',
        'device',
        'company_id',
        'customer_id',
        'customer_token_id',
        'credit_card_id',
        'credit_card_token_id',
        'bank_slip_id',
        'fraud_analysis',
        'frauds_clearsale_rede',
        'frauds_konduto_token',
        // Taxa cobrada pelo client (Usuário business)
        'tax_id',
        // Taxa cobrada internamente do Payment Service do Client (Usuário business) em cima da transação
        'tax_payment_system'
        
    ];

    protected $mappingProperties = array(

        // Origem do Pedido
        // Ex: app
        'origin' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],

        // Token do Usuário (Ou passepague_token)
        'customer_id' => [
          'type' => 'integer',
          "analyzer" => "standard",
        ],


        // Token da Produtora/Organização/Company
        'company_token' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        // Preço
        'total' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        // Label da Fatura especifico para a Company
        'card_description' => [
          'type' => 'string',
          "analyzer" => "standardcustomer_info",
        ],

        // Adquirente de Pagamento
        // Ex: cielo
        'gateway_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'gateway_token_mundipagg' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'gateway_token_cielo' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'gateway_token_rede' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'gateway_token_pagseguro' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        // PaymentService Token
        'tid' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        
        'reference' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],

        'description' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],

        /**
         * Metodo de Pagamento: (default é 2 (cartão de cŕedito))
         */
        'payment_type_id' => [
          'type' => 'integer',
          "analyzer" => "standard",
        ],

        /**
         * Moeda Utilizada (Padrão Real)
         */
        'money_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],

        /**
         * Número de Parcelas: (default é 1 (limit 12))
         */
        'installments' => [
          'type' => 'integer',
          "analyzer" => "standard",
        ],

        //  Default: 0
        'is_active' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],

        //  Default: 0
        'status' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],

        /**
         * Informações de Comprador
         */
        'customer_info' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        // $data['customer']['name'] = $user->nome;
        // $data['customer']['email'] = $user->email;
        // $data['customer']['address'] = [];
        // $data['customer']['address']['street'] = $user->rua;
        // $data['customer']['address']['number'] = $user->numero;
        // $data['customer']['address']['complement'] = $user->complemento;
        // $data['customer']['address']['zipcode'] = $user->cep;
        // $data['customer']['address']['city'] = $user_city;
        // $data['customer']['address']['state'] = $user->estado;
        // $data['customer']['address']['country'] = "BRA";

        /**
         * Informações Dispositivo
         */
        'device_token' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'device' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        /**
         * Cartão de Crédito
         */
        'credit_card_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        
        // Numeração Bancária
        'bank_slip_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],

        /**
         * Analise de Fraude
         */
        'fraud_analysi_id' => [
            'type' => 'id',
            "analyzer" => "standard",
        ],
        // fraud_analysis_info
        'fraud_analysis' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        // $data['fraud_analysis']['cart'] = [];
        // $data['fraud_analysis']['cart']['is_gift'] = false;
        // $data['fraud_analysis']['cart']['returns_accepted'] = false;
        // $data['fraud_analysis']['cart']['items'] = [];
        // $data['fraud_analysis']['shipping'] = [];

        /**
         * Sitec
         */
        'fraud_sitec_token' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        /**
         * Konduto
         */
        'fraud_konduto_token' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        /**
         * clearsale
         */
        'fraud_clearsale_token' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        /**
         * Informações sobre Entrega (Obrigátório para Konduto e Antifraude)
         */
        //preg_replace('/[^0-9]/', '', $request->identity_document);
        'tax_id' => [
            'type' => 'long',
            "analyzer" => "standard",
        ],
        // $data['billing_name'] = mb_strtoupper($request->card_name, $encoding);
        // $data['billing_address'] = $request->address;
        // $data['billing_complement'] = $request->complement;
        // $data['billing_city'] = $request->city;
        // $data['billing_state'] = $request->state;
        // $data['billing_zip'] = $request->zipcode;
        // $data['billing_country'] = "BRA";
        
    );

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            if ($model->status=='') {
                $model->status = 0;
            }
            if ($model->is_active=='') {
                $model->is_active = 0;
            }
            $model->tid = (string) Hash::make(str_random(8));
        });

    }

    public function gateway()
    {
        return $this->belongsTo('App\Models\Gateway', 'gateway_id', 'id');
    }

    public function money()
    {
        return $this->belongsTo('App\Models\Money');
    }

    public function fraudAnalysi()
    {
        return $this->belongsTo('App\Models\FraudAnalysi', 'fraud_analysi_id', 'id');
    }

    public function analysis()
    {
        return $this->hasMany('App\Models\Analysi', 'analysi_id', 'id');
    }

    /**
     * Retorna o cliente do payment responsável pelo entrega de ingressos
     * dos organizadores (produtoras)
     * Ex: Bilo ou Passepague
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Alias para business()
     * Obs: O sistema da passepague chama os organizadores de companhias
     */
    public function company()
    {
        return $this->business();
    }

    /**
     * Recupera a Produtora Responsável pela venda e entrega dos produtos
     */
    public function business()
    {
        return $this->belongsTo('App\Models\User', 'business_id', 'id');
    }

    /**
     * Recupera o Consumidor (Usuário que recebe o produto da venda)
     * Usuário que possui o cartão processado no pagamento
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * Recupera o Consumidor (Usuário que recebe o produto da venda)
     * Usuário que possui o cartão processado no pagamento
     */
    public function customerToken()
    {
        return $this->belongsTo('App\Models\CustomerToken');
    }

    /**
     * Cartão usado pelo consumidor
     */
    public function creditCard()
    {
        return $this->belongsTo('App\Models\CreditCard');
    }

    /**
     * Recupera a instancia de cartão na  usado pelo consumidor
     */
    public function creditToken()
    {
        return $this->belongsTo('App\Models\CreditCardToken');
    }

    /**
     * Responde uma string da Forma de Pagamento
     */
    public function getPaymentType()
    {
        if ($this->payment_type_id==PaymentType::$BOLETO_ID) {
            return trans('gateway.boleto');
        }

        if ($this->payment_type_id==PaymentType::$CREDIT_CARD_ID) {
            return trans('gateway.creditCard');
        }

        if ($this->payment_type_id==PaymentType::$ESPECIE_ID) {
            return trans('gateway.fiatMoney');
        }

        return trans('gateway.notIdentify');
    }
}