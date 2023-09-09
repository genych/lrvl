<?php

namespace App\Console\Commands;

use App\Services\HNService;
use Illuminate\Console\Command;

class FetchHNFeed extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-hn-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh feed from HN';

    /**
     * Execute the console command.
     */
    public function handle(HNService $service): void
    {
        $service->updateFeed();
    }
}
