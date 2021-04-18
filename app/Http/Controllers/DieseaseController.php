<?php

namespace App\Http\Controllers;

use App\Models\All_Disease;
use App\Models\Boe2_cognos;
use Illuminate\Http\Request;

class DieseaseController extends Controller
{
    public static function getDisease($id) {
        $result = All_Disease::where('DISEASE', $id)->get();
        $data = json_decode($result, true);
        return $data;
    }

    public static function getDiseaseSex($id, $sex_id) {
        $result = All_Disease::where('DISEASE', $id)->where('SEX', $sex_id)->get();
        $data = json_decode($result, true);
        return $data;
    }
}
