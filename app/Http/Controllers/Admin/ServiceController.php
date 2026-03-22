<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ServiceStoreRequest;
use App\Http\Requests\Admin\ServiceUpdateRequest;
use App\Traits\HandlesYouTubeUrls;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    use HandlesYouTubeUrls;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data = $this->processJsonData($data);

        $sectionsConfig = $this->buildSectionsConfig($data);
        $othersData = [];
        if (!empty($sectionsConfig)) {
            $othersData['sections'] = $sectionsConfig;
        }

        if (isset($data['others_data']) && is_array($data['others_data'])) {
            foreach ($data['others_data'] as $key => $value) {
                $othersData[$key] = $value;
            }
        }

        $data['others_data'] = $othersData;

        unset($data['sections']);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data = $this->processJsonData($data, $service);

        $existingOthers = $service->others_data ?? [];
        $existingSections = is_array($existingOthers) ? ($existingOthers['sections'] ?? []) : [];

        $sectionsConfig = $this->buildSectionsConfig($data, $existingSections);
        
        $othersData = is_array($existingOthers) ? $existingOthers : [];
        if (!empty($sectionsConfig)) {
            $othersData['sections'] = $sectionsConfig;
        }

        if (isset($data['others_data']) && is_array($data['others_data'])) {
            foreach ($data['others_data'] as $key => $value) {
                $othersData[$key] = $value;
            }
        }

        $data['others_data'] = $othersData;

        unset($data['sections']);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Helper to re-index array keys for JSON storage
     */
    private function processJsonData(array $data, ?Service $service = null)
    {
        // Handle Details Description
        if (isset($data['details_description']) || isset($data['details_description_title']) || isset($data['details_description_subtitle'])) {
            $data['details_description'] = [
                'title' => $data['details_description_title'] ?? ($service ? ($service->details_description['title'] ?? null) : null),
                'subtitle' => $data['details_description_subtitle'] ?? ($service ? ($service->details_description['subtitle'] ?? null) : null),
                'html' => $data['details_description'] ?? ($service ? ($service->details_description['html'] ?? null) : null),
            ];

            unset(
                $data['details_description_title'],
                $data['details_description_subtitle']
            );
        }

        // Handle Features
        if (isset($data['features']) && is_array($data['features'])) {
            if (isset($data['features']['items']) && is_array($data['features']['items'])) {
                $items = array_values($data['features']['items']);

                foreach ($items as $index => &$item) {
                    if (!isset($item['sort_order']) || $item['sort_order'] === '') {
                        $item['sort_order'] = $index;
                    }
                }
                unset($item);

                usort($items, function ($a, $b) {
                    return ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0);
                });

                $data['features']['items'] = $items;
            }
        }

        // Handle Service Offerings (Specifications)
        if (isset($data['specifications']) && is_array($data['specifications'])) {
            if (isset($data['specifications']['variants']) && is_array($data['specifications']['variants'])) {
                $data['specifications']['variants'] = array_values($data['specifications']['variants']);
                
                foreach ($data['specifications']['variants'] as &$variant) {
                    if (isset($variant['specs']) && is_array($variant['specs'])) {
                        $variant['specs'] = array_values($variant['specs']);
                    }
                }
            }
        }

        // Handle Tutorial
        $hasTutorialMeta = isset($data['tutorial_section_title']) || isset($data['tutorial_section_subtitle']);
        $tutorialItems = [];

        if (isset($data['tutorial_items']) && is_array($data['tutorial_items'])) {
            foreach ($data['tutorial_items'] as $item) {
                $youtubeUrl = $item['youtube_url'] ?? '';
                $description = $item['description'] ?? '';

                if (empty($youtubeUrl) && empty($description)) {
                    continue;
                }

                $tutorialItems[] = [
                    'youtube_url' => $this->convertToYoutubeEmbedUrl($youtubeUrl),
                    'description' => $description,
                ];
            }
        }

        if ($hasTutorialMeta || !empty($tutorialItems)) {
            $data['tutorial'] = [
                'section_subtitle' => $data['tutorial_section_subtitle'] ?? ($service ? ($service->tutorial['section_subtitle'] ?? null) : null),
                'section_title' => $data['tutorial_section_title'] ?? ($service ? ($service->tutorial['section_title'] ?? null) : null),
                'items' => $tutorialItems,
            ];
        }

        unset(
            $data['tutorial_section_subtitle'],
            $data['tutorial_section_title'],
            $data['tutorial_items']
        );

        return $data;
    }

    /**
     * Build or update the sections configuration in others_data
     */
    private function buildSectionsConfig(array $data, array $existingSections = []): array
    {
        if (!isset($data['sections']) || !is_array($data['sections'])) {
            return $existingSections;
        }

        $sectionsInput = $data['sections'];
        $keys = ['details_description', 'specifications', 'tutorial', 'features'];
        $result = $existingSections;

        foreach ($keys as $key) {
            if (!isset($sectionsInput[$key]) || !is_array($sectionsInput[$key])) {
                continue;
            }

            $section = $sectionsInput[$key];

            // Get status
            $active = isset($section['active'])
                ? (bool)$section['active']
                : (bool)($existingSections[$key]['active'] ?? false);

            // Get order
            $order = isset($section['order'])
                ? (int)$section['order']
                : (int)($existingSections[$key]['order'] ?? 0);

            $result[$key] = [
                'active' => $active,
                'order' => $order,
            ];
        }

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
