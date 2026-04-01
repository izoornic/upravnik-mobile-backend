<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ZgradaDetailResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ZgradaController extends Controller
{
    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $zgradaIds = $request->user()->accessibleZgradaIds();

        $zgrade = $zgradaIds->map(fn (int $id) => $this->legacyApi->getZgradaDetail($id));

        return ZgradaDetailResource::collection($zgrade);
    }
}
