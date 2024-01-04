<?php

use App\Enums\ArtistStatus;
use App\Models\Influencer;
use App\Models\ArtistProfile;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ArtistProfile::class, 20)->create();

        Influencer::find(1)->update([
            'username' => 'influencer@tubishat.info',
            'is_blocked' => false,
            'status' => ArtistStatus::Actived,
        ]);
    }
}
