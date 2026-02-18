<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ZgradaResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ZgradaController extends Controller
{
    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $zgradaIds = $request->user()->accessibleZgradaIds();

        $zgrade = $this->legacyApi->getZgrade($zgradaIds->toArray());

        return ZgradaResource::collection($zgrade);
    }

    public function show(Request $request, int $id): ZgradaResource
    {
        $zgradaIds = $request->user()->accessibleZgradaIds();

        if (! $zgradaIds->contains($id)) {
            abort(403, 'Nemate pristup ovoj zgradi.');
        }

        $zgrade = $this->legacyApi->getZgrade([$id]);
        $zgrada = $zgrade->first();

        if (! $zgrada) {
            abort(404);
        }

        return new ZgradaResource($zgrada);
    }
}
