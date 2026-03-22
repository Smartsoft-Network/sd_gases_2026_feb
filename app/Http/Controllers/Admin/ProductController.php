<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Traits\HandlesYouTubeUrls;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use HandlesYouTubeUrls;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
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

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data = $this->processJsonData($data, $product);

        $existingOthers = $product->others_data ?? [];
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

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Helper to re-index array keys for JSON storage
     */
    private function processJsonData(array $data, ?Product $product = null)
    {
        // Handle Description
        if (isset($data['description_text'])) {
            $data['description'] = [
                'content' => $data['description_text'],
            ];
            unset($data['description_text']);
        }

        // Handle Details Description
        if (isset($data['details_description']) || isset($data['details_description_title']) || isset($data['details_description_subtitle'])) {
            $data['details_description'] = [
                'title' => $data['details_description_title'] ?? ($product ? ($product->details_description['title'] ?? null) : null),
                'subtitle' => $data['details_description_subtitle'] ?? ($product ? ($product->details_description['subtitle'] ?? null) : null),
                'html' => $data['details_description'] ?? ($product ? ($product->details_description['html'] ?? null) : null),
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

        // Handle Specifications
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

        $hasTutorialMeta = isset($data['tutorial_section_title']) || isset($data['tutorial_section_subtitle']);

        $tutorialItems = [];

        if (isset($data['tutorial_items']) && is_array($data['tutorial_items'])) {
            foreach ($data['tutorial_items'] as $item) {
                $youtubeUrl = $item['youtube_url'] ?? null;
                $description = $item['description'] ?? null;

                if ($youtubeUrl === null && $description === null) {
                    continue;
                }

                $tutorialItems[] = [
                    'youtube_url' => $this->convertToYoutubeEmbedUrl($youtubeUrl),
                    'description' => $description,
                ];
            }
        } elseif (isset($data['tutorial_youtube_iframe']) || isset($data['tutorial_description'])) {
            $tutorialItems[] = [
                'youtube_url' => $this->convertToYoutubeEmbedUrl($data['tutorial_youtube_iframe'] ?? null),
                'description' => $data['tutorial_description'] ?? null,
            ];
        }

        if ($hasTutorialMeta || !empty($tutorialItems)) {
            $data['tutorial'] = [
                'section_subtitle' => $data['tutorial_section_subtitle'] ?? ($product ? ($product->tutorial['section_subtitle'] ?? null) : null),
                'section_title' => $data['tutorial_section_title'] ?? ($product ? ($product->tutorial['section_title'] ?? null) : null),
                'items' => $tutorialItems,
            ];
        }

        unset(
            $data['tutorial_section_subtitle'],
            $data['tutorial_section_title'],
            $data['tutorial_youtube_iframe'],
            $data['tutorial_description'],
            $data['tutorial_items']
        );
        
        return $data;
    }

    private function buildSectionsConfig(array $data, array $existingSections = []): array
    {
        if (!isset($data['sections']) || !is_array($data['sections'])) {
            return $existingSections;
        }

        $sectionsInput = $data['sections'];
        $keys = ['features', 'details_description', 'tutorial', 'specifications'];
        $result = $existingSections;

        foreach ($keys as $key) {
            if (!isset($sectionsInput[$key]) || !is_array($sectionsInput[$key])) {
                continue;
            }

            $section = $sectionsInput[$key];

            $active = isset($section['active'])
                ? (bool)$section['active']
                : (bool)($existingSections[$key]['active'] ?? false);

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
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
