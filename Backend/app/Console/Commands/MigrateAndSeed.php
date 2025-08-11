<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MigrateAndSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-and-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations and seeders and log the results';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration and seeding process...');
        
        try {
            // Test database connection
            DB::connection()->getPDO();
            $this->info('Database connected: ' . DB::connection()->getDatabaseName());
            
            // Run migrations
            $this->info('Running migrations...');
            Artisan::call('migrate:fresh', ['--force' => true]);
            $this->info('Migrations completed.');
            
            // Run seeders
            $this->info('Running seeders...');
            Artisan::call('db:seed', ['--force' => true]);
            $this->info('Seeding completed.');
            
            $this->info('All done!');
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
