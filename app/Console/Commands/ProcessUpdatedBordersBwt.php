<?php

namespace App\Console\Commands;

use App\Helpers\BwtHelper\Border;
use App\Models\BWT;
use Illuminate\Console\Command;

class ProcessUpdatedBordersBwt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:update-border';

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
        Border::storeBorderWidthCords("70,37,38", 37);
    }
}
