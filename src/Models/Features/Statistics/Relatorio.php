<?php
/**
 * Sistemas de Analise de Crédito e Fraudes
 */

namespace Population\Models\Features\Statistics;

use Support\Models\Base;
use Informate\Traits\ComplexRelationamentTrait;

class Relatorio extends Base
{
    use ComplexRelationamentTrait;

    protected $organizationPerspective = true;

    protected $table = 'relatorios';     

    protected static $COMPLEX_RELATIONAMENT_MODELS = [
        'model' => [
            \Finder\Models\Digital\Code\Commit::class
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