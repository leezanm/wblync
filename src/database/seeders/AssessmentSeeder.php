<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssessmentSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV40237')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV40237-DEMONSTRATION',
            'name' => 'Demonstration',
            'description' => 'Demonstration assessment for Sound Production. CLO2: Organize effectively in integration of the aesthetic and technical of audio systems in video production. PLO2, P4.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'Students are required to demonstrate various audio operation, set up and operate sound production equipment, explain audio style and equipment choices, demonstrate industry standards, and answer evaluator questions regarding decision-making and problem-solving.',
            'max_score' => 16,
            'status' => true,
            'published_at' => now(),
        ]);

        $section = $version->sections()->create([
            'name' => 'Demonstration',
            'description' => 'Rubric for the Sound Production Demonstration assessment.',
            'sort_order' => 1,
        ]);

        $criteria = [
            [
                'name' => 'Equipment Setup & Operation',
                'description' => 'Ability to set up and operate sound production equipment.',
                'max_score' => 4,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Efficiently sets up and operates equipment with no errors; demonstrates advanced technical skills.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Sets up and operates equipment correctly with minor errors; demonstrates good technical skills.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Requires assistance for setup and operation; demonstrates basic technical skills.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Struggles with setup and operation; lacks fundamental technical skills.',
                    ],
                ],
            ],

            [
                'name' => 'Understanding of Audio Styles',
                'description' => 'Ability to identify and apply appropriate audio styles.',
                'max_score' => 4,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Clearly identifies and applies appropriate audio styles with expert justification.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Identifies and applies appropriate audio styles with sound reasoning.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Shows limited understanding of audio styles with inconsistent application.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Struggles to identify and apply correct audio styles.',
                    ],
                ],
            ],

            [
                'name' => 'Professionalism & Industry Standards',
                'description' => 'Professional conduct, industry standards and communication.',
                'max_score' => 4,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Demonstrates high professionalism, follows all industry standards, and communicates effectively.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Maintains professionalism and adheres to most industry standards with effective communication.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Shows some professionalism but lacks consistency in following industry standards.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Lacks professionalism and fails to follow industry standards.',
                    ],
                ],
            ],

            [
                'name' => 'Troubleshooting & Problem-Solving',
                'description' => 'Ability to identify and resolve operational issues.',
                'max_score' => 4,
                'sort_order' => 4,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Quickly identifies and resolves issues independently with logical solutions.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Identifies and resolves most issues with minor assistance.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Struggles to identify and resolve issues; requires significant guidance.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Unable to troubleshoot effectively, leading to major operational issues.',
                    ],
                ],
            ],
        ];

        foreach ($criteria as $criterionData) {
            $ratings = $criterionData['ratings'];

            unset($criterionData['ratings']);

            $criterion = $section->criteria()->create([
                ...$criterionData,
                'is_required' => true,
            ]);

            foreach ($ratings as $rating) {
                $criterion->ratingLevels()->create([
                    ...$rating,
                    'sort_order' => 5 - $rating['score'],
                ]);
            }
        }
    }
}
