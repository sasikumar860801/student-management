<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = ['Mechanical', 'Computer', 'ECE', 'EEE', 'AI'];

    foreach ($departments as $department) {
        Department::create(['name' => $department]);
    }
    }
}
