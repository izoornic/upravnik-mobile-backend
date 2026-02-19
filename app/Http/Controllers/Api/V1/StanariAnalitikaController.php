<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Concerns\AuthorizesZgradaAccess;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StanariAnalitikaResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StanariAnalitikaController extends Controller
{
    use AuthorizesZgradaAccess;

    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request, int $zgradaId): AnonymousResourceCollection
    {
        $this->authorizeZgradaAccess($request, $zgradaId);

        $analitika = $this->legacyApi->getStanariAnalitika($zgradaId);

        return StanariAnalitikaResource::collection($analitika);
    }
}
