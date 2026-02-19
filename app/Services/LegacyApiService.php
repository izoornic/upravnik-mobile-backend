<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LegacyApiService
{
    private string $baseUrl;

    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.legacy_api.url'), '/');
        $this->apiKey = config('services.legacy_api.key');
    }

    // --- Zgrade ---

    public function getZgrade(array $ids): Collection
    {
        return $this->getCollection('/zgrade', ['ids' => implode(',', $ids)]);
    }

    public function getZgradaIdsByUpravnikId(int $uid): Collection
    {
        $response = $this->request('GET', '/zgrada-ids', ['uid' => $uid]);

        return collect($response);
    }

    // --- Stanovi ---

    public function getStanoviByZgrada(int $zid): Collection
    {
        return $this->getCollection('/stanovi', ['zid' => $zid]);
    }

    public function getStan(int $zid, int $sid): object
    {
        $response = $this->request('GET', '/stanovi', ['zid' => $zid, 'sid' => $sid]);

        return (object) $response;
    }

    // --- Zaduzenja ---

    public function getVrsteZaduzenjaByZgrada(int $zid): Collection
    {
        return $this->getCollection('/vrste-zaduzenja', ['zid' => $zid]);
    }

    public function getStanZaduzenjaByZgrada(int $zid): Collection
    {
        return $this->getCollection('/stan-zaduzenja', ['zid' => $zid]);
    }

    public function getStanZaduzenje(int $id): object
    {
        $response = $this->request('GET', '/stan-zaduzenja', ['id' => $id]);

        return (object) $response;
    }

    public function recordPayment(int $id, array $data): object
    {
        $response = $this->request('PATCH', '/stan-zaduzenje-uplata', [], array_merge($data, ['id' => $id]));

        return (object) $response;
    }

    public function getZgradaZaduzenjaByZgrada(int $zid): Collection
    {
        return $this->getCollection('/zgrada-zaduzenja', ['zid' => $zid]);
    }

    // --- Racuni ---

    public function getRacuniByZgrada(int $zid): Collection
    {
        return $this->getCollection('/racuni', ['zid' => $zid]);
    }

    public function getRacunKomentariByZgrada(int $zid): Collection
    {
        return $this->getCollection('/racun-komentari', ['zid' => $zid]);
    }

    // --- Lookup ---

    public function getStanNamene(): Collection
    {
        return $this->getCollection('/stan-namene');
    }

    public function getFondovi(): Collection
    {
        return $this->getCollection('/fondovi');
    }

    public function getMeseci(): Collection
    {
        return $this->getCollection('/meseci');
    }

    // --- Dobavljaci ---

    public function getDobavljaci(): Collection
    {
        return $this->getCollection('/dobavljaci');
    }

    public function getDobavljac(int $id): object
    {
        $response = $this->request('GET', '/dobavljaci', ['id' => $id]);

        return (object) $response;
    }

    // --- Private helpers ---

    /**
     * Make a request and return the 'data' as a collection of stdClass objects.
     */
    private function getCollection(string $path, array $query = []): Collection
    {
        $data = $this->request('GET', $path, $query);

        return collect($data)->map(fn (array $item): object => (object) $item);
    }

    /**
     * Make an HTTP request to the legacy API.
     *
     * @return mixed
     *
     * @throws HttpException
     * @throws ConnectionException
     */
    private function request(string $method, string $path, array $query = [], array $body = [])
    {
        $url = $this->baseUrl.$path;

        $pending = Http::withHeaders(['X-Api-Key' => $this->apiKey])
            ->timeout(30);

        $response = match ($method) {
            'GET' => $pending->get($url, $query),
            'PATCH' => $pending->patch($url, $body),
            default => $pending->get($url, $query),
        };

        if ($response->status() === 404) {
            throw new NotFoundHttpException('Resource not found.');
        }

        if (! $response->successful()) {
            $error = $response->json('error') ?? 'Legacy API error';
            throw new HttpException($response->status(), $error);
        }

        return $response->json('data');
    }
}
