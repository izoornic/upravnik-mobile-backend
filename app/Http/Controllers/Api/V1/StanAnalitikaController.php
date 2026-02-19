<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Concerns\AuthorizesZgradaAccess;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StanAnalitikaResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;

class StanAnalitikaController extends Controller
{
    use AuthorizesZgradaAccess;

    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request, int $zgradaId, int $stanId): StanAnalitikaResource
    {
        $this->authorizeZgradaAccess($request, $zgradaId);

        $analitika = $this->legacyApi->getStanAnalitika($zgradaId, $stanId);

        return new StanAnalitikaResource($analitika);
    }
}
