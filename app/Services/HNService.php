<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Story;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Psr\Log\LoggerInterface;

class HNService
{
    const PAGE_SIZE = 30;

    public function __construct(
        private \GuzzleHttp\ClientInterface $client,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @return int[]
     */
    public function fetchFeed(): array
    {
        $raw = $this->fetchRaw('/v0/newstories.json');
        $raw = array_slice($raw, 0, self::PAGE_SIZE);
        $hnIds = array_filter($raw, is_int(...));

        return $hnIds;
    }

    /**
     * @param int $hnId
     * @return ?mixed[]
     */
    public function fetchStory(int $hnId): ?array
    {
        $raw = $this->fetchRaw("/v0/item/$hnId.json");

        $validator = Validator::make($raw, [
            'id' => "required|int",
            'title' => 'required|string|max:255',
            'time' => 'required|date_format:U',
            'score' => 'required|int',
            'url' => 'url|max:255', // optional
        ]);

        try {
            return $validator->validate();
        } catch (ValidationException $e) {
            $this->logger->error(implode('; ', Arr::flatten($e->errors())));
        }

        return null;
    }

    public function updateFeed(): void
    {
        $feed = $this->fetchFeed();
        $wannabeModels = [];
        foreach ($feed as $hnId) {
            $trashed = Story::onlyTrashed()->where('hn_id', $hnId)->first();
            if ($trashed) {
                continue;
            }

            $s = $this->fetchStory($hnId);
            if ($s === null) {
                continue;
            }

            $wannabeModels[] = [
                'hn_id' => $s['id'],
                'title' => $s['title'],
                'url' => $s['url'] ?? null,
                'points' => $s['score'],
                'created_at' => new \DateTimeImmutable('@'.$s['time']),
            ];
        }

        Story::upsert($wannabeModels, ['hn_id'], ['points']);
    }
    
    private function fetchRaw(string $path): array
    {
        $url = '';
        try {
            $base = $_ENV['HN_API_URL']
                ?? throw new \Exception('provide hacker news api url');
            $url = $base.$path;
            $response = $this->client->request('GET', $url);
            $raw = $response->getBody()->getContents();
            $body = json_decode($raw, true, JSON_THROW_ON_ERROR);

            if (!is_array($body)) {
                throw new \Exception("unexpected response: $raw");
            }

            return $body;
        } catch (\Throwable $e) {
            $this->logger->error("can't fetch $url: {$e->getMessage()}");

            return [];
        }
    }
}
