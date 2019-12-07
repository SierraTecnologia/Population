<?php

namespace Population\Models\Components\Productions;

/**
 * Tipos de Produções
 */
use Population\Models\Model;

class ClothingType extends Item
{

    protected $table = 'production_item_clothings';

    /**
     * Filmes
     *
     * @var array
     */
    public static $CALÇA = 1;

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