<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DVV40237SoundSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV40237')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV40237-PROJECT',
            'name' => 'Project',
            'description' => 'Project assessment for Sound Production. CLO3: Demonstrate effectively in integration of the aesthetic and technical of audio systems in video production. PLO8, A3.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'Students are required to work on the audio part of the Video Production project, including pre-production planning, production and sound capture, and post-production editing and audio enhancement.',
            'max_score' => 24,
            'status' => true,
            'published_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Individual Evaluation
        |--------------------------------------------------------------------------
        */

        $individualSection = $version->sections()->create([
            'name' => 'Individual Evaluation',
            'description' => 'Evaluation of the student individual contribution, technical execution and project documentation.',
            'sort_order' => 1,
        ]);

        $individualCriteria = [
            [
                'name' => 'Role-Specific Technical Execution',
                'description' => 'Technical execution and handling of the assigned role.',
                'max_score' => 4,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Flawless handling of assigned technical role.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Minor technical issues but overall effective.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Noticeable technical flaws.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Poor execution and setup.',
                    ],
                ],
            ],

            [
                'name' => 'Collaboration & Contribution',
                'description' => 'Student engagement, contribution and participation in the project.',
                'max_score' => 4,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Highly engaged, completes assigned tasks effectively.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Mostly engaged, some minor delays.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Inconsistent participation or effort.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Lack of contribution to the group.',
                    ],
                ],
            ],

            [
                'name' => 'Project Documentation & Reporting',
                'description' => 'Quality and completeness of project documentation and reporting.',
                'max_score' => 4,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Comprehensive and detailed project report.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Clear report with some minor missing details.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Basic report with noticeable gaps.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Incomplete or missing report.',
                    ],
                ],
            ],
        ];

        $this->createCriteria(
            $individualSection,
            $individualCriteria
        );

        /*
        |--------------------------------------------------------------------------
        | Group Evaluation
        |--------------------------------------------------------------------------
        */

        $groupSection = $version->sections()->create([
            'name' => 'Group Evaluation',
            'description' => 'Evaluation of the group project planning, aesthetic quality and post-production output.',
            'sort_order' => 2,
        ]);

        $groupCriteria = [
            [
                'name' => 'Pre-Production Planning',
                'description' => 'Quality of planning and preparation before production.',
                'max_score' => 4,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Comprehensive and well-structured plan.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Clear plan with minor gaps.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Basic plan with some missing details.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Lacks clarity and structure.',
                    ],
                ],
            ],

            [
                'name' => 'Aesthetic Quality',
                'description' => 'Quality, creativity and balance of the sound produced.',
                'max_score' => 4,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'High-quality, creative, and well-balanced sound.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Good audio quality with minor inconsistencies.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Acceptable sound but lacks creativity.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Unbalanced, unclear, or distracting audio.',
                    ],
                ],
            ],

            [
                'name' => 'Post-Production & Editing',
                'description' => 'Quality of audio mixing, editing and enhancement during post-production.',
                'max_score' => 4,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Excellent',
                        'description' => 'Professional-grade audio mixing and enhancement.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Good editing with slight issues.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Satisfactory',
                        'description' => 'Basic editing with noticeable flaws.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Needs Improvement',
                        'description' => 'Poorly mixed or unpolished sound.',
                    ],
                ],
            ],
        ];

        $this->createCriteria(
            $groupSection,
            $groupCriteria
        );
    }

    private function createCriteria($section, array $criteria): void
    {
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
