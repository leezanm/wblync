<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonitoringFormItem;
use App\Models\MonitoringFormOption;
use App\Models\MonitoringFormSection;
use App\Models\MonitoringFormTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MonitoringFormTemplateController extends Controller
{
    public function index(Request $request): View
    {
        //$this->authorizeAdmin($request);

        $templates = MonitoringFormTemplate::query()
            ->withCount('sections')
            ->orderByDesc('version')
            ->get();

        $activeTemplate = $templates->firstWhere(
            'status',
            'Active'
        );

        return view(
            'admin.monitoring-form-templates.index',
            compact(
                'templates',
                'activeTemplate'
            )
        );
    }

    public function edit(
        Request $request,
        MonitoringFormTemplate $monitoringFormTemplate
    ): View {
       // $this->authorizeAdmin($request);

        // abort_unless(
        //     $monitoringFormTemplate->isDraft(),
        //     403,
        //     'Only draft monitoring form versions can be edited.'
        // );

        $monitoringFormTemplate->load([
            'sections.items.options',
        ]);

        return view(
            'admin.monitoring-form-templates.edit',
            compact('monitoringFormTemplate')
        );
    }

    public function update(
        Request $request,
        MonitoringFormTemplate $monitoringFormTemplate
    ): RedirectResponse {
    //    $this->authorizeAdmin($request);

        // abort_unless(
        //     $monitoringFormTemplate->isDraft(),
        //     403,
        //     'Only draft monitoring form versions can be edited.'
        // );

        $validated = $request->validate([
            'items' => ['required', 'array'],

            'items.*.label' => [
                'required',
                'string',
                'max:1000',
            ],

            'items.*.description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'options' => ['nullable', 'array'],

            'options.*.label' => [
                'required',
                'string',
                'max:255',
            ],

            'options.*.description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $monitoringFormTemplate
        ) {
            foreach ($validated['items'] as $itemId => $itemData) {

                MonitoringFormItem::query()
                    ->where('id', $itemId)
                    ->whereHas('section', function ($query) use (
                        $monitoringFormTemplate
                    ) {
                        $query->where(
                            'template_id',
                            $monitoringFormTemplate->id
                        );
                    })
                    ->update([
                        'label' => $itemData['label'],
                        'description' => $itemData['description'] ?? null,
                    ]);
            }

            foreach ($validated['options'] ?? [] as $optionId => $optionData) {

                MonitoringFormOption::query()
                    ->where('id', $optionId)
                    ->whereHas('item.section', function ($query) use (
                        $monitoringFormTemplate
                    ) {
                        $query->where(
                            'template_id',
                            $monitoringFormTemplate->id
                        );
                    })
                    ->update([
                        'label' => $optionData['label'],
                        'description' => $optionData['description'] ?? null,
                    ]);
            }
        });

        return redirect()
            ->route(
                'admin.monitoring-form-templates.index'
            )
            ->with(
                'success',
                'Monitoring form content updated successfully.'
            );
    }

    public function create(
        Request $request
    ): RedirectResponse {
      //  $this->authorizeAdmin($request);

        $active = MonitoringFormTemplate::query()
            ->where('status', 'Active')
            ->first();

        // abort_unless(
        //     $active,
        //     404,
        //     'No active monitoring form template found.'
        // );

        $newVersion = (
            MonitoringFormTemplate::query()
                ->where('name', $active->name)
                ->max('version')
            ?? 0
        ) + 1;

        $newTemplate = DB::transaction(
            function () use (
                $active,
                $newVersion,
                $request
            ) {
                $active->load([
                    'sections.items.options',
                ]);

                $template = MonitoringFormTemplate::create([
                    'uuid' => (string) Str::uuid(),
                    'name' => $active->name,
                    'version' => $newVersion,
                    'status' => 'Draft',
                    'created_by' => $request->user()->id,
                ]);

                foreach ($active->sections as $section) {

                    $newSection = MonitoringFormSection::create([
                        'template_id' => $template->id,
                        'section_no' => $section->section_no,
                        'section_key' => $section->section_key,
                        'title' => $section->title,
                        'sort_order' => $section->sort_order,
                    ]);

                    foreach ($section->items as $item) {

                        $newItem = MonitoringFormItem::create([
                            'section_id' => $newSection->id,
                            'item_key' => $item->item_key,
                            'item_type' => $item->item_type,
                            'label' => $item->label,
                            'description' => $item->description,
                            'sort_order' => $item->sort_order,
                        ]);

                        foreach ($item->options as $option) {

                            MonitoringFormOption::create([
                                'item_id' => $newItem->id,
                                'option_key' => $option->option_key,
                                'label' => $option->label,
                                'description' => $option->description,
                                'sort_order' => $option->sort_order,
                            ]);
                        }
                    }
                }

                return $template;
            }
        );

        return redirect()
            ->route(
                'admin.monitoring-form-templates.edit',
                $newTemplate
            )
            ->with(
                'success',
                "Version {$newVersion} created as draft."
            );
    }

    public function activate(
        Request $request,
        MonitoringFormTemplate $monitoringFormTemplate
    ): RedirectResponse {
      //($request);

        // abort_unless(
        //     $monitoringFormTemplate->isDraft(),
        //     403,
        //     'Only draft versions can be activated.'
        // );

        DB::transaction(function () use (
            $monitoringFormTemplate
        ) {
            MonitoringFormTemplate::query()
                ->where('status', 'Active')
                ->update([
                    'status' => 'Archived',
                ]);

            $monitoringFormTemplate->update([
                'status' => 'Active',
            ]);
        });

        return redirect()
            ->route(
                'admin.monitoring-form-templates.index'
            )
            ->with(
                'success',
                "Version {$monitoringFormTemplate->version} is now active."
            );
    }

    private function authorizeAdmin(Request $request): void
    {
        abort_unless(
            $request->user()
                && $request->user()->hasRole('Admin 1'),
            403
        );
    }
}
