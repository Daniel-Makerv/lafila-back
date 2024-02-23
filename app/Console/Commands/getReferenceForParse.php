<?php

namespace App\Console\Commands;

use App\Jobs\ProcessUpdateRefPointParse;
use Illuminate\Console\Command;

class getReferenceForParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-reference-for-parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ProcessUpdateRefPointParse::dispatch()->onQueue('bwt');
    }
}
