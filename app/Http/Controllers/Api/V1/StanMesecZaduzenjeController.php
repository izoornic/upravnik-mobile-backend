<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Concerns\AuthorizesZgradaAccess;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RecordPaymentRequest;
use App\Http\Resources\V1\StanMesecZaduzenjeResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StanMesecZaduzenjeController extends Controller
{
    use AuthorizesZgradaAccess;

    public function __construct(private LegacyApiService $legacyApi) {}

    public function index(Request $request, int $zgradaId): AnonymousResourceCollection
    {
        $this->authorizeZgradaAccess($request, $zgradaId);

        $zaduzenja = $this->legacyApi->getStanZaduzenjaByZgrada($zgradaId);

        return StanMesecZaduzenjeResource::collection($zaduzenja);
    }

    public function recordPayment(RecordPaymentRequest $request, int $id): StanMesecZaduzenjeResource
    {
        $zaduzenje = $this->legacyApi->getStanZaduzenje($id);

        $this->authorizeZgradaAccess($request, $zaduzenje->zid);

        $updated = $this->legacyApi->recordPayment($id, $request->validated());

        return new StanMesecZaduzenjeResource($updated);
    }
}
