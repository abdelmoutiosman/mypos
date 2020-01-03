<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            "about_app"=>"this is powerful app",
            "facebook_url"=>"facebook",
            "twitter_url"=>"twitter",
            "instagram_url"=>"instagram",
        ]);
    }
}
