<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Batchable;

class ProcessInsertBorder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected $border;

    /**
     * Create a new job instance.
     */
    public function __construct($border)
    {
        $this->border = $border;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::debug("border: " . $this->border);
    }
}
