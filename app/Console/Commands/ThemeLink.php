<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ThemeLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "Themes" to "public/Themes"';

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
     * @return mixed
     */
    public function handle()
    {
			if (file_exists(public_path('Themes'))) {
				return $this->error('The "public/Themes" directory already exists.');
			}
			$this->laravel->make('files')->link(
				base_path('Themes'), public_path('Themes')
			);
			$this->info('The [public/Themes] directory has been linked.');
    }
}
