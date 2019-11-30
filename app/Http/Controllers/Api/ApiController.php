<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Advisory;
use App\Http\Models\User;
use DB;
use Exception;
use Faker\Factory;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function foo\func;

class ApiController extends Controller
{
    /**************************
     * USER
     **************************
     * @param Request $request
     * @return JsonResponse
     */

    public function login(Request $request)
    {
//        $this->catalogs();
//        $this->fakeUsers();
//        return dd("seed");
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::whereUsername($username)->first();

        if ($user === null) return response()->json([
            'success' => 'false',
            'message' => 'Usuario | contraseña no validos'
        ]);

        if (!Hash::check($password, $user->password))
            return response()->json([
                'success' => 'false',
                'message' => 'Usuario | contraseña no validos'
            ]);

        return response()->json([
            "success" => true,
            "data" => $user,
        ]);
    }

    public function userCreate(Request $request)
    {
        try {
            $user = new User();
            $user->fill($request->all());
            $user->save();
            return response()->json([
                "success" => true,
                "data" => $user,
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "data" => $e,
            ]);
        }
    }

    public function getAllUserType($userType)
    {
        $users = User::with([
            'contact',
            'rol',
            'carrier',
            'advisories.days'
        ])
            ->whereFkIdRol($userType)
            ->get();
        return response()->json($users);
    }

    public function getUserDetail($userId)
    {
        $user = User::with([
            'rol',
            'contact',
            'carrier',
            'advisories.days'
        ])->find($userId);
        return response()->json($user);
    }

    public function updateUser(Request $request, $userId)
    {
        $user = User::find($userId);
        $oldPassword = $user->password;
        $user->fill($request->all());
        if ($request->input('password', null) !== null) {
            $user->password = bcrypt($user->password);
        } else {
            $user->password = $oldPassword;
        }

        $contact = $user->contact;
        $contact->name = $request->input('contact.name', $contact->name);
        try {
            $contact->save();

            $user->save();
            return response()->json([
                'success' => true,
                "data" => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                "data" => $user,
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function upserAdvisory(Request $request, $userId)
    {
        try {
            DB::beginTransaction();
            $advisory = Advisory::firstOrNew(['id' => $request->input('id')]);
            $advisory->name = $request->input('name', null);
            $advisory->place_name = $request->input('place_name', null);
            $advisory->fk_id_user = $userId;

            $advisory->save();

            $days = $request->input('days');
            $savedDays = [];
            foreach ($days as $day) {
                $savedDays[$day['id']] = [
                    'start_hour' => $day['pivot']['start_hour'],
                    'end_hour' => $day['pivot']['end_hour'],
                ];
            }
            $advisory->days()->sync($savedDays);
            DB::commit();
            $advisory->load('days');
            return response()->json([
                'success' => true,
                'data' => $advisory
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return dd($e);
            abort(500, $e);
        }
    }

    public function searchAdvisory(Request $request)
    {
        $param = $request->get("query", null);

        $advisories = Advisory::where('name', 'like', "%" . $param . "%");

        if ($advisories->count() === 0) {
            $advisories = Advisory::whereHas('user', function ($q) use ($param) {
                $q->where('user.full_name', 'like', "%" . $param . "%");
            });
        }

        if ($advisories->count() === 0) {
            $advisories = Advisory::where('place_name', 'like', "%" . $param . "%");

        }

        $advisories = $advisories->with(['user.contact', 'days'])->get();

        return response()->json($advisories);
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
        //Amin
//        $userId = DB::table('user')->insertGetId(
//            [
//                'full_name' => "ADMIN",
//                'username' => "admin",
//                'password' => bcrypt("prueba"),
//                'fk_id_rol' => 1,
//                'fk_id_carrier' => 1,
//            ]
//        );
        //Teachers
        for ($i = 0; $i < 15; $i++) {
            $userId = DB::table('user')->insertGetId(
                [
                    'full_name' => \Faker\Factory::create("es_ES")->firstName . " " . \Faker\Factory::create("es_ES")->lastName,
                    'username' => "1128048" . $i,
                    'password' => bcrypt("pw0000"),
//                    'email' => \Faker\Factory::create()->email,
                    'fk_id_rol' => rand(2, 3),
                    'fk_id_carrier' => rand(1, 5),
                ]
            );
//            $advisory = DB::table('contact')->insertGetId(
//                [
//                    'name' => Factory::create()->email,
//                    'fk_id_user' => $userId
//                ]
//            );
//            for ($j = 0; $j < 3; $j++) {
//                $advisory = DB::table('advisory')->insertGetId(
//                    [
//                        'name' => "asesoria " . \Faker\Factory::create()->city,
//                        'place_name' => "Salon T-" . rand(1, 10),
//                        'fk_id_user' => $userId
//                    ]
//                );
//                DB::table('advisory_has_day')->insertGetId(
//                    [
//                        "start_hour" => $j === 1 ? "09:00:00" : rand(11, 12) . ":00:00",
//                        "end_hour" => rand(13, 15) . ":00:00",
//                        'fk_id_advisory' => $advisory,
//                        'fk_id_day' => rand(1, 5),
//                    ]
//                );
//            }
        }
    }
}
