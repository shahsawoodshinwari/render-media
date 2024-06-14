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
   * Show the form for editing the specified resource.
   */
  public function edit(Booking $booking)
  {
    return view('bookings.edit', compact('booking'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateBookingRequest $request, Booking $booking)
  {
    $booking->update($request->validated());

    return redirect()->route('bookings.index')->withSuccess('Booking successfully updated.');
  }
}
