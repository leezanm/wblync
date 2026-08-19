<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DVV50256LightingSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV50256')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV50256-DEMONSTRATION',
            'name' => 'Demonstration',
            'description' => 'Demonstration assessment for Lighting Production. CLO3: Demonstrate effectively in integration of aesthetic and technical of lighting system in video production. PLO8, A3.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'Students are required to demonstrate both aesthetic and technical aspects of lighting systems for either an indoor or outdoor scene. Each group member is assessed individually based on contribution, technical understanding, role clarity and communication, while the group is assessed on the quality of lighting setup, creativity and visual outcome.',
            'max_score' => 40,
            'status' => true,
            'published_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Individual Assessment
        |--------------------------------------------------------------------------
        */

        $individualSection = $version->sections()->create([
            'name' => 'Individual Assessment',
            'description' => 'Individual assessment focusing on personal understanding, skills and involvement.',
            'sort_order' => 1,
        ]);

        $individualCriteria = [
            [
                'name' => 'Understanding of Lighting Concepts',
                'description' => 'Understanding of key, fill, back and set lighting techniques.',
                'max_score' => 5,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Explains all techniques (key, fill, back, set) with precision and depth.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Explains all techniques (key, fill, back, set) with good understanding.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Demonstrates satisfactory understanding of lighting techniques.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Demonstrates limited understanding of lighting techniques.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'Demonstrates no adequate understanding of lighting techniques.',
                    ],
                ],
            ],

            [
                'name' => 'Understanding of Lighting Effects',
                'description' => 'Understanding and justification of indoor and outdoor lighting effects.',
                'max_score' => 5,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Clearly distinguishes indoor and outdoor lighting, with strong justification.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Distinguishes lighting effects and provides good justification.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Understands lighting effects but provides weak justification.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Provides confused or unclear explanation of lighting effects.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'No understanding of lighting effects demonstrated.',
                    ],
                ],
            ],

            [
                'name' => 'Practical Execution',
                'description' => 'Ability to practically execute the lighting setup.',
                'max_score' => 5,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Confident, accurate, and efficient in lighting setup.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Setup completed effectively and correctly.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Setup performed with some guidance.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Needs frequent assistance.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'Did not participate or failed to execute the setup.',
                    ],
                ],
            ],

            [
                'name' => 'Role Justification & Reflection',
                'description' => 'Ability to explain personal role, decisions and learning.',
                'max_score' => 5,
                'sort_order' => 4,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Clearly articulates personal role, decisions, and learning.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Understands role and justifies decisions.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Shows basic awareness of role and actions.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Provides limited reflection.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'Shows no awareness or reflection.',
                    ],
                ],
            ],

            [
                'name' => 'Technical Communication',
                'description' => 'Quality of documentation and professional communication of the lighting design process.',
                'max_score' => 5,
                'sort_order' => 5,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Provides excellent comprehensive documentation clearly articulating the design process and options, accompanied by a professional presentation.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Provides thorough documentation that clearly articulates the design process and choices, accompanied by professional presentation.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Provides adequate documentation with a clear explanation of design choices; presentation is generally good.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Documentation is incomplete or unclear; presentation lacks professionalism.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'No documentation or poorly executed presentation fails to communicate the design process.',
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
        | Group Assessment
        |--------------------------------------------------------------------------
        */

        $groupSection = $version->sections()->create([
            'name' => 'Group Assessment',
            'description' => 'Group assessment focusing on final output, teamwork and creativity.',
            'sort_order' => 2,
        ]);

        $groupCriteria = [
            [
                'name' => 'Final Output Quality',
                'description' => 'Quality and effectiveness of the final lighting visual result.',
                'max_score' => 5,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Very high-quality visual result, well-lit and aesthetically strong.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Good quality result, clear and visually balanced.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Acceptable to good quality result, with some inconsistencies.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Weak visuals with inconsistent lighting.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'Unusable or poorly lit visuals.',
                    ],
                ],
            ],

            [
                'name' => 'Teamwork & Collaboration',
                'description' => 'Team collaboration, role division and mutual support.',
                'max_score' => 5,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Excellent collaboration, clear role division, and mutual support.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Good teamwork and task distribution.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Some members contributed more than others.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Minimal collaboration evident.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'No teamwork, individual work only.',
                    ],
                ],
            ],

            [
                'name' => 'Presentation & Documentation',
                'description' => 'Quality of presentation and supporting documentation.',
                'max_score' => 5,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Very clear, well-designed, and informative.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Good documentation and presentation.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Satisfactory',
                        'description' => 'Basic but acceptable.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Needs Improvement',
                        'description' => 'Disorganized or incomplete.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Inadequate',
                        'description' => 'No documentation or presentation provided.',
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
                    'sort_order' => 6 - $rating['score'],
                ]);
            }
        }
    }
}
