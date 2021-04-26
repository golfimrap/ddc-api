<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\All_Disease;
use App\Models\ApiDisease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDiseaseController extends Controller
{

    /** @OA\Get(
        ** path="/api/getDisease/{disease_id}",
        *   tags={"Disease"},
        *   summary="Count Disease",
        *   operationId="Disease Count",
        *   @OA\Parameter(
        *       required=true,
        *       name="disease_id",
        *       description="id",
        *       in="path",
        *       @OA\Schema(
        *           type="integer"
        *       )
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="count", type="bigint", example="9999"),
        *           @OA\Property(property="message", type="string", example="Retrieved Successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

    public function countDisease($disease_id)
    {
        $result_count = All_Disease::where('DISEASE', $disease_id)->get()->count();
        $data_count = json_decode($result_count, true);
        if($data_count) {
            return response([
                'count' => $data_count,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    /** @OA\Get(
        ** path="/api/getDiseaseGender/{disease_id}",
        *   tags={"Disease"},
        *   summary="Count Gender",
        *   operationId="Disease Gender",
        *   @OA\Parameter(
        *       required=true,
        *       name="disease_id",
        *       description="id",
        *       in="path",
        *       @OA\Schema(
        *           type="integer"
        *       )
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="male", type="bigint", example="9999"),
        *           @OA\Property(property="female", type="bigint", example="9999"),
        *           @OA\Property(property="message", type="string", example="Retrieved Successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

    public function genderDisease($disease_id)
    {
        $result_male = All_Disease::where('DISEASE', $disease_id)->where('SEX', 1)->get()->count();
        $result_female = All_Disease::where('DISEASE', $disease_id)->where('SEX', 2)->get()->count();
        $data_male = json_decode($result_male, true);
        $data_female = json_decode($result_female, true);
        if($data_male && $data_female) {
            return response([
                'male' => $data_male,
                'female' => $data_female,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    /** @OA\Get(
        ** path="/api/getDiseaseProvince/{disease_id}",
        *   tags={"Disease"},
        *   summary="Count Province",
        *   operationId="Disease Province",
        *   @OA\Parameter(
        *       required=true,
        *       name="disease_id",
        *       description="id",
        *       in="path",
        *       @OA\Schema(
        *           type="integer"
        *       )
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="PROVINCE", type="bigint", example="10"),
        *           @OA\Property(property="count_province", type="bigint", example="9999"),
        *           @OA\Property(property="message", type="string", example="Retrieved Successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

    public function provinceDisease($disease_id)
    {
        $result_province = All_Disease::where('DISEASE', $disease_id)
                            ->select('PROVINCE',DB::raw('COUNT(PROVINCE) AS count_province'))
                            ->groupBy('PROVINCE')
                            ->get();
        $data_province = json_decode($result_province, true);

        if($data_province) {
            return response([
                'data' => $data_province,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    /** @OA\Get(
        ** path="/api/getDiseaseAge/{disease_id}",
        *   tags={"Disease"},
        *   summary="Count Age",
        *   operationId="Disease Age",
        *   @OA\Parameter(
        *       required=true,
        *       name="disease_id",
        *       description="id",
        *       in="path",
        *       @OA\Schema(
        *           type="integer"
        *       )
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="newborn", type="bigint", example="9999"),
        *           @OA\Property(property="children", type="bigint", example="9999"),
        *           @OA\Property(property="working", type="bigint", example="9999"),
        *           @OA\Property(property="senile", type="bigint", example="9999"),
        *           @OA\Property(property="message", type="string", example="Retrieved Successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

    public function ageDisease($disease_id)
    {
        $result_newborn = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [0, 6])->get()->count();
        $result_children = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [7, 18])->get()->count();
        $result_working = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [19, 60])->get()->count();
        $result_senile = All_Disease::where('DISEASE', $disease_id)->where('agey', '>', 60)->get()->count();

        $data_newborn = json_decode($result_newborn, true);
        $data_children = json_decode($result_children, true);
        $data_working = json_decode($result_working, true);
        $data_senile = json_decode($result_senile, true);

        if($data_newborn && $data_children && $data_working && $data_senile) {
            return response([
                'newborn' => $data_newborn,
                'children' => $data_children,
                'working' => $data_working,
                'senile' => $data_senile,
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    // public function childrenDisease($disease_id)
    // {
    //     $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [7, 18])->get();
    //     $data_children = json_decode($result, true);

    //     if($data_children) {
    //         return response([
    //             'children' => $data_children,
    //             'message'   => 'Retrieved Successfully'
    //         ], 200);
    //     }
    // }

    // public function workingDisease($disease_id)
    // {
    //     $result = All_Disease::where('DISEASE', $disease_id)->whereBetween('agey', [19, 60])->get();
    //     $data_working = json_decode($result, true);

    //     if($data_working) {
    //         return response([
    //             'working' => $data_working,
    //             'message'   => 'Retrieved Successfully'
    //         ], 200);
    //     }
    // }

    // public function senileDisease($disease_id)
    // {
    //     $result = All_Disease::where('DISEASE', $disease_id)->where('agey', '>', 60)->get();
    //     $data_senile = json_decode($result, true);

    //     if($data_senile) {
    //         return response([
    //             'senile' => $data_senile,
    //             'message'   => 'Retrieved Successfully'
    //         ], 200);
    //     }
    // }
}
