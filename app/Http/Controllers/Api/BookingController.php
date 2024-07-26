<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Enums\Auth\GuardEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookingResource;
use App\Notifications\PushNotification;
use App\Enums\Booking\PaymentStatusEnum;
use App\Enums\Booking\RequestStatusEnum;
use App\Http\Requests\Api\StoreBookingRequest;
use App\Http\Requests\Api\RescheduleBookingRequest;

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
      'payment_status' => PaymentStatusEnum::UNPAID,
      ...$request->validated(),
    ]);

    Auth::guard(GuardEnum::MEMBERS->value)->user()->notify(new PushNotification('New booking request', 'Thanks for submitting your request. Our team will get in touch with you shortly.'));

    return response()->json([
      'message' => 'Thanks for submitting your request. Our team will get in touch with you shortly.',
    ], 201);
  }

  /**
   * Reschedule the resource in storage.
   */
  public function reschedule(Booking $booking, RescheduleBookingRequest $request)
  {
    $booking->update($request->validated());

    return response()->json([
      'message' => 'Booking successfully rescheduled.',
    ]);
  }
}
