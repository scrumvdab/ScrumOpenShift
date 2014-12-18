<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivities extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('activities')->insert(array(
            'title' => 'Bezoek Hopmuseum',
            'body' => 'Wat was het toch weer fijn :)',
            'place' => 'Poperinge',
            'date_start' => '2014/12/04',
            'date_end' => '2014/12/04',
            'time_start' => '08:30',
            'time_end' => '16:00',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));

        DB::table('activities')->insert(array(
            'title' => 'Sinterklaasfeest',
            'body' => 'Wie zoet is krijgt lekkers, wie stout is een klets om zijn oren!',
            'place' => 'De Spiegel',
            'date_start' => '2014/11/12',
            'date_end' => '2014/11/13',
            'time_start' => '11:00',
            'time_end' => '12:00',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));

        DB::table('activities')->insert(array(
            'title' => 'Fietstocht',
            'body' => 'Dit is ook een test, woooooooooooooop',
            'place' => 'Ardennen',
            'date_start' => '2014/12/12',
            'date_end' => '2014/12/13',
            'time_start' => '11:30',
            'time_end' => '18:00',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));

        DB::table('activities')->insert(array(
            'title' => 'Feestje voor de toffe mensen',
            'body' => 'Dit is nog een test, mimimimimimimimimimimimimi',
            'place' => 'CC de coole kikker, Kortrijk',
            'date_start' => '2014/11/13',
            'date_end' => '2014/11/15',
            'time_start' => '12:00',
            'time_end' => '13:00',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('activities')->where('title', '=', 'Artikel 1')->delete();
        DB::table('activities')->where('title', '=', 'Artikel 2')->delete();
        DB::table('activities')->where('title', '=', 'Artikel 3')->delete();
    }

}
