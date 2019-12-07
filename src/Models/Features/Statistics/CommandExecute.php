<?php
/**
 * Sistemas de Analise de Crédito e Fraudes
 */

namespace Population\Models\Features\Statistics;

use Informate\Models\Model;

class CommandExecute extends Model
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
        'command_id',
        // Ex: Por Commit
        'ciclo_class', // Code/Commit::class()
        'ciclo_id',
        'description',
        'status',
    ];

    /**
     */
}