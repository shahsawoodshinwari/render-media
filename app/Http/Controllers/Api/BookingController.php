<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Enums\Booking\PaymentStatusEnum;
use App\Enums\Booking\RequestStatusEnum;
use App\Http\Requests\Api\StoreBookingRequest;

class BookingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $bookings = $request->user()->bookings()->latest();

    $bookings = $this->shouldPaginate ? $bookings->paginate() : $bookings->get();

    return response()->json(
      BookingResource::collection($bookings)
        ->response()
        ->getData(true)
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreBookingRequest $request)
  {
    $request->user()->bookings()->create([
      'request_status' => RequestStatusEnum::PENDING,
      'payment_status' => PaymentStatusEnum::PENDING,
      ...$request->validated(),
    ]);

    return response()->json([
      'message' => 'Thanks for submitting your request. Our team will get in touch with you shortly.',
    ], 201);
  }
}
