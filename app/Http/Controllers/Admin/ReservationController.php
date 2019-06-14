<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reservation;

class ReservationController extends Controller {

	public function getIndex()
    {
        $reservations = Reservation::all();
        return view('admin.pages.reservation', compact('reservations'));
    }

}
