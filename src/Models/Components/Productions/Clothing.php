<?php

namespace Population\Models\Components\Productions;

/**
 * Tipos de Produções
 */
use Support\Models\Base;

class Clothing extends Item
{

    protected $table = 'production_item_clothings';

    /**
     * Filmes
     *
     * @var array
     */
    public static $MOVIE = 1;

    /**
     * Jogos de Rpg
     *
     * @var array
     */
    public static $RPG = 2;

    /**
     * Seriados
     *
     * @var array
     */
    public static $SERIADOS = 3;

    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.person', \Population\Models\Identity\Actors\Person::class), 'skillable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'skillable');
    }
}