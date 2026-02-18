<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Concerns\AuthorizesZgradaAccess;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RacunKomentarResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RacunKomentarController extends Controller
{
    use AuthorizesZgradaAccess;

    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request, int $zgradaId): AnonymousResourceCollection
    {
        $this->authorizeZgradaAccess($request, $zgradaId);

        $komentari = $this->legacyApi->getRacunKomentariByZgrada($zgradaId);

        return RacunKomentarResource::collection($komentari);
    }
}
