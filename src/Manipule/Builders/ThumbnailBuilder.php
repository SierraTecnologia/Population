<?php

namespace Population\Manipule\Builders;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ThumbnailBuilder.
 *
 * @package Population\Manipule\Builders
 */
class ThumbnailBuilder extends Builder
{
    /**
     * @return $this
     */
    public function whereHasNoPhotos()
    {
        return $this->doesntHave('photos');
    }
}
