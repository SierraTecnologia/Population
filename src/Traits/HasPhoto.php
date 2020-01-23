<?php

namespace Population\Traits;

use Log;
use Support\Models\Base;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

trait HasPhoto
{
    use HasMediaTrait;

    public static function bootHasPhoto()                                                                                                                                                             
    {

        static::deleting(function (self $user) {
            optional($user->photos)->each(function (Photo $photo) {
                $photo->delete();
            });
        });
    }
    
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->getMedia();
    }

    public function getProfileUrl($altura = false, $largura = false)
    {
        $media = $this->getMedia('avatars')->first();

        if (!$media) {
            return ''; // @todo Botar imagem Padrao
        }

        return $media->getUrl('thumb');
    }

}
