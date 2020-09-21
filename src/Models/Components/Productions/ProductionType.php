<?php

namespace Population\Models\Components\Productions;

/**
 * Tipos de Produções
 */
use Pedreiro\Models\Base;

class ProductionType extends Base
{

    protected $table = 'production_types';

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