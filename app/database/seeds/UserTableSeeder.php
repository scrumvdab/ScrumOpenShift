<?php

class UserTableSeeder extends Seeder {

    public function run() {
        // aanmaak users
        User::create(array(
            'username' => 'ValentinoGahide',
            'password' => Hash::make('secret'),
            'lvl_auth' => 2,
            'firstname' => 'Valentino',
            'lastname' => 'Gahide',
            'adress' => 'Ingooigemstraat 14',
            'city' => 'Otegem',
            'zip' => 8553,
            'email' => 'valentinogahide@gmail.com',
            'phone' => '0479/45.42.13',
            'message' => 'Test',
            'news' => true,
            'news_extra' => false,
            'banknr' => '123456789.007',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));

        User::create(array(
            'username' => 'MaartenPasschyn',
            'password' => Hash::make('secret'),
            'lvl_auth' => 1,
            'firstname' => 'Maarten ',
            'lastname' => 'Passchyn',
            'city' => 'Otegem',
            'zip' => 8450,
            'email' => 'maarten.passchyn@gmail.com',
            'phone' => '0496/23.58.94',
            'message' => 'Test',
            'news' => false,
            'news_extra' => false,
            'banknr' => '266376931.001',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));
        User::create(array(
            'username' => 'SebastiaanDeslypere',
            'password' => Hash::make('secret'),
            'lvl_auth' => 0,
            'firstname' => 'Sebastiaan',
            'lastname' => 'Deslypere',
            'city' => 'Otegem',
            'zip' => 9000,
            'email' => 'sebastiaanslyper@gmail.com',
            'phone' => '0479/45.42.13',
            'message' => 'Test',
            'news' => true,
            'news_extra' => false,
            'banknr' => '123456789.007',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));
        User::create(array(
            'username' => 'admin',
            'password' => Hash::make('secret'),
            'lvl_auth' => 2,
            'firstname' => 'admin',
            'lastname' => 'admin',
            'city' => 'Otegem',
            'zip' => 8553,
            'email' => 'admin@admin.com',
            'phone' => '0479/45.42.13',
            'message' => 'Test',
            'news' => true,
            'news_extra' => true,
            'banknr' => '123456789.007',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));
    }

}
