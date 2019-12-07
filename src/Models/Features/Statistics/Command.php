<?php
/**
 * Sistemas de Analise de Crédito e Fraudes
 */

namespace Population\Models\Features\Statistics;

use Informate\Models\Model;

class Command extends Model
{

    protected $organizationPerspective = false;

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
        // Comando que gerou o Resultado
        'command',
        'name',
        'description',
        'status',
    ];

    /**
     */
}