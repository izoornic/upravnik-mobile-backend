<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FondResource;
use App\Http\Resources\V1\MesecResource;
use App\Http\Resources\V1\StanNamenaResource;
use App\Services\LegacyApiService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LookupController extends Controller
{
    public function __construct(private LegacyApiService $legacyApi) {}

    public function stanNamene(): AnonymousResourceCollection
    {
        return StanNamenaResource::collection($this->legacyApi->getStanNamene());
    }

    public function fondovi(): AnonymousResourceCollection
    {
        return FondResource::collection($this->legacyApi->getFondovi());
    }

    public function meseci(): AnonymousResourceCollection
    {
        return MesecResource::collection($this->legacyApi->getMeseci());
    }
}
