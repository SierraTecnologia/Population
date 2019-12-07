<?php

namespace Population\Models;

use Informate\Models\Model as BaseModel;

class Model extends BaseModel
{
    /**
     * Provides public access to get the raw attribute value from the model.
     * Used in areas where no mutations are required but performance is critical.
     * @param $key
     * @return mixed
     */
    public function getRawAttribute($key)
    {
        return parent::getAttributeFromArray($key);
    }
}