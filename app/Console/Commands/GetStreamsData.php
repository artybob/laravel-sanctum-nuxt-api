<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetStreamsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streams:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GetStreamsData dispatch';

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
        \App\Jobs\GetStreamsData::dispatch();

        return Command::SUCCESS;
    }
}
