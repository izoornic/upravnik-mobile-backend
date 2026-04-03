<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StanResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StanController extends Controller
{
    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $zgradaIds = $request->user()->accessibleZgradaIds();

        $stanovi = $zgradaIds->flatMap(fn (int $zgradaId) => $this->legacyApi->getStanoviByZgrada($zgradaId));

        return StanResource::collection($stanovi);
    }

}
