<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\RoomService;
use Illuminate\Http\Request;
use App\Http\Requests\CheckAvailabilityRequest;
use App\Http\Requests\CalculateCancellationRateRequest;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Verificar disponibilidad de habitaciones.
     *
     * @param CheckAvailabilityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CheckAvailabilityRequest $request)
    {
        try {
            // Get check-in and check-out dates from the request
            $checkInDate = $request->input('check_in_date');
            $checkOutDate = $request->input('check_out_date');

            // Call the service to get available rooms
            $availableRooms = $this->roomService->getAvailableRooms($checkInDate, $checkOutDate);

            // Return the response
            return response()->json($availableRooms);
        } catch (\Exception $e) {
            return jsend_error($e);
        }
    }

    /**
     * Calcular la tarifa a cancelar para una habitación según los parámetros dados.
     *
     * @param CalculateCancellationRateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateCancellationRate(CalculateCancellationRateRequest $request)
    {
        try {
            // Obtener los parámetros de la solicitud
            $roomCode = $request->input('room_code');
            $seasonName = $request->input('season_name');
            $checkinDate = $request->input('checkin_date');
            $checkoutDate = $request->input('checkout_date');
            $numPeople = $request->input('num_people');

            // Llamar al servicio para calcular la tarifa de cancelación
            $totalCost = $this->roomService->calculateCancellationRate(
                $roomCode,
                $seasonName,
                $checkinDate,
                $checkoutDate,
                $numPeople
            );

            // Devolver la respuesta
            return response()->json(['total_cost' => $totalCost]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
