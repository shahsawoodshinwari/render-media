<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $bookings = Booking::latest()->get();

    return view('bookings.index', compact('bookings'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateBookingRequest $request, Booking $booking)
  {
    $booking->update($request->validated());

    return redirect()->route('bookings.index')->with('success', 'Booking successfully updated.');
  }
}
