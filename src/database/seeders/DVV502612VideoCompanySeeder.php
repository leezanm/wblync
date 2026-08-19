<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DVV502612VideoCompanySeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV502612')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV502612-COMPANY-APPRAISAL',
            'name' => 'Company Appraisal',
            'description' => 'Company Appraisal assessment for Video Media Project. CLO3: Demonstrate integrated marketing communication in promoting the video/film presentation to the public. A3, PLO7.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'Students are required to demonstrate integrated marketing communication activities to promote their creative digital product on platforms such as TikTok, YouTube, Instagram and other suitable platforms.',
            'max_score' => 15,
            'status' => true,
            'published_at' => now(),
        ]);

        $section = $version->sections()->create([
            'name' => 'Company Appraisal',
            'description' => 'Assessment of integrated marketing communication, audience engagement and work ethics in promoting the video/film presentation.',
            'sort_order' => 1,
        ]);

        $criteria = [
            [
                'name' => 'Adherence to Goals and Strategy',
                'description' => 'Alignment of the promotional activities with overarching goals, strategy and product identity.',
                'max_score' => 5,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => '5',
                        'description' => 'Fully aligned with goals and strategy, consistent with product identity.',
                    ],
                    [
                        'score' => 4,
                        'label' => '4',
                        'description' => 'Mostly aligned with overarching goals and strategy, generally consistent with product identity.',
                    ],
                    [
                        'score' => 3,
                        'label' => '3',
                        'description' => 'Somewhat aligned with overarching goals and strategy, with some inconsistencies in product identity.',
                    ],
                    [
                        'score' => 2,
                        'label' => '2',
                        'description' => 'Limited alignment with overarching goals and strategy. Inconsistencies with product identity.',
                    ],
                    [
                        'score' => 1,
                        'label' => '1',
                        'description' => 'No alignment with overarching goals and strategy. No product identity.',
                    ],
                ],
            ],

            [
                'name' => 'Promoting and Engagement',
                'description' => 'Ability to promote the digital product and generate audience engagement through likes, reactions, comments, shares and interaction.',
                'max_score' => 5,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => '5',
                        'description' => 'Generate high level of audience engagement with significant likes, reactions, comments, shares and overall interaction. Has a substantial impact in raising content awareness.',
                    ],
                    [
                        'score' => 4,
                        'label' => '4',
                        'description' => 'Generate good level of audience engagement with significant likes, reactions, comments, shares and overall interaction. Has a good impact in raising content awareness.',
                    ],
                    [
                        'score' => 3,
                        'label' => '3',
                        'description' => 'Engages the audience reasonably well with moderate level of likes, reactions, comments, shares and interaction. Has a moderate impact in raising content awareness.',
                    ],
                    [
                        'score' => 2,
                        'label' => '2',
                        'description' => 'Has limited audience engagement with few likes, reactions, comments, shares and interaction. Has a limited impact in raising content awareness.',
                    ],
                    [
                        'score' => 1,
                        'label' => '1',
                        'description' => 'Fails to generate audience engagement with minimal likes, reactions, comments, shares and interaction. Has little to no impact in raising content awareness.',
                    ],
                ],
            ],

            [
                'name' => 'Work Ethics',
                'description' => 'Professional and ethical working culture when creating and promoting video content.',
                'max_score' => 5,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => '5',
                        'description' => 'Always practice excellent working culture such as good moral, good ethical in creating content and response in promoting video in all situations.',
                    ],
                    [
                        'score' => 4,
                        'label' => '4',
                        'description' => 'Practice good working culture such as good moral, good ethical in creating content and response in promoting video in most situations.',
                    ],
                    [
                        'score' => 3,
                        'label' => '3',
                        'description' => 'Practice good working culture such as good behavior, good ethical in creating content and response in promoting video in general.',
                    ],
                    [
                        'score' => 2,
                        'label' => '2',
                        'description' => 'Practice less appropriate working culture such as inconsistent behavior, less ethical in creating content and response in promoting video in many situations.',
                    ],
                    [
                        'score' => 1,
                        'label' => '1',
                        'description' => 'Practice inappropriate working culture such as bad behavior, no ethical in creating content and response in promoting video in all situation.',
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
                    'sort_order' => 6 - $rating['score'],
                ]);
            }
        }
    }
}
