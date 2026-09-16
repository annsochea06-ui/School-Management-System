<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Admission;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        // 1. បង្កើត ឬ Update មុខវិជ្ជាទាំង ៨ 
        $web     = Subject::updateOrCreate(['code' => 'WEB'], ['name' => 'Web Development']);
        $mobile  = Subject::updateOrCreate(['code' => 'MOB'], ['name' => 'Mobile App']);
        $cyber   = Subject::updateOrCreate(['code' => 'SEC'], ['name' => 'Cyber Security']);
        $ai      = Subject::updateOrCreate(['code' => 'AIE'], ['name' => 'AI Engineer']);
        $uxui    = Subject::updateOrCreate(['code' => 'DES'], ['name' => 'UX/UI Design']);
        $dat     = Subject::updateOrCreate(['code' => 'DAT'], ['name' => 'Data Science']);
        $cloud   = Subject::updateOrCreate(['code' => 'CLD'], ['name' => 'Cloud Computing']);
        $network = Subject::updateOrCreate(['code' => 'NET'], ['name' => 'Network Engineering']);

        // 2. បញ្ចូលទិន្នន័យសិស្សគំរូចូល Web Development
        Admission::updateOrCreate(
            ['phone' => '012345678'],
            [
                'full_name'  => 'Keo Sokha',
                'gender'     => 'Male',
                'subject_id' => $web->id,
                'message'    => 'I want to study Laravel.',
            ]
        );

        Admission::updateOrCreate(
            ['phone' => '098765432'],
            [
                'full_name'  => 'Chan Thida',
                'gender'     => 'Female',
                'subject_id' => $web->id,
                'message'    => 'Interested in Frontend dev.',
            ]
        );
    }
}