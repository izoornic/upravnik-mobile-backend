<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Concerns\AuthorizesZgradaAccess;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MesecZgradaZaduzenjeResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MesecZgradaZaduzenjeController extends Controller
{
    use AuthorizesZgradaAccess;

    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request, int $zgradaId): AnonymousResourceCollection
    {
        $this->authorizeZgradaAccess($request, $zgradaId);

        $zaduzenja = $this->legacyApi->getZgradaZaduzenjaByZgrada($zgradaId);

        return MesecZgradaZaduzenjeResource::collection($zaduzenja);
    }
}
