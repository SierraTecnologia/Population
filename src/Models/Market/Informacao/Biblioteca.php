<?php

namespace Population\Models\Market\Informacao;

use Pedreiro\Models\Base;
use Muleta\Traits\Models\ComplexRelationamentTrait;
use Informate\Models\Entytys\Category\BibliotecaType;

class Biblioteca extends Base
{
    public $rules = [
    'name'   => 'required',
    // 'slug'    => 'required|unique:posts,slug',
    // 'content' => 'required'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'name', // im segundos
        'biblioteca_type_id',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'biblioteca_type_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->bibliotecaType();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bibliotecaType()
    {
        return $this->belongsTo(BibliotecaType::class, 'biblioteca_type_id', 'id');
    }
}
