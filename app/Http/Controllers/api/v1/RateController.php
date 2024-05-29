<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\RateService;
use App\Http\DTOs\RateDTO;
use Illuminate\Http\Request;

class RateController extends Controller
{
    protected $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }

    public function index()
    {
        return response()->json($this->rateService->getAll());
    }

    public function store(Request $request)
    {
        $rateDTO = RateDTO::fromRequest($request);
        $rate = $this->rateService->create($rateDTO);
        return response()->json($rate, 201);
    }

    public function show($id)
    {
        return response()->json($this->rateService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $rateDTO = RateDTO::fromRequest($request);
        $rate = $this->rateService->update($id, $rateDTO);
        return response()->json($rate);
    }

    public function destroy($id)
    {
        $this->rateService->delete($id);
        return response()->json(null, 204);
    }
}
