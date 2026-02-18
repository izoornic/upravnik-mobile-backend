<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Concerns\AuthorizesZgradaAccess;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StanResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StanController extends Controller
{
    use AuthorizesZgradaAccess;

    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request, int $zgradaId): AnonymousResourceCollection
    {
        $this->authorizeZgradaAccess($request, $zgradaId);

        $stanovi = $this->legacyApi->getStanoviByZgrada($zgradaId);

        return StanResource::collection($stanovi);
    }

    public function show(Request $request, int $zgradaId, int $stanId): StanResource
    {
        $this->authorizeZgradaAccess($request, $zgradaId);

        $stan = $this->legacyApi->getStan($zgradaId, $stanId);

        return new StanResource($stan);
    }
}
