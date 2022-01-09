<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SaveLastConversationPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:save_last_conversation_photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SaveLastConversationPhotos dispatch';

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
        \App\Jobs\SaveLastConversationPhotos::dispatch();

        return Command::SUCCESS;
    }
}
