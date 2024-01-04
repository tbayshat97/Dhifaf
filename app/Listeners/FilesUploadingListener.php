<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Alexusmai\LaravelFileManager\Events\FilesUploading;

class FilesUploadingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FilesUploading  $event
     * @return void
     */
    public function handle(FilesUploading $event)
    {
        // Log::info("event uploading" . $event);
        Log::info('FilesUploading:', [
            $event->disk(),
            $event->path( ),
            $event->files(),
            $event->overwrite(),
        ]);
    }
}
