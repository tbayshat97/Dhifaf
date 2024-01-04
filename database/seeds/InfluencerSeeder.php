<?php

use App\Models\InfluencerProfile;
use Illuminate\Database\Seeder;
use App\Models\Influencer;

class InfluencerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(InfluencerProfile::class, 2)->create();
        $faker = Faker\Factory::create();
        $langs = [
            ['name' => 'english', 'code' => 'en'],
            ['name' => 'arabic', 'code' => 'ar'],
        ];
        $influencers = Influencer::all();
        foreach ($influencers as $influencer) {
            foreach ($langs as $lang) {
                $influencer->translateOrNew($lang['code'])->name = $faker->firstName . ' ' . $faker->lastName;
                $influencer->translateOrNew($lang['code'])->bio = $faker->realText;

                $influencer->save();
            }
        }

    }
}
