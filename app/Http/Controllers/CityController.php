<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities(Request $request)
    {
        $pref = $request->pref;

        $json = file_get_contents(public_path('json/pref_city.json'));
        $data = json_decode($json, true);

        if (isset($data[$pref])) {
            $result = $data[$pref]['cities'];
            return response()->json($result);
        } else {
            return response()->json([]);
        }
    }
}
