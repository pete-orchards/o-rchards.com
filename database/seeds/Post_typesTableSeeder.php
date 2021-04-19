<?php

use Illuminate\Database\Seeder;

class Post_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        	'type' => 'tane',
        ];
        DB::table('post_types')->insert($param);

        $param = [
        	'type' => 'nae',
        ];
        DB::table('post_types')->insert($param);

        $param = [
        	'type' => 'mi',
        ];
        DB::table('post_types')->insert($param);

    }
}
