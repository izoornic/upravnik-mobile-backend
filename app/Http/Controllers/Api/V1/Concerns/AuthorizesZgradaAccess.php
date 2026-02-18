<?php

namespace App\Http\Controllers\Api\V1\Concerns;

use Illuminate\Http\Request;

trait AuthorizesZgradaAccess
{
    protected function authorizeZgradaAccess(Request $request, int $zgradaId): void
    {
        if (! $request->user()->accessibleZgradaIds()->contains($zgradaId)) {
            abort(403, 'Nemate pristup ovoj zgradi.');
        }
    }
}
