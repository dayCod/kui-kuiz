<?php

namespace Database\Seeders;

use App\Models\AsmntSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Traits\UserLogging;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    use UserLogging;

    /*
    |--------------------------------------------------------------------------
    | Run Seeders
    |--------------------------------------------------------------------------
    */
    public function run()
    {
        $this->command->info('Creating sample data...');

        $bar = $this->command->getOutput()->createProgressBar(2);
        $bar->setFormat('verbose');

        // Start Progress
        $bar->start();

        // User Admin Seeds
        $this->userAdminSeed();
        $bar->advance();

        // Assessment Setting Seeds
        $this->assessmentSettingSeed();
        $bar->advance();

        // End Progress
        $bar->finish();

        $this->command->info('');
        $this->command->info('Sample data created.');
    }

    /*
    |--------------------------------------------------------------------------
    | User Admin Seeder
    |--------------------------------------------------------------------------
    */
    private function userAdminSeed()
    {

        if (User::where('role', 'admin')->count() == 0) {

            $insert = User::create([
                'uuid' => Str::uuid(),
                'name' => 'Admin System',
                'email' => 'user@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ]);

            $this->registLog($insert['id']);

            return $insert;
        } else { return true; }


    }

    /*
    |--------------------------------------------------------------------------
    | Assessment Setting Seeder
    |--------------------------------------------------------------------------
    */
    private function assessmentSettingSeed()
    {
        if (AsmntSetting::count() > 0) AsmntSetting::delete();

        $insert = AsmntSetting::insert([
            ['uuid' => Str::uuid(), 'asmnt_type' => 'score', 'check_type' => 'auto'],
            ['uuid' => Str::uuid(), 'asmnt_type' => 'corrections', 'check_type' => 'auto'],
        ]);

        return $insert;
    }
}
