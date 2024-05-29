<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\HotelService;
use App\Http\DTOs\HotelDTO;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index()
    {
        return response()->json($this->hotelService->getAll());
    }

    public function store(Request $request)
    {
        $hotelDTO = HotelDTO::fromRequest($request);
        $hotel = $this->hotelService->create($hotelDTO);
        return response()->json($hotel, 201);
    }

    public function show($id)
    {
        return response()->json($this->hotelService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $hotelDTO = HotelDTO::fromRequest($request);
        $hotel = $this->hotelService->update($id, $hotelDTO);
        return response()->json($hotel);
    }

    public function destroy($id)
    {
        $this->hotelService->delete($id);
        return response()->json(null, 204);
    }
}
