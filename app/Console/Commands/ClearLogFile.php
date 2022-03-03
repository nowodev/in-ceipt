<?php

namespace App\Console\Commands;

use Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the laravel.log file';

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
        $files = Arr::where(Storage::disk('log')->files(), function($filename) {
            return Str::endsWith($filename,'.log');
        });

        $count = count($files);

        if(Storage::disk('log')->delete($files)) {
            $this->info(sprintf('Deleted %s %s!', $count, Str::plural('file', $count)));
        } else {
            $this->error('Error in deleting log files!');
        }
    }
}
