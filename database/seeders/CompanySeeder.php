<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Acme Corporation',
            'email' => 'info@acme.com',
            'address' => '123 Main St, Anytown, USA',
            'website' => 'https://www.acme.com',
        ]);

        Company::create([
            'name' => 'Globex Corporation',
            'email' => 'info@globex.com',
            'address' => '456 Business Ave, Somewhere, USA',
            'website' => 'https://www.globex.com',
        ]);

        Company::create([
            'name' => 'Initech',
            'email' => 'info@initech.com',
            'address' => '789 Office Park, Worktown, USA',
            'website' => 'https://www.initech.com',
        ]);
    }
} 