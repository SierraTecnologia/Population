<?php
/**
 * Sistemas de Analise de Crédito e Fraudes
 */

namespace Population\Models\Features\Statistics;

use Pedreiro\Models\Base;

class CommandResult extends Base
{

    protected $organizationPerspective = true;

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
        // Comando que Rodou
        'command_execute_id',
        // Por Commit
        'ciclo',
        'description',
        'status',
    ];

    /**
     */
}