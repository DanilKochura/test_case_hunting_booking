<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHuntingBookingRequest;
use App\Http\Resources\HuntingBookingResource;
use App\Models\Guide;
use App\Models\HuntingBooking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HuntingBookingController extends Controller
{
    public function store(StoreHuntingBookingRequest $request): JsonResponse
    {

        $validated = $request->validated();

        // Проверка доступности гида на выбранную дату
        $existingBooking = HuntingBooking::where('guide_id', $validated['guide_id'])
            ->where('date', $validated['date'])
            ->exists();

        if ($existingBooking) {
            return response()->json([
                'message' => 'The selected guide is not available on this date.',
            ], 422);
        }

        // Проверка что гид активен
        $guide = Guide::find($validated['guide_id']);
        if (!$guide->is_active) {
            return response()->json([
                'message' => 'The selected guide is not active.',
            ], 422);
        }

        $booking = HuntingBooking::create($validated);

        return response()->json([
            'message' => 'Booking created successfully.',
            'data' => new HuntingBookingResource($booking),
        ], 201);
    }
}
