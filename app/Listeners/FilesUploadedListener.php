<?php

namespace App\Listeners;

use Alexusmai\LaravelFileManager\Events\FilesUploaded;
use App\Models\Product;

class FilesUploadedListener
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
     * @param  FilesUploaded  $event
     * @return void
     */
    public function handle(FilesUploaded $event)
    {
        $files = (array) $event->files();
        foreach ($files as $file) {
            $separator = null;

            $switcherCondition = strpos($file["name"], 'sw');

            if (strpos($file["name"], '.') > 9 && !$switcherCondition) {
                $separator = substr($file["name"], (strripos($file["name"], '-')));
                $code = str_replace($separator, '', $file["name"]);

                $this->saveGallery($code, 'product/' . $file["name"], $file);
            }

            if (strpos($file["name"], '.') < 9) {
                $separator = substr($file["name"], (strpos($file["name"], '.')));
                $code = str_replace($separator, '', $file["name"]);
                $this->saveImage($code, 'product/' . $file["name"], $file);
            }

            // 001-0001-sw
            if ($switcherCondition) {
                $separator = substr($file["name"], (strripos($file["name"], '-')));
                $code = str_replace($separator, '', $file["name"]);
                $this->saveSwitcher($code, 'product/' . $file["name"], $file);
            }
        }
    }

    public function saveImage($code, $image, $file)
    {
        $product = Product::where('code', $code)->first();

        if ($product) {
            $product->image = json_encode([saveImportedMedia($image, $file["extension"])]);
            $product->save();
        }
    }

    public function saveGallery($code, $image, $file)
    {
        $product = Product::where('code', $code)->first();

        if ($product && !checkIfImportedMediaExist($product->gallery, [$image])) {
            $updated_images = getOldImportedGallery($product->gallery);
            $updated_images[] = saveImportedMedia($image, $file["extension"]);

            $product->gallery = json_encode($updated_images);

            $product->save();
        }
    }

    public function saveSwitcher($code, $image, $file)
    {
        $product = Product::where('code', $code)->first();

        if ($product) {
            $product->switcher = json_encode([saveImportedMedia($image, $file["extension"])]);
            $product->save();
        }
    }
}
