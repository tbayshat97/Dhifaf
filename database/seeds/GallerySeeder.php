<?php

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use App\Models\GalleryTranslation;
use Illuminate\Support\Facades\File;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GalleryTranslation::class, 4)->create();

        $faker = Faker\Factory::create();
        $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

        $filepath_album = public_path('storage/album');
        if (!File::exists($filepath_album)) {
            File::makeDirectory($filepath_album, 0777, true);
        }

        $imagePath = 'album/' . $faker->image($filepath_album, 1000, 1000, ['technics'], false);

        $image = [
            'file' => $imagePath,
            'name' => 'Seeder',
            'size' => 41638,
            'local' => $imagePath,
            'type' => 'image/jpeg',
            'data' => [
                'url' => $imagePath,
                'thumbnail' => $imagePath,
                'readerForce' => true
            ],
        ];

        $galleries = Gallery::all();
        foreach ($galleries as $gallery) {
            $album = new Album();
            $album->gallery_id = $gallery->id;
            $album->gallery_image = json_encode([$image]);
            $album->save();
        }
    }
}
