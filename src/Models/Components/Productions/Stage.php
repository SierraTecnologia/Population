<?php

namespace Population\Models\Components\Productions;

/**
 * Tipos de Produções
 */
use Support\Models\Base;

class Stage extends Item
{

    protected $table = 'production_stages';

    /**
     * Esboço
     *
     * @var array
     */
    public static $ESBOCO = 1;

    /**
     * Criando História
     *
     * @var array
     */
    public static $HISTORY = 2;


    /**
     * Detalhando Roteiro
     *
     * @var array
     */
    public static $ROTEIRO = 3;

    /**
     * Produzindo
     *
     * @var array
     */
    public static $PRODUCTION = 4;

    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany('Population\Models\Identity\Actors\Person', 'skillable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(config('sitec.core.models.user', \App\Models\User::class), 'skillable');
    }
}