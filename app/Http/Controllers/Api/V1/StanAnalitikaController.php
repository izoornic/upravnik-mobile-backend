<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StanAnalitikaResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StanAnalitikaController extends Controller
{
    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $zgradaIds = $request->user()->accessibleZgradaIds();

        $analitika = $zgradaIds->flatMap(fn (int $zgradaId) => $this->legacyApi->getStanoviAnalitikaByZgrada($zgradaId));

        return StanAnalitikaResource::collection($analitika);
    }
}
