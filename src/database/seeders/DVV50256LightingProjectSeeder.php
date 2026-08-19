<?php

namespace Database\Seeders;

use App\Models\AssessmentTemplate;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DVV50256LightingProjectSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('code', 'DVV50256')->firstOrFail();

        $template = AssessmentTemplate::create([
            'uuid' => (string) Str::uuid(),
            'course_id' => $course->id,
            'code' => 'DVV50256-PROJECT',
            'name' => 'Project',
            'description' => 'Project assessment for Lighting Production. CLO2: Organize the operation of various lighting styles and important types of equipment in video production. PLO2, P4.',
            'assessor_type' => 'INDUSTRY_MENTOR',
            'status' => true,
        ]);

        $version = $template->versions()->create([
            'version' => 1,
            'name' => 'Version 1',
            'instructions' => 'Students are required to demonstrate the operation of various lighting styles and important types of lighting equipment in video production through technical skills, knowledge, safety practices, communication, problem solving and teamwork.',
            'max_score' => 45,
            'status' => true,
            'published_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Individual
        |--------------------------------------------------------------------------
        */

        $individualSection = $version->sections()->create([
            'name' => 'Individual',
            'description' => 'Individual assessment of technical skill, knowledge, safety, communication, problem solving and contribution.',
            'sort_order' => 1,
        ]);

        $individualCriteria = [
            [
                'name' => 'Lighting Instrument / Technical Skill & Knowledge',
                'description' => 'Ability to handle lighting fixtures and electrical setup with appropriate technical skill and knowledge.',
                'max_score' => 5,
                'sort_order' => 1,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Demonstrates outstanding mastery in handling lighting fixtures and electrical setup with high precision and industry-level execution.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Shows strong technical handling with minor mistakes; demonstrates good understanding.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Basic understanding shown; skills applied are functional but limited.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Struggles with application; frequent technical errors present.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'Lacks understanding or cannot apply technical skills at all.'],
                ],
            ],

            [
                'name' => 'Knowledge of Lighting Fixture Types',
                'description' => 'Understanding of different lighting fixture types and their appropriate application.',
                'max_score' => 5,
                'sort_order' => 2,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Demonstrates in-depth understanding of all lighting fixture types and justifies their application accurately in context.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Understands most fixture types; provides general rationale for usage.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Basic awareness of fixture types; rationale is vague or inconsistent.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Limited understanding; confusion between types or misapplied in context.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No understanding of lighting types; incorrect or no usage justification.'],
                ],
            ],

            [
                'name' => 'Safety Awareness & Application',
                'description' => 'Application of safety protocols when handling lighting and electrical equipment.',
                'max_score' => 5,
                'sort_order' => 3,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Consistently applies safety protocols with zero errors; anticipates hazards and mitigates them effectively.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Follows safety procedures with some reminders; understands risk control.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Applies basic safety but misses key elements.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Rarely follows safety protocols; risky practices observed.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No awareness of safety; procedures ignored.'],
                ],
            ],

            [
                'name' => 'Communication & Explanation',
                'description' => 'Ability to explain lighting setup, concepts and technical decisions clearly.',
                'max_score' => 5,
                'sort_order' => 4,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Explains setup and concepts clearly, confidently, and concisely, both on-camera and in written documentation.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Clear explanation with minor gaps; mostly confident.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Basic explanations but lacks depth and clarity.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Unclear or limited explanation of work.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No explanation or irrelevant content.'],
                ],
            ],

            [
                'name' => 'Problem Solving & Adaptability',
                'description' => 'Ability to solve technical issues and adapt plans during production.',
                'max_score' => 5,
                'sort_order' => 5,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Shows initiative and quick-thinking in solving technical issues; adjusts plans effectively when problems arise.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Addresses issues with guidance; shows effort to adapt.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Attempts solutions but needs support; adapts slowly.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Struggles to solve problems; depends heavily on others.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No attempt to solve problems or adapt.'],
                ],
            ],

            [
                'name' => 'Individual Contribution & Effort',
                'description' => 'Individual responsibility, participation and effort throughout the project.',
                'max_score' => 5,
                'sort_order' => 6,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Takes lead role in planning and execution; shows full responsibility and proactive engagement throughout the project.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Contributes consistently with effort and teamwork.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Participates moderately; effort inconsistent.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Minimal contribution; mostly passive.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No visible contribution.'],
                ],
            ],
        ];

        $this->createCriteria($individualSection, $individualCriteria);

        /*
        |--------------------------------------------------------------------------
        | Grouping
        |--------------------------------------------------------------------------
        */

        $groupSection = $version->sections()->create([
            'name' => 'Grouping',
            'description' => 'Group assessment of planning, visual communication, collaboration and output quality.',
            'sort_order' => 2,
        ]);

        $groupCriteria = [
            [
                'name' => 'Group Planning & Coordination',
                'description' => 'Planning, coordination and shared decision-making throughout the setup.',
                'max_score' => 5,
                'sort_order' => 1,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Demonstrates effective planning, smooth coordination, and shared decision-making throughout the setup.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Good planning with slight gaps in coordination.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Moderate planning; roles are unclear.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Poor coordination; most tasks are unassigned or rushed.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No planning or teamwork evident.'],
                ],
            ],

            [
                'name' => 'Visual Communication (Slide/Diagram)',
                'description' => 'Quality, clarity and technical accuracy of visual communication materials.',
                'max_score' => 5,
                'sort_order' => 2,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'Materials are clear, visually impactful, and professionally presented with technical accuracy.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Slide/diagram is clear with good design but minor inconsistencies.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Basic visuals with limited clarity.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Visuals are poorly organized or hard to follow.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No visuals or irrelevant materials.'],
                ],
            ],

            [
                'name' => 'Team Collaboration & Output Quality',
                'description' => 'Team collaboration, equal contribution and quality of the final product.',
                'max_score' => 5,
                'sort_order' => 3,
                'ratings' => [
                    ['score' => 5, 'label' => 'Excellent', 'description' => 'All members contribute equally; final product reflects high synergy, effort, and polish.'],
                    ['score' => 4, 'label' => 'Good', 'description' => 'Most members contribute; output is cohesive.'],
                    ['score' => 3, 'label' => 'Satisfactory', 'description' => 'Uneven participation; final product lacks unity.'],
                    ['score' => 2, 'label' => 'Needs Improvement', 'description' => 'Minimal collaboration; unpolished result.'],
                    ['score' => 1, 'label' => 'Inadequate', 'description' => 'No collaboration; poor final output.'],
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
