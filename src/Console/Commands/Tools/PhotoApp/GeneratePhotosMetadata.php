<?php

namespace Population\Console\Commands\Tools\PhotoApp;

use App\Models\Photo;
use Finder\Services\Image\Contracts\ImageProcessor;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Throwable;

/**
 * Class GeneratePhotosMetadata.
 *
 * @package Population\Console\Commands\Tools\PhotoApp
 */
class GeneratePhotosMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:photos_metadata
                                {--chunk_size=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate photos metadata';

    /**
     * Execute the console command.
     *
     * @param  ImageProcessor $imageProcessor
     * @return void
     */
    public function handle(ImageProcessor $imageProcessor): void
    {
        (new Photo)
            ->newQuery()
            ->chunk(
                $this->option('chunk_size'), function (Collection $photos) use ($imageProcessor) {
                    $photos->each(
                        function (Photo $photo) use ($imageProcessor) {
                            try {
                                $this->comment("Processing photo {$photo->id}...");
                                $photo->metadata = $imageProcessor->open($photo->path)->getMetadata();
                                $photo->save();
                            } catch (Throwable $e) {
                                $this->error($e->getMessage());
                            }
                        }
                    );
                }
            );
    }
}
