<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'Web Development', 'Mobile Development', 'Artificial Intelligence',
            'Data Science', 'Cyber Security', 'Internet of Things',
            'Game Development', 'Cloud Computing', 'Networking'
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }
    }
}
