<?php
/**
 * Armazena os tipos de pagamentos que fazem com cada moeda e suas taxas
 */

namespace Population\Models\Actions\Event;

use Illuminate\Support\Facades\Hash;

use Pedreiro\Models\Base;
class Payment  extends Base
{


    public function createByType()
    {
        return $this->belongsTo(\Illuminate\Support\Facades\Config::get('sitec.core.models.person', \Telefonica\Models\Actors\Person::class), 'customer_id', 'id');
    }
}