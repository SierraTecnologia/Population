<?php
/**
 * Sistemas de Analise de Crédito e Fraudes
 */

namespace Population\Models\Features\Statistics;

use Pedreiro\Models\Base;
use Muleta\Traits\Models\ComplexRelationamentTrait;

class Statistic extends Base
{
    use ComplexRelationamentTrait;

    protected $organizationPerspective = true;

    protected $table = 'statistics';     

    protected static $COMPLEX_RELATIONAMENT_MODELS = [
        'model' => [
            \Fabrica\Models\Code\Commit::class
        ]
    ];


    /**
     * The attributes that are mass assignable.
     * 
     * Ex:
     * Table git effort --above 15 {src,lib}/*
     * File | n commits | active days
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'model_id',
        // Por Commit
        'ciclo',
        'description',
        'status',
    ];

    /**
     */
}