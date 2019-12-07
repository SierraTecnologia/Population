<?php

namespace Population\Models\Components\Productions;

/**
 * Tipos de Produções
 */
use Population\Models\Model;

class CharacterClothing extends Item
{

    protected $table = 'production_character_clothings';

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

}