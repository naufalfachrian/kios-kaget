<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * Search a listing of the resource by subdistrict id
     */
    public function search(Request $request): JsonResponse
    {
        $subDistrictId = $request->get('sub_district_id');
        $result = PostalCode::query()
            ->where('sub_district_id', '=', $subDistrictId)
            ->get();
        return response()->json($result);
    }
}
