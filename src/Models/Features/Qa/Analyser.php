<?php

namespace Population\Models\Features\Qa;

use Informate\Models\Model;

class Analyser extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public static $TYPE_ID = 1;

    protected $table = 'analysers';                                                                                                                                                                
                                                                                                                                                                                                 
    public $errorMessage = null;                                                                                                                                                                 
                                                                                                                                                                                                 
    public static function rules()                                                                                                                                                               
    {                                                                                                                                                                                            
        return [                                                                                                                                                                                 
            'model_name' => 'required|name|max:32',                                                                                                                                    
            'model_id' => 'required|integer',                                                                                                                                        
            'dateinseconds' => 'required|integer',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_name',
        'model_id',
        'analyser_type_id',
        'analyser_data',
        'ip',
        'ip_send',
        'processing',
        'dateinseconds',
    ];

    public static function boot()
    {
        parent::boot();

        // @todo Debito Tecnico. Transformar em Evento
        self::creating(function($model){
            // @todo Avisa Sistemas de Anti Roubo (Fraud Analysis)
        });

    }
}