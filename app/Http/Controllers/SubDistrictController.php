<?php

namespace App\Http\Controllers;

use App\Models\SubDistrict;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubDistrictController extends Controller
{
    /**
     * Search a listing of the resource by query subdistrict name.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('query');
        $size = $request->get('size', 20);
        $result = SubDistrict::query()
            ->where('name', 'LIKE', '%'. $query .'%')
            ->with(['district', 'district.city', 'district.city.province'])
            ->take($size)
            ->get();
        return response()->json($result);
    }
}
