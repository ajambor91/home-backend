<?php

namespace App\Console\Commands;

use App\Repositories\AppRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddAppUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @param AppRepository $appRepository
     * @return int
     */
    public function handle(AppRepository $appRepository)
    {
        try {
            $appRepository->addApp();
        }catch (\Exception $exception){
            Log::critical( 'app not added',[$exception]);
            return false;
        };
        return true;
    }
}
