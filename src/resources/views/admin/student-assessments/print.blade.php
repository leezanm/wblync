<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Assessment - {{ $studentAssessment->student->name }}
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f1f5f9;
            color: #0f172a;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        .print-container {
            width: 210mm;
            max-width: 100%;
            margin: 0 auto;
            background: #ffffff;
            padding: 18mm;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #0f172a;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .header h2 {
            margin: 5px 0 0;
            font-size: 15px;
            font-weight: normal;
        }

        .header p {
            margin: 5px 0 0;
            color: #475569;
        }

        .section-title {
            margin: 20px 0 10px;
            padding: 8px 10px;
            background: #e2e8f0;
            border: 1px solid #cbd5e1;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 7px 8px;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
            text-align: left;
            font-weight: bold;
        }

        .info-table td {
            width: 50%;
        }

        .label {
            display: inline-block;
            width: 120px;
            color: #64748b;
        }

        .value {
            font-weight: bold;
        }

        .criterion {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .description {
            color: #64748b;
            font-size: 11px;
        }

        .rating {
            font-weight: bold;
        }

        .remark {
            white-space: pre-line;
            color: #475569;
        }

        .score {
            text-align: center;
            font-weight: bold;
            white-space: nowrap;
        }

        .result-table td {
            text-align: center;
        }

        .result-value {
            font-size: 18px;
            font-weight: bold;
        }

        .overall-remarks {
            min-height: 70px;
            white-space: pre-line;
        }

        .signature-table {
            margin-top: 50px;
        }

        .signature-space {
            height: 70px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #cbd5e1;
            text-align: center;
            color: #64748b;
            font-size: 10px;
        }

        .no-print {
            width: 210mm;
            max-width: 100%;
            margin: 0 auto 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .button {
            display: inline-block;
            padding: 9px 16px;
            border-radius: 6px;
            border: 0;
            cursor: pointer;
            text-decoration: none;
            font-size: 12px;
        }

        .button-print {
            background: #2563eb;
            color: #ffffff;
        }

        .button-back {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
        }

        .page-break {
            page-break-before: always;
        }

        @page {
            size: A4;
            margin: 12mm;
        }

        @media print {

            body {
                padding: 0;
                background: #ffffff;
            }

            .print-container {
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .section-title {
                background: #e2e8f0 !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            th {
                background: #f8fafc !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .avoid-break {
                page-break-inside: avoid;
            }

        }

    </style>

</head>


<body>


    {{-- Print Controls --}}
    <div class="no-print">
        <a
            href="javascript:window.close()"
            class="button button-back"
        >
            Close
        </a>

        <button
            type="button"
            onclick="window.print()"
            class="button button-print"
        >
            🖨 Print Assessment
        </button>

    </div>


    <div class="print-container">


        {{-- Header --}}
        <div class="header">

            <h1>
                Student Assessment Form
            </h1>

            <h2>
                {{ $studentAssessment->assessmentVersion->assessmentTemplate->name }}
            </h2>

            @if ($studentAssessment->assessmentVersion->assessmentTemplate->course)

                <p>
                    {{ $studentAssessment->assessmentVersion->assessmentTemplate->course->name }}
                </p>

            @endif

        </div>


        {{-- Student Information --}}
        <div class="section-title">
            Student Information
        </div>

        <table class="info-table">

            <tr>

                <td>
                    <span class="label">
                        Student Name
                    </span>

                    <span class="value">
                        {{ $studentAssessment->student->name }}
                    </span>
                </td>

                <td>
                    <span class="label">
                        Student No.
                    </span>

                    <span class="value">
                        {{ $studentAssessment->student->student_no }}
                    </span>
                </td>

            </tr>

            <tr>

                <td>
                    <span class="label">
                        Assessment
                    </span>

                    <span class="value">
                        {{ $studentAssessment->assessmentVersion->assessmentTemplate->name }}
                    </span>
                </td>

                <td>
                    <span class="label">
                        Version
                    </span>

                    <span class="value">
                        {{ $studentAssessment->assessmentVersion->version }}
                    </span>
                </td>

            </tr>

            <tr>

                <td>
                    <span class="label">
                        Status
                    </span>

                    <span class="value">
                        {{ $studentAssessment->status }}
                    </span>
                </td>

                <td>

                    <span class="label">
                        Assessed At
                    </span>

                    <span class="value">

                        @if ($studentAssessment->assessed_at)

                            {{ \Carbon\Carbon::parse($studentAssessment->assessed_at)->format('d M Y, h:i A') }}

                        @else

                            —

                        @endif

                    </span>

                </td>

            </tr>

        </table>


        {{-- Assessment Criteria --}}
        <div class="section-title">
            Assessment Criteria
        </div>


        @foreach ($studentAssessment->assessmentVersion->sections as $section)

            <div class="avoid-break">

                <table>

                    <thead>

                        <tr>

                            <th colspan="4">
                                {{ $section->name }}

                                @if ($section->description)

                                    <div class="description">
                                        {{ $section->description }}
                                    </div>

                                @endif

                            </th>

                        </tr>

                        <tr>

                            <th style="width: 35%;">
                                Criterion
                            </th>

                            <th style="width: 25%;">
                                Rating
                            </th>

                            <th style="width: 10%;">
                                Score
                            </th>

                            <th style="width: 30%;">
                                Remark
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($section->criteria as $criterion)

                            @php

                                $score = $studentAssessment->scores
                                    ->firstWhere(
                                        'assessment_criterion_id',
                                        $criterion->id
                                    );

                                $rating = $criterion->ratingLevels
                                    ->firstWhere(
                                        'id',
                                        optional($score)->rating_level_id
                                    );

                            @endphp

                            <tr>

                                <td>

                                    <div class="criterion">
                                        {{ $criterion->name }}
                                    </div>

                                    @if ($criterion->description)

                                        <div class="description">
                                            {{ $criterion->description }}
                                        </div>

                                    @endif

                                </td>


                                <td>

                                    @if ($rating)

                                        <div class="rating">
                                            {{ $rating->label }}
                                        </div>

                                        @if ($rating->description)

                                            <div class="description">
                                                {{ $rating->description }}
                                            </div>

                                        @endif

                                    @else

                                        —

                                    @endif

                                </td>


                                <td class="score">

                                    @if ($score)

                                        {{ number_format($score->score, 2) }}

                                    @else

                                        —

                                    @endif

                                </td>


                                <td>

                                    @if ($score?->remark)

                                        <div class="remark">
                                            {{ $score->remark }}
                                        </div>

                                    @else

                                        —

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <br>

        @endforeach


        {{-- Overall Result --}}
        <div class="section-title">
            Overall Result
        </div>

        <table class="result-table">

            <tr>

                <th>
                    Total Score
                </th>

                <th>
                    Percentage
                </th>

                <th>
                    Status
                </th>

            </tr>

            <tr>

                <td>

                    <div class="result-value">

                        @if ($studentAssessment->total_score !== null)

                            {{ number_format($studentAssessment->total_score, 2) }}

                        @else

                            —

                        @endif

                    </div>

                </td>


                <td>

                    <div class="result-value">

                        @if ($studentAssessment->percentage !== null)

                            {{ number_format($studentAssessment->percentage, 2) }}%

                        @else

                            —

                        @endif

                    </div>

                </td>


                <td>

                    <div class="result-value">
                        {{ $studentAssessment->status }}
                    </div>

                </td>

            </tr>

        </table>


        {{-- Overall Remarks --}}
        <div class="section-title">
            Overall Remarks
        </div>

        <table>

            <tr>

                <td class="overall-remarks">

                    @if ($studentAssessment->remarks)

                        {{ $studentAssessment->remarks }}

                    @else

                        —

                    @endif

                </td>

            </tr>

        </table>


        {{-- Signature --}}
        <div class="section-title">
            Verification
        </div>

        <table class="signature-table">

            <tr>

                <td style="width: 50%;">
                    Nama Mentor : {{ $studentAssessment->assessor?->name ?? '____________________' }}
                    <br>
                    Company : {{ $studentAssessment->assessor?->company?->name ?? '____________________' }}
                    <br>
                    Date Assessment : {{ $studentAssessment->assessed_at ? \Carbon\Carbon::parse($studentAssessment->assessed_at)->format('d M Y') : '____________________' }}
                </td>




            </tr>

        </table>


        {{-- Footer --}}
        <div class="footer">

            Generated from WBLync

            @if ($studentAssessment->assessed_at)
                · {{ \Carbon\Carbon::parse($studentAssessment->assessed_at)->format('d M Y') }}
            @endif

        </div>


    </div>


</body>

</html>
