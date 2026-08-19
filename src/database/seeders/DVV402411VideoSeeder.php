<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DVV402411VideoSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV402411')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV402411-COMPANY-APPRAISAL',
            'name' => 'Company Appraisal',
            'description' => 'Company Appraisal assessment for Video Production. CLO1: Demonstrate the essential production skills through technology for the industrial project Behind The Scene. PLO6, A3.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'Individual assessment requiring students to present ideas and elements of a behind-the-scenes video of a video production project while demonstrating understanding of production crew, production techniques and appreciation of quality work.',
            'max_score' => 24,
            'status' => true,
            'published_at' => now(),
        ]);

        $section = $version->sections()->create([
            'name' => 'Company Appraisal',
            'description' => 'Company Appraisal rubric for the Video Production industrial project.',
            'sort_order' => 1,
        ]);

        $criteria = [
            [
                'name' => 'Describe Content Knowledge',
                'description' => 'Understanding of essential production skills and their integration with technology.',
                'max_score' => 4,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Demonstrates a profound understanding of essential production skills and their integration with technology. Provides comprehensive examples and insightful analysis.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Shows a solid understanding of production skills and technology integration. Provides relevant examples and explanations.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Demonstrates a basic understanding of production skills and technology integration. Provides some examples but lacks depth or clarity.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Lacks understanding of production skills and technology integration. Examples are minimal or irrelevant.',
                    ],
                ],
            ],

            [
                'name' => 'Application of Skills',
                'description' => 'Application of production skills through technology in the Behind The Scene project.',
                'max_score' => 4,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Effectively applies production skills through technology in the context of the Behind The Scene project. Demonstrates innovative approaches and problem-solving abilities.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Applies production skills through technology appropriately in the context of the Behind The Scene project. Demonstrates competent execution and understanding of the tools used.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Attempts to apply production skills through technology in the context of the Behind The Scene project, but execution is inconsistent or lacks proficiency.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Struggles to apply production skills through technology effectively in the context of the Behind The Scene project. Demonstrates limited understanding or ability to use the tools.',
                    ],
                ],
            ],

            [
                'name' => 'Value Quality Work',
                'description' => 'Appreciation and commitment to quality and excellence in work.',
                'max_score' => 4,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Crew members consistently demonstrate a strong commitment to quality and excellence in their work.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Crew members express a genuine appreciation for the importance of quality work.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Crew members show some appreciation for quality work but lack consistency.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Crew members demonstrate little to no appreciation for the importance of quality work.',
                    ],
                ],
            ],

            [
                'name' => 'Seek Learning and Development Opportunities',
                'description' => 'Willingness to seek opportunities to improve skills and knowledge in video/film production.',
                'max_score' => 4,
                'sort_order' => 4,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Crew members actively seek opportunities to improve their skills and knowledge in video/film production.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Crew members are open to learning and development opportunities.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Crew members show some interest in learning but lack initiative.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Crew members resist learning and development opportunities.',
                    ],
                ],
            ],

            [
                'name' => 'Demonstrate Accountability',
                'description' => 'Responsibility and accountability for actions and contributions.',
                'max_score' => 4,
                'sort_order' => 5,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Crew members demonstrate a strong sense of responsibility and accountability for their actions and contributions.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Crew members take ownership of their roles and responsibilities.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Crew members occasionally demonstrate accountability but may deflect blame.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Crew members consistently fail to take responsibility for their actions.',
                    ],
                ],
            ],

            [
                'name' => 'Professionalism and Ethics',
                'description' => 'Professionalism and ethical conduct in interactions and work.',
                'max_score' => 4,
                'sort_order' => 6,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Crew members exhibit a high degree of professionalism and ethical conduct in their interactions and work.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Crew members adhere to professional standards and ethical guidelines.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Crew members demonstrate occasional lapses in professionalism or ethics.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Crew members consistently exhibit unprofessional or unethical behaviour.',
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
