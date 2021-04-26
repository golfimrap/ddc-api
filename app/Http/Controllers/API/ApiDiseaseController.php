<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\All_Disease;
use App\Models\ApiDisease;
use Illuminate\Http\Request;

class ApiDiseaseController extends Controller
{
    public function countDisease($disease_id)
    {
        $result = All_Disease::where('DISEASE', $disease_id)->get()->count();
        $data_count = json_decode($result, true);
        if($data_count) {
            return response([
                'count_diease' => $data_count,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    public function genderDisease($disease_id, $gender_id)
    {
        $result = All_Disease::where('DISEASE', $disease_id)->where('SEX', $gender_id)->get();
        $data_gender = json_decode($result, true);

        if($data_gender) {
            return response([
                'gender' => $data_gender,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    public function provinceDisease($disease_id, $province_id)
    {
        $result = All_Disease::where('DISEASE', $disease_id)->where('PROVINCE', $province_id)->get();
        $data_province = json_decode($result, true);

        if($data_province) {
            return response([
                'province' => $data_province,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    public function newbornDisease($disease_id)
    {
        $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [0, 6])->get();
        $data_newborn = json_decode($result, true);

        if($data_newborn) {
            return response([
                'newborn' => $data_newborn,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    public function childrenDisease($disease_id)
    {
        $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [7, 18])->get();
        $data_children = json_decode($result, true);

        if($data_children) {
            return response([
                'children' => $data_children,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    public function workingDisease($disease_id)
    {
        $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [19, 60])->get();
        $data_working = json_decode($result, true);

        if($data_working) {
            return response([
                'working' => $data_working,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    public function senileDisease($disease_id)
    {
        $result = All_Disease::where('DISEASE', $disease_id)->where('agey', '>', 60)->get();
        $data_senile = json_decode($result, true);

        if($data_senile) {
            return response([
                'senile' => $data_senile,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }
}
