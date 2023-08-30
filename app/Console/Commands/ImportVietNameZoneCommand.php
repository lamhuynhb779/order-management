<?php

namespace App\Console\Commands;

use App\Imports\VienamZoneImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportVietNameZoneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vietnamzone:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'VietNam Zone Import';

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
     */
    public function handle()
    {
        if (file_exists(storage_path('vnzone.xls'))) {
            $tmpFile = storage_path('vnzone.xls');
        } else {
            $tmpFile = realpath(__DIR__.'/../../../database/vnzone.xls');
        }

        $this->info('Importing...');
        $this->info($tmpFile);

        Excel::import(new VienamZoneImport(), $tmpFile);

        $this->info('Completed');
    }
}
