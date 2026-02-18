<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TekuciRacunResource;
use App\Http\Resources\V1\ZgradaDobavljacResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DobavljacController extends Controller
{
    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(): AnonymousResourceCollection
    {
        return ZgradaDobavljacResource::collection($this->legacyApi->getDobavljaci());
    }

    public function tekuciRacuni(int $id): AnonymousResourceCollection
    {
        $dobavljac = $this->legacyApi->getDobavljac($id);

        return TekuciRacunResource::collection($dobavljac->tekuci_racuni ?? []);
    }
}
