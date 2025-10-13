<?php

namespace App\Http\Controllers\pkg_Bookings;

use App\Http\Controllers\Controller;
use App\Models\pkg_Bookings\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,car_id',
            'price' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $booking = Booking::create([
            'car_id' => $request->car_id,
            'price' => $request->price,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => true, 'message' => 'Booking created successfully', 'data' => $booking], 201);
    }
}
