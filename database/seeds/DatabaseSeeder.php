<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->catalogs();
    }

    public function catalogs()
    {
        DB::table('day')->insert([
            ['name' => 'Lunes'],
            ['name' => 'Martes'],
            ['name' => 'Miercoles'],
            ['name' => 'Jueves'],
            ['name' => 'Viernes'],
        ]);

        DB::table('rol')->insert([
            ['name' => 'Administrador'],
            ['name' => 'Profesor'],
            ['name' => 'Alumno'],
        ]);

        DB::table('carrier')->insert([
            ['name' => 'Ing. Idustrial'],
            ['name' => 'Ing. Logística'],
            ['name' => 'Ing. Sistemas'],
            ['name' => 'Ing. Química'],
            ['name' => 'Ing. Mecatrónica'],
            ['name' => 'T.I.C.S'],
            ['name' => 'Ing. Electrónica'],
        ]);

    }

    public function fakeUsers()
    {
        //Teachers
        for ($i = 0; $i < 10; $i++) {
            $userId = DB::table('user')->insertGetId(
                [
                    'name' => \Faker\Factory::create("es_ES")->name . \Faker\Factory::create("es_ES")->lastName,
                    'username' => "1428048" . $i,
                    'password' => bcrypt("pw0000"),
//                    'email' => \Faker\Factory::create()->email,
                    'fk_id_rol' => 2,
                    'fk_id_carrier' => rand(1, 10),
                ]
            );
            for ($j = 0; $j < 3; $j++) {
                $advisory = DB::table('advisory')->insertGetId(
                    [
                        'name' => "asesoria " . \Faker\Factory::create()->city,
                        'fk_id_user' => $userId
                    ]
                );
                DB::table('advisory_has_day')->insertGetId(
                    [
                        "start_hour" => $j === 1 ? "09:00:00" : rand(11, 12) . ":00:00",
                        "end_hour" => rand(13, 15) . ":00:00",
                        'fk_id_advisory' => $advisory,
                        'fk_id_day' => rand(1, 5),
                    ]
                );
            }
        }
    }
}
