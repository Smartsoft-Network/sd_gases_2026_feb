<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_text' => 'nullable|string',
            'details_description' => 'nullable|string',
            'details_description_title' => 'nullable|string|max:255',
            'details_description_subtitle' => 'nullable|string|max:255',
            
            // Features
            'features.title' => 'nullable|string|max:255',
            'features.subtitle' => 'nullable|string|max:255',
            'features.items' => 'nullable|array',
            'features.items.*.icon' => 'nullable|string|max:255',
            'features.items.*.title' => 'nullable|string|max:255',
            'features.items.*.description' => 'nullable|string',
            'features.items.*.sort_order' => 'nullable|integer',
            
            // Specifications
            'specifications.title' => 'nullable|string|max:255',
            'specifications.subtitle' => 'nullable|string|max:255',
            'specifications.variants' => 'nullable|array',
            'specifications.variants.*.title' => 'nullable|string|max:255',
            'specifications.variants.*.description' => 'nullable|string',
            'specifications.variants.*.table_title' => 'nullable|string|max:255',
            'specifications.variants.*.marker_class' => 'nullable|string|max:255',
            'specifications.variants.*.specs' => 'nullable|array',
            'specifications.variants.*.specs.*.label' => 'nullable|string|max:255',
            'specifications.variants.*.specs.*.value' => 'nullable|string|max:255',
            
            // Tutorial
            'tutorial_section_title' => 'nullable|string|max:255',
            'tutorial_section_subtitle' => 'nullable|string|max:255',
            'tutorial_items' => 'nullable|array',
            'tutorial_items.*.youtube_url' => 'nullable|string',
            'tutorial_items.*.description' => 'nullable|string',
            
            // Others Data (CTA)
            'others_data.cta_title' => 'nullable|string|max:255',
            'others_data.cta_subtitle' => 'nullable|string',
            
            // SEO
            'seo.title' => 'nullable|string|max:255',
            'seo.description' => 'nullable|string',
            'seo.keywords' => 'nullable|string',
            
            // Section Settings
            'sections' => 'nullable|array',
            'sections.*.active' => 'nullable|boolean',
            'sections.*.order' => 'nullable|integer',
        ];
    }
}
