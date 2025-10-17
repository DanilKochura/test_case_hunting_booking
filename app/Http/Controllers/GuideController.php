<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuideResource;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index(Request $request)
    {
        $query = Guide::active(); // выбираем активных


        //TODO: В идеале завести отдельный GuideFilter::class и реализовать эту логику там, но для единственного поля достаточно и этого
        if ($request->has('min_experience')) {  // проверяем минимальный опыт (фильтр)
            $query->minExperience($request->min_experience);
        }

        $guides = $query->get();

        return GuideResource::collection($guides);
    }
}
