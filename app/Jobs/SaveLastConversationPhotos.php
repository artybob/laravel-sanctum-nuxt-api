<?php

namespace App\Jobs;

use App\Http\Controllers\Socials\VkController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveLastConversationPhotos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vkController;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // need to be service
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $c = new VkController;
        $c->saveLastConversationPhotos();
    }
}
