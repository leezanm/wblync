<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DVV402411VideoProjectSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV402411')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV402411-PROJECT',
            'name' => 'Project',
            'description' => 'Project assessment for Video Production. CLO3: Display professionally the Behind The Scene project based on industrial project. PLO2, P4.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'Students are required to produce and present a professional Behind The Scene video covering production process and development, production techniques, aesthetic and narrative objectives, post-production applications and editing tools.',
            'max_score' => 20,
            'status' => true,
            'published_at' => now(),
        ]);

        $section = $version->sections()->create([
            'name' => 'Project Evaluation',
            'description' => 'Project rubric for the Video Production Behind The Scene project.',
            'sort_order' => 1,
        ]);

        $criteria = [
            [
                'name' => 'Production Process and Development',
                'description' => 'Ability to manage and execute the production process and development.',
                'max_score' => 4,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Demonstrates mastery of all stages of the production process, including efficient set preparation, directing, and capturing high-quality footage.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Proficiently executes all stages of the production process with minimal oversight, ensuring project objectives are met effectively.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Completes essential stages of the production process, but with occasional lapses in execution that impact project outcomes.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Struggles to execute key stages of the production process effectively, resulting in incomplete or poorly executed projects.',
                    ],
                ],
            ],

            [
                'name' => 'Production Techniques and Sound Recording',
                'description' => 'Application of production techniques and sound recording during production.',
                'max_score' => 4,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Implements advanced production techniques to achieve desired creative outcomes and enhance the visual and auditory elements of the project.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Applies a wide range of production techniques effectively to achieve project goals, with some limited experimentation or innovation.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Applies basic production techniques to execute the project, but with limited creativity or refinement in execution.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Struggles to apply production techniques effectively, resulting in minimal improvement to project quality or significant technical flaws.',
                    ],
                ],
            ],

            [
                'name' => 'Aesthetic and Narrative Objectives',
                'description' => 'Ability to evaluate and achieve the desired aesthetic and narrative objectives.',
                'max_score' => 4,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Critically evaluates the effectiveness of production techniques in achieving desired aesthetic and narrative objectives, providing insightful analysis and recommendations.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Provides thorough analysis of production processes and outcomes, identifying strengths and areas for improvement with clarity and coherence.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Offers basic evaluation of production workflows and outcomes, but with limited depth or critical insight.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Fails to provide meaningful evaluation of production processes or outcomes, demonstrating a lack of understanding or engagement with the material.',
                    ],
                ],
            ],

            [
                'name' => 'Post-Production Applications and Manipulations',
                'description' => 'Application of post-production techniques including editing, colour grading, sound design and visual effects.',
                'max_score' => 4,
                'sort_order' => 4,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Demonstrates mastery of post-production techniques, including video editing, colour grading, sound design, and visual effects, to create a polished and professional BTS video.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Applies a wide range of post-production techniques effectively to enhance the visual and auditory elements of the BTS video, producing a polished final edit.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Applies basic post-production techniques to improve the BTS video, but with limited creativity or refinement in execution.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Struggles to apply post-production techniques effectively, resulting in minimal improvement to the BTS video or significant technical flaws.',
                    ],
                ],
            ],

            [
                'name' => 'Editing Software and Tools',
                'description' => 'Effective use of editing software and tools for the BTS video.',
                'max_score' => 4,
                'sort_order' => 5,
                'ratings' => [
                    [
                        'score' => 4,
                        'label' => 'Very Good',
                        'description' => 'Utilizes advanced editing software and tools to achieve desired creative outcomes and enhance the storytelling of the BTS video.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Good',
                        'description' => 'Utilizes standard editing software and tools effectively to edit and refine the BTS video, demonstrating proficiency in post-production techniques.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Fair',
                        'description' => 'Attempts to use editing software and tools to edit the BTS video, but with limited proficiency or understanding of post-production techniques.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Unsatisfactory',
                        'description' => 'Struggles to use editing software and tools effectively, resulting in an unpolished or incomplete BTS video.',
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
