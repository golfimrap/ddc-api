<?php

namespace App\Http\Controllers;
use App\Models\All_Disease;

class DiseaseController extends Controller
{
    public static function getDisease($disease_id) {
        $result = All_Disease::where('DISEASE', $disease_id)->get();
        $data = json_decode($result, true);
        return $data;
    }

    public static function getDiseaseSex($disease_id, $sex_id) {
        $result = All_Disease::where('DISEASE', $disease_id)->where('SEX', $sex_id)->get();
        $data = json_decode($result, true);
        return $data;
    }

    public static function getDiseaseProvince($disease_id, $province_id) {
        $result = All_Disease::where('DISEASE', $disease_id)->where('PROVINCE', $province_id)->get();
        $data = json_decode($result, true);
        return $data;
    }

    public static function getDiseaseAgeNewborn($disease_id) {
        $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [0, 6])->get();
        $data = json_decode($result, true);

        return $data;
    }

    public static function getDiseaseAgeChildren($disease_id) {
        $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [7, 18])->get();
        $data = json_decode($result, true);

        return $data;
    }

    public static function getDiseaseAgeWorking($disease_id) {
        $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [19, 60])->get();
        $data = json_decode($result, true);

        return $data;
    }

    public static function getDiseaseAgeSenile($disease_id) {
        $result = All_Disease::where('DISEASE', $disease_id)->where('agey', '>', 60)->get();
        $data = json_decode($result, true);

        return $data;
    }
}
