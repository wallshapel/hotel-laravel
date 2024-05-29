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

    public function calculateReservationPrice($hotelId, $roomType, $numberOfRooms, $numberOfPeople, $checkIn, $checkOut)
    {
        // Obtener las tarifas aplicables al hotel y al tipo de habitación
        $rates = Rate::where('hotel_id', $hotelId)
                     ->where('room_type', $roomType)
                     ->whereDate('start_date', '<=', $checkIn)
                     ->whereDate('end_date', '>=', $checkOut)
                     ->get();

        // Calcular la tarifa total
        $totalPrice = 0;

        foreach ($rates as $rate) {
            $daysInRange = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));
            $pricePerNight = $rate->price / $rate->number_of_people;

            $totalPrice += $pricePerNight * $numberOfRooms * $numberOfPeople * $daysInRange;
        }

        return $totalPrice;
    }


    public function calculateReservationPrice(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type' => 'required|in:standard,premium,VIP',
            'number_of_rooms' => 'required|integer|min:1',
            'number_of_people' => 'required|integer|min:1',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $totalPrice = $this->reservationService->calculateReservationPrice(
            $request->hotel_id,
            $request->room_type,
            $request->number_of_rooms,
            $request->number_of_people,
            $request->check_in,
            $request->check_out
        );

        return response()->json(['total_price' => $totalPrice], 200);
    }

}
