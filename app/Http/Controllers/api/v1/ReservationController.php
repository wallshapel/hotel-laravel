<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\ReservationService;
use App\Http\DTOs\ReservationDTO;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index()
    {
        return response()->json($this->reservationService->getAll());
    }

    public function store(Request $request)
    {
        $reservationDTO = ReservationDTO::fromRequest($request);
        $reservation = $this->reservationService->create($reservationDTO);
        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        return response()->json($this->reservationService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $reservationDTO = ReservationDTO::fromRequest($request);
        $reservation = $this->reservationService->update($id, $reservationDTO);
        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $this->reservationService->delete($id);
        return response()->json(null, 204);
    }

    /**
     * Verificar disponibilidad de hoteles según la fecha de viaje.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkHotelAvailability(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $availableHotels = $this->reservationService->checkHotelAvailability($checkIn, $checkOut);

        return response()->json([
            'message' => 'Available hotels retrieved successfully',
            'data' => $availableHotels,
        ], 200);
    }

    public function getHotelRates(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'room_type' => 'required|in:standard,premium,VIP',
            'number_of_people' => 'required|integer|min:1',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $location = $request->input('location');
        $roomType = $request->input('room_type');
        $numberOfPeople = $request->input('number_of_people');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $hotelRates = $this->reservationService->getHotelRates($location, $roomType, $numberOfPeople, $checkIn, $checkOut);

        return response()->json([
            'message' => 'Hotel rates retrieved successfully',
            'data' => $hotelRates,
        ], 200);
    }
    
}
