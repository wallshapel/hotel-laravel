<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\RoomService;
use App\Http\DTOs\RoomDTO;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index()
    {
        return response()->json($this->roomService->getAll());
    }

    public function store(Request $request)
    {
        $roomDTO = RoomDTO::fromRequest($request);
        $room = $this->roomService->create($roomDTO);
        return response()->json($room, 201);
    }

    public function show($id)
    {
        return response()->json($this->roomService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $roomDTO = RoomDTO::fromRequest($request);
        $room = $this->roomService->update($id, $roomDTO);
        return response()->json($room);
    }

    public function destroy($id)
    {
        $this->roomService->delete($id);
        return response()->json(null, 204);
    }
}
