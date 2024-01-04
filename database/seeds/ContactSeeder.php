<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact_rows = [
            ['id' => 1],
        ];
        DB::table('contacts')->insert($contact_rows);
        DB::table('contacts')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $contact_translations_rows = [
            ['id' => 1, 'contact_id' => 1, 'locale' => 'en','content' => 'There are many variations of have suffered.'],
            ['id' => 2, 'contact_id' => 1, 'locale' => 'ar','content' => 'هناك العديد من الاختلافات التي عانت'],
        ];

        DB::table('contact_translations')->insert($contact_translations_rows);

        DB::table('contact_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // locations
        $contact_location_rows = [
            ['id' => 1,'contact_id' => 1],
            ['id' => 2,'contact_id' => 1],
        ];
        DB::table('contact_locations')->insert($contact_location_rows);
        DB::table('contact_locations')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $contact_location_translations_rows = [
            ['id' => 1, 'contact_location_id' => 1, 'locale' => 'en','country' => 'Iraq','street' => 'Al-Hurriya Complex','area' => 'Karrada ','city' => 'Baghdad'],
            ['id' => 2, 'contact_location_id' => 1, 'locale' => 'ar','content' => 'العراق','street' => 'الحرية','area' => 'كرادة ','city' => 'بغداد'],
            ['id' => 3, 'contact_location_id' => 2, 'locale' => 'en','country' => 'Iraq','street' => 'Al-Hurriya Complex','area' => 'Karrada ','city' => 'Baghdad'],
            ['id' => 4, 'contact_location_id' => 2, 'locale' => 'ar','content' => 'العراق','street' => 'الحرية','area' => 'كرادة ','city' => 'بغداد'],
        ];

        DB::table('contact_location_translations')->insert($contact_location_translations_rows);

        DB::table('contact_location_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // infos
        $contact_info_rows = [
            ['id' => 1,'contact_id' => 1,'phone' => '+964738533305'],
            ['id' => 2,'contact_id' => 1,'phone' => '+964738533305'],
        ];
        DB::table('contact_infos')->insert($contact_info_rows);
        DB::table('contact_infos')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $contact_info_translations_rows = [
            ['id' => 1, 'contact_info_id' => 1, 'locale' => 'en','title' => 'asia'],
            ['id' => 2, 'contact_info_id' => 1, 'locale' => 'ar','title' => 'اسيا'],
            ['id' => 3, 'contact_info_id' => 2, 'locale' => 'en','title' => 'whatsapp'],
            ['id' => 4, 'contact_info_id' => 2, 'locale' => 'ar','title' => 'whatsapp'],
        ];

        DB::table('contact_info_translations')->insert($contact_info_translations_rows);

        DB::table('contact_info_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // emails
        $contact_email_rows = [
            ['id' => 1,'contact_id' => 1,'email' => 'info@dhifafbaghdad.com'],
        ];
        DB::table('contact_emails')->insert($contact_email_rows);
        DB::table('contact_emails')->update([
             'created_at' => now(),
              'updated_at' => now()
        ]);

    }
}
