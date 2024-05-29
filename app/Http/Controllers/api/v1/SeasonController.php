<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\SeasonService;
use App\Http\DTOs\SeasonDTO;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    protected $seasonService;

    public function __construct(SeasonService $seasonService)
    {
        $this->seasonService = $seasonService;
    }

    public function index()
    {
        return response()->json($this->seasonService->getAll());
    }

    public function store(Request $request)
    {
        $seasonDTO = SeasonDTO::fromRequest($request);
        $season = $this->seasonService->create($seasonDTO);
        return response()->json($season, 201);
    }

    public function show($id)
    {
        return response()->json($this->seasonService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $seasonDTO = SeasonDTO::fromRequest($request);
        $season = $this->seasonService->update($id, $seasonDTO);
        return response()->json($season);
    }

    public function destroy($id)
    {
        $this->seasonService->delete($id);
        return response()->json(null, 204);
    }
}
