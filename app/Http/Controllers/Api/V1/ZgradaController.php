<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ZgradaDetailResource;
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

    public function show(Request $request, int $id): ZgradaDetailResource
    {
        $zgradaIds = $request->user()->accessibleZgradaIds();

        if (! $zgradaIds->contains($id)) {
            abort(403, 'Nemate pristup ovoj zgradi.');
        }

        $zgrada = $this->legacyApi->getZgradaDetail($id);

        return new ZgradaDetailResource($zgrada);
    }
}
