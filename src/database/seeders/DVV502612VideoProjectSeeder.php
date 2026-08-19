<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DVV502612VideoProjectSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV502612')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV502612-PROJECT',
            'name' => 'Project',
            'description' => 'Project assessment for Video Media Project. CLO3: Display professional elements of cinematography and technical aspects in video/film. P4, PLO2.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'This is a group assignment. Students must form a group of four members and produce one video product. The project must showcase professional cinematography elements and technical aspects throughout production and editing. The final video must be properly edited and uploaded to YouTube.',
            'max_score' => 55,
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
            'description' => 'Individual assessment of cinematography, lighting, sound and editing techniques.',
            'sort_order' => 1,
        ]);

        $individualCriteria = [
            [
                'name' => 'Camera Handling and Technique',
                'description' => 'Application of shot, camera movement, camera angle, camera control and camera fault prevention.',
                'max_score' => 5,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Excellent justification. Demonstrates effective knowledge in applying and organizing shot, camera movement and camera angle according to cinema language. Good camera adjustment and prevention of camera faults. Camera controlling is excellent and camera components are fully utilized.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Good application and organization of shot, camera movement and camera angle according to cinema language. Good camera adjustment, prevention of camera faults and responsiveness.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Adequate application and organization of shot, camera movement and camera angle according to cinema language. Adequate camera control and response to camera faults.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Basic application of shot, camera movement and camera angle using cinema language. Basic understanding in controlling camera and preventing camera faults.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Limited application of shot, camera movement and camera angle. Limited understanding in controlling camera and preventing camera faults.',
                    ],
                ],
            ],

            [
                'name' => 'Lighting Handling and Technique',
                'description' => 'Application of lighting techniques and ability to differentiate lighting schemes for specific purposes.',
                'max_score' => 5,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Best application of lighting, able to differentiate lighting schemes for specific purposes. Good application in setting the lighting and able to differentiate the lighting purpose.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Proper lighting is used to eliminate shadows and glares. All scenes have sufficient lighting and lighting is used for purpose.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Additional lighting is used. Few shadows or glares are apparent. Some scenes have sufficient lighting and lighting is used for purpose.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Some scenes are too dark or too light to determine what is happening. Only natural light is used.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Most scenes are too dark or too light to determine what is happening. Basic application in setting the lighting to shoot.',
                    ],
                ],
            ],

            [
                'name' => 'Sound Design',
                'description' => 'Quality, balance, synchronization and creative use of sound.',
                'max_score' => 5,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Sound design is exceptional, with precise attention to detail in dialogue clarity, ambient sounds, and immersive soundscapes that elevate the film to a new level.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Sound design enhances the viewing experience, immersing the audience in the world of the film. Dialogue is clear and sound effects are impactful.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Sound design is well-balanced, with clear dialogue, appropriate levels, and effective use of sound effects.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Sound quality is acceptable, but some elements may be inconsistent or lack clarity.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Sound quality is poor, with background noise or inconsistent levels. Audio is distracting or detracts from the viewing experience.',
                    ],
                ],
            ],

            [
                'name' => 'Adherence to Format Guidelines',
                'description' => 'Adherence to technical format requirements including aspect ratio, resolution and duration.',
                'max_score' => 5,
                'sort_order' => 4,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Fully adheres to all technical format requirements precisely.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Format is mostly followed with only minimal issues.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Basic format followed with minor errors.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Format inconsistently followed; several technical errors.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Does not follow format at all; major technical issues present.',
                    ],
                ],
            ],

            [
                'name' => 'Continuity and Visual Flow',
                'description' => 'Logical sequencing and smooth visual transitions.',
                'max_score' => 5,
                'sort_order' => 5,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Excellent visual continuity; seamless and professional flow.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Smooth flow with minimal disruptions to viewer experience.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Acceptable flow with occasional breaks in continuity.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Inconsistent transitions; some scenes are confusing.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Very poor continuity; jarring cuts and illogical sequencing.',
                    ],
                ],
            ],

            [
                'name' => 'Audio Synchronization and Integration',
                'description' => 'Synchronization of dialogue, sound effects and music with visuals.',
                'max_score' => 5,
                'sort_order' => 6,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Audio perfectly synced and enhances storytelling effectively.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Audio is well synced and supports the visuals.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Audio is generally synced with minor lapses.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Noticeable sync issues; sound is poorly integrated.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Audio is poorly synced or disconnected from visuals.',
                    ],
                ],
            ],

            [
                'name' => 'Use of Transitions and Effects',
                'description' => 'Use of cuts, fades, dissolves, graphics and other effects.',
                'max_score' => 5,
                'sort_order' => 7,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Transitions and effects are polished, seamless, and enhance the narrative.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Good variety of transitions used creatively and relevantly.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Basic transitions used appropriately.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Overused or mismatched transitions and effects.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'No transitions used or inappropriate usage that distracts.',
                    ],
                ],
            ],

            [
                'name' => 'Consistency in Style and Tone',
                'description' => 'Visual unity, colour grading and maintenance of mood and tone.',
                'max_score' => 5,
                'sort_order' => 8,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Strong, cohesive visual style and tone maintained throughout.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Consistent editing style that supports the narrative.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Some consistency in style; tone mostly maintained.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Style and tone vary significantly and feel disjointed.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'No clear visual style; inconsistent tone throughout.',
                    ],
                ],
            ],
        ];

        $this->createCriteria($individualSection, $individualCriteria);

        /*
        |--------------------------------------------------------------------------
        | Group Assessment
        |--------------------------------------------------------------------------
        */

        $groupSection = $version->sections()->create([
            'name' => 'Group Assessment',
            'description' => 'Group assessment of production readiness, talent walk-through and scene composition.',
            'sort_order' => 2,
        ]);

        $groupCriteria = [
            [
                'name' => 'Fixing the Technical Equipment',
                'description' => 'Camera, lighting and audio setup readiness.',
                'max_score' => 5,
                'sort_order' => 1,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Equipment is set up flawlessly, fully optimized and production-ready.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Equipment is mostly well set up with minor improvements needed.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Equipment is set up adequately but not fully optimized.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Equipment setup is unstable or poorly positioned.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Equipment is poorly set up and causes major disruptions.',
                    ],
                ],
            ],

            [
                'name' => 'Fixing the Talent Walk-Through',
                'description' => 'Blocking, actor movement clarity and positioning.',
                'max_score' => 5,
                'sort_order' => 2,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Walk-through is highly effective; movement is clean, precise, and aligns well with camera and scene.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Talent walk-through is mostly smooth and coherent.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Walk-through is done with basic clarity; some adjustments needed.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Blocking is unclear or inconsistent and disrupts camera framing.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'No clear walk-through; talents appear lost or confused.',
                    ],
                ],
            ],

            [
                'name' => 'Shaping the Scene',
                'description' => 'Framing, spacing, visual arrangement and mise-en-scène.',
                'max_score' => 5,
                'sort_order' => 3,
                'ratings' => [
                    [
                        'score' => 5,
                        'label' => 'Excellent',
                        'description' => 'Scene is visually strong, well-composed and supports mood, tone and narrative.',
                    ],
                    [
                        'score' => 4,
                        'label' => 'Good',
                        'description' => 'Scene is well-shaped with effective spatial planning.',
                    ],
                    [
                        'score' => 3,
                        'label' => 'Adequate',
                        'description' => 'Basic scene layout achieved with some visual cohesion.',
                    ],
                    [
                        'score' => 2,
                        'label' => 'Basic',
                        'description' => 'Visuals are cluttered or unbalanced and distract from the story.',
                    ],
                    [
                        'score' => 1,
                        'label' => 'Limited',
                        'description' => 'Scene lacks structure with poor composition and spatial awareness.',
                    ],
                ],
            ],
        ];

        $this->createCriteria($groupSection, $groupCriteria);
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
