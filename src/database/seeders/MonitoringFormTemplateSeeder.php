<?php

namespace Database\Seeders;

use App\Models\MonitoringFormItem;
use App\Models\MonitoringFormOption;
use App\Models\MonitoringFormSection;
use App\Models\MonitoringFormTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MonitoringFormTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $template = MonitoringFormTemplate::updateOrCreate(
            [
                'name' => 'Borang Lawatan Penyeliaan Work-Based Learning',
                'version' => 1,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'status' => 'Active',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Section 1
        |--------------------------------------------------------------------------
        */

        $bookLog = MonitoringFormSection::updateOrCreate(
            [
                'template_id' => $template->id,
                'section_key' => 'book_log',
            ],
            [
                'section_no' => 1,
                'title' => 'SEMAKAN BUKU LOG',
                'sort_order' => 1,
            ]
        );

        $this->createRatingItem(
            $bookLog,
            'writing_clarity',
            'Kejelasan Penulisan',
            [
                [
                    'key' => 'very_weak',
                    'label' => 'Sangat Lemah',
                    'description' => 'Tidak boleh menulis idea dengan jelas dan tidak kemaskini serta tidak disemak oleh penyelia industri.',
                ],
                [
                    'key' => 'weak',
                    'label' => 'Lemah',
                    'description' => 'Boleh menulis idea dengan jelas, memerlukan penambahbaikan lanjut dan tidak kemaskini pada setiap hari serta disemak oleh penyelia industri.',
                ],
                [
                    'key' => 'satisfactory',
                    'label' => 'Memuaskan',
                    'description' => 'Boleh menulis idea dengan jelas, memerlukan sedikit penambahbaikan dan kemaskini pada setiap hari serta disemak oleh penyelia industri.',
                ],
                [
                    'key' => 'good',
                    'label' => 'Baik',
                    'description' => 'Boleh menulis idea dengan jelas dan kemaskini pada setiap hari serta disemak oleh penyelia industri.',
                ],
                [
                    'key' => 'very_good',
                    'label' => 'Sangat Baik',
                    'description' => 'Boleh menulis idea dengan sangat jelas dan kemaskini pada setiap hari serta disemak oleh penyelia industri.',
                ],
            ],
            1
        );

        $this->createRatingItem(
            $bookLog,
            'systematic_writing',
            'Penulisan yang Sistematik',
            [
                [
                    'key' => 'very_weak',
                    'label' => 'Sangat Lemah',
                    'description' => 'Tidak boleh menulis idea dengan sistematik.',
                ],
                [
                    'key' => 'weak',
                    'label' => 'Lemah',
                    'description' => 'Boleh menulis idea dengan sistematik dan memerlukan penambahbaikan lanjut.',
                ],
                [
                    'key' => 'satisfactory',
                    'label' => 'Memuaskan',
                    'description' => 'Boleh menulis idea dengan sistematik dan memerlukan sedikit penambahbaikan.',
                ],
                [
                    'key' => 'good',
                    'label' => 'Baik',
                    'description' => 'Boleh menulis idea dengan sistematik.',
                ],
                [
                    'key' => 'very_good',
                    'label' => 'Sangat Baik',
                    'description' => 'Boleh menulis idea dengan sangat sistematik.',
                ],
            ],
            2
        );

        /*
        |--------------------------------------------------------------------------
        | Section 2
        |--------------------------------------------------------------------------
        */

        $taskProgress = MonitoringFormSection::updateOrCreate(
            [
                'template_id' => $template->id,
                'section_key' => 'task_progress',
            ],
            [
                'section_no' => 2,
                'title' => 'PEMERHATIAN TERHADAP KEMAJUAN PELAKSANAAN TUGAS YANG DIBERIKAN',
                'sort_order' => 2,
            ]
        );

        $rating = [
            [
                'key' => 'very_weak',
                'label' => 'Sangat Lemah',
            ],
            [
                'key' => 'weak',
                'label' => 'Lemah',
            ],
            [
                'key' => 'satisfactory',
                'label' => 'Memuaskan',
            ],
            [
                'key' => 'good',
                'label' => 'Baik',
            ],
            [
                'key' => 'very_good',
                'label' => 'Sangat Baik',
            ],
        ];

        $this->createRatingItem(
            $taskProgress,
            'task_ability',
            'Kebolehan Melaksanakan Tugas',
            [
                [
                    'key' => 'very_weak',
                    'label' => 'Sangat Lemah',
                    'description' => 'Tidak mampu menyelesaikan tugasan.',
                ],
                [
                    'key' => 'weak',
                    'label' => 'Lemah',
                    'description' => 'Mampu menyelesaikan kurang sebahagian tugas dengan bimbingan.',
                ],
                [
                    'key' => 'satisfactory',
                    'label' => 'Memuaskan',
                    'description' => 'Mampu menyelesaikan lebih sebahagian tugasan tanpa bimbingan.',
                ],
                [
                    'key' => 'good',
                    'label' => 'Baik',
                    'description' => 'Mampu menyelesaikan hampir keseluruhan tugasan dengan bimbingan.',
                ],
                [
                    'key' => 'very_good',
                    'label' => 'Sangat Baik',
                    'description' => 'Mampu menyelesaikan keseluruhan tugasan tanpa bimbingan.',
                ],
            ],
            1
        );

        $this->createRatingItem(
            $taskProgress,
            'attendance',
            'Kehadiran',
            [
                [
                    'key' => 'very_weak',
                    'label' => 'Sangat Lemah',
                    'description' => 'Tidak hadir ke industri WBL tanpa sebab yang munasabah.',
                ],
                [
                    'key' => 'weak',
                    'label' => 'Lemah',
                    'description' => 'Kerap / lebih dari seminggu tidak hadir ke industri WBL dengan sebab munasabah.',
                ],
                [
                    'key' => 'satisfactory',
                    'label' => 'Memuaskan',
                    'description' => 'Kurang dari seminggu tidak hadir ke industri WBL dengan sebab munasabah.',
                ],
                [
                    'key' => 'good',
                    'label' => 'Baik',
                    'description' => 'Kurang dari tiga hari tidak hadir ke industri WBL dengan sebab munasabah.',
                ],
                [
                    'key' => 'very_good',
                    'label' => 'Sangat Baik',
                    'description' => 'Kehadiran yang sangat baik ke industri WBL.',
                ],
            ],
            2
        );

        $this->createRatingItem(
            $taskProgress,
            'discipline',
            'Disiplin',
            [
                [
                    'key' => 'very_weak',
                    'label' => 'Sangat Lemah',
                    'description' => 'Tidak mempunyai disiplin dan daya usaha dalam menyiapkan tugasan.',
                ],
                [
                    'key' => 'weak',
                    'label' => 'Lemah',
                    'description' => 'Mempunyai disiplin dan daya usaha yang sedikit dalam menyiapkan tugasan.',
                ],
                [
                    'key' => 'satisfactory',
                    'label' => 'Memuaskan',
                    'description' => 'Mempunyai disiplin dan daya usaha yang memuaskan dalam menyiapkan tugasan.',
                ],
                [
                    'key' => 'good',
                    'label' => 'Baik',
                    'description' => 'Mempunyai disiplin dan daya usaha yang baik dalam menyiapkan tugasan.',
                ],
                [
                    'key' => 'very_good',
                    'label' => 'Sangat Baik',
                    'description' => 'Mempunyai disiplin dan daya usaha yang sangat baik dalam menyiapkan tugasan.',
                ],
            ],
            3
        );

        /*
        |--------------------------------------------------------------------------
        | Section 3
        |--------------------------------------------------------------------------
        */

        $courseMonitoring = MonitoringFormSection::updateOrCreate(
            [
                'template_id' => $template->id,
                'section_key' => 'course_monitoring',
            ],
            [
                'section_no' => 3,
                'title' => 'PEMANTAUAN UMUM KURSUS',
                'sort_order' => 3,
            ]
        );

        $questions = [
            [
                'key' => 'wbl_course_alignment',
                'label' => 'Adakah pelajar menjalani WBL mengikut cadangan kursus yang perlu dipelajari pada semester semasa?',
            ],
            [
                'key' => 'task_clo_alignment',
                'label' => 'Adakah Tugasan / kerja yang diberikan oleh pihak organisasi bersesuaian dan mengikuti keperluan objektif pembelajaran (CLO) dalam kursus berkaitan?',
            ],
            [
                'key' => 'assessment_clo_alignment',
                'label' => 'Adakah pelajar melaksanakan kaedah penilaian mengikut keperluan objektif pembelajaran (CLO) dan penilaian berterusan dalam kursus berkaitan?',
            ],
        ];

        foreach ($questions as $index => $question) {

            $item = MonitoringFormItem::updateOrCreate(
                [
                    'section_id' => $courseMonitoring->id,
                    'item_key' => $question['key'],
                ],
                [
                    'item_type' => 'yes_no',
                    'label' => $question['label'],
                    'sort_order' => $index + 1,
                ]
            );

            foreach ([
                ['key' => 'yes', 'label' => 'YA'],
                ['key' => 'no', 'label' => 'TIDAK'],
            ] as $optionIndex => $option) {

                MonitoringFormOption::updateOrCreate(
                    [
                        'item_id' => $item->id,
                        'option_key' => $option['key'],
                    ],
                    [
                        'label' => $option['label'],
                        'sort_order' => $optionIndex + 1,
                    ]
                );
            }
        }

        MonitoringFormItem::updateOrCreate(
            [
                'section_id' => $courseMonitoring->id,
                'item_key' => 'overall_comments',
            ],
            [
                'item_type' => 'textarea',
                'label' => 'Ulasan pensyarah secara keseluruhan (jika ada)',
                'sort_order' => 4,
            ]
        );
    }

    private function createRatingItem(
        MonitoringFormSection $section,
        string $key,
        string $label,
        array $options,
        int $sortOrder
    ): void {
        $item = MonitoringFormItem::updateOrCreate(
            [
                'section_id' => $section->id,
                'item_key' => $key,
            ],
            [
                'item_type' => 'rating',
                'label' => $label,
                'sort_order' => $sortOrder,
            ]
        );

        foreach ($options as $index => $option) {

            MonitoringFormOption::updateOrCreate(
                [
                    'item_id' => $item->id,
                    'option_key' => $option['key'],
                ],
                [
                    'label' => $option['label'],
                    'description' => $option['description'] ?? null,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
