<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MeiliSearch\Client;

class ScoutMeiliSearchSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:meilisearch-setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets various settings in meilisearch index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = config('scout.meilisearch.host');
        $client = new Client($url, config('scout.meilisearch.key'));
        $client->index('articles')->updateFilterableAttributes(['published', 'user_id']);
    }
}
