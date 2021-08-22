<?php

namespace Human018\LaravelPatch\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ShouldPatchMigration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $class = class_basename($event->migration);
        $patch = 'App\Console\Commands\Patches\\' . $class . 'Patch';

        if (class_exists($patch)) {
            $command = Str::snake($class);
            Artisan::call('patch:' . $command, [
                '--method' => $event->method
            ]);
        }

    }
}
