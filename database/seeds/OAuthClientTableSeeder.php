<?php

use Illuminate\Database\Seeder;




class OAuthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->where('id', '=', 'appid01')->delete();

        DB::table('oauth_clients')->insert([
            'id' => 'appid01',
            'secret' => 'secret',
            'name' => 'Minha App Mobile',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
