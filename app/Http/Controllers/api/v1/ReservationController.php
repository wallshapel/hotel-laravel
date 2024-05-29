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
}
