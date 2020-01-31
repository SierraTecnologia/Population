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
<<<<<<< HEAD
        $media = $this->getMedia('avatars')->first();

        if (!$media) {
            return ''; // @todo Botar imagem Padrao
        }

        return $media->getUrl('thumb');
=======
        if ($avatar = $this->getMedia('avatars')->first()) {
            return $avatar->getUrl('thumb');
        }
        // @todo diferenciar homem de mulher
        return 'https://connectbuncombe.org/wp-content/uploads/2019/05/woman.png';
>>>>>>> 0730dde03f67e821e3b58dd1f2dac02090e56ebe
    }

}
