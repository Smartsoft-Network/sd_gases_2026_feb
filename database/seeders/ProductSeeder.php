<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'title' => "Himalayan Oxygen Systems",
                'description' => ['content' => "Professional-grade oxygen systems designed for high-altitude mountaineering expeditions. Trusted by thousands of climbers on Everest and beyond. Features: High-altitude performance, Lightweight design, Cold-resistant."],
                'image' => "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800",
                'slug' => 'himalayan-oxygen',
                'features' => [
                    'subtitle' => 'Why Choose Us',
                    'title' => 'Key Features',
                    'items' => [
                        ['icon' => 'mountain', 'title' => "High Altitude", 'description' => "Engineered for extreme altitudes up to 8,848m"],
                        ['icon' => 'shield', 'title' => "Safety Certified", 'description' => "Meets international mountaineering safety standards"],
                        ['icon' => 'wind', 'title' => "Lightweight", 'description' => "Optimized weight for expedition climbing"],
                        ['icon' => 'thermometer', 'title' => "Cold Resistant", 'description' => "Functions in temperatures as low as -40°C"],
                        ['icon' => 'gauge', 'title' => "Precise Flow", 'description' => "Adjustable flow rates from 0.5 to 4 L/min"],
                        ['icon' => 'package', 'title' => "Complete Kit", 'description' => "Includes mask, regulator, and carrying system"],
                    ]
                ],
                'specifications' => [
                    'subtitle' => 'Choose Your System',
                    'title' => 'System Specifications',
                    'variants' => [
                        [
                            'title' => 'Standard System',
                            'description' => 'Ideal for trekking peaks and commercial expeditions. Proven reliability at an accessible price point.',
                            'marker_class' => 'bg-primary',
                            'table_title' => 'Technical Specifications',
                            'specs' => [
                                ['label' => "Cylinder Material", 'value' => "Aluminum Alloy 6061-T6"],
                                ['label' => "Capacity", 'value' => "4 Liters (520L O₂)"],
                                ['label' => "Working Pressure", 'value' => "3000 PSI (207 bar)"],
                                ['label' => "Weight (Empty)", 'value' => "2.8 kg"],
                                ['label' => "Weight (Full)", 'value' => "3.5 kg"],
                                ['label' => "Flow Rate Range", 'value' => "0.5 - 4 L/min"],
                                ['label' => "Duration @ 2 L/min", 'value' => "4.3 hours"],
                                ['label' => "Operating Temperature", 'value' => "-40°C to +60°C"],
                            ]
                        ],
                        [
                            'title' => 'Elite System',
                            'description' => 'Premium carbon fiber construction for weight-conscious climbers. Maximum performance for the most demanding expeditions.',
                            'marker_class' => 'bg-primary animate-pulse',
                            'table_title' => 'Technical Specifications',
                            'specs' => [
                                ['label' => "Cylinder Material", 'value' => "Carbon Fiber Composite"],
                                ['label' => "Capacity", 'value' => "4.5 Liters (585L O₂)"],
                                ['label' => "Working Pressure", 'value' => "4500 PSI (310 bar)"],
                                ['label' => "Weight (Empty)", 'value' => "1.9 kg"],
                                ['label' => "Weight (Full)", 'value' => "2.6 kg"],
                                ['label' => "Flow Rate Range", 'value' => "0.25 - 6 L/min"],
                                ['label' => "Duration @ 2 L/min", 'value' => "4.9 hours"],
                                ['label' => "Operating Temperature", 'value' => "-50°C to +60°C"],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => "Medical Oxygen Equipment",
                'description' => ['content' => "Hospital-grade oxygen cylinders, concentrators, and accessories for healthcare facilities and home medical use. Features: 99.5% purity, Hospital approved, Home delivery."],
                'image' => "https://images.unsplash.com/photo-1584362917165-526a968c4b29?w=800",
                'slug' => 'medical-oxygen',
                'features' => [
                    'subtitle' => 'Product Benefits',
                    'title' => 'Why Medical Oxygen?',
                    'items' => [
                        ['icon' => 'shield', 'title' => "99.5% Purity", 'description' => "Medical grade oxygen for patient safety"],
                        ['icon' => 'package', 'title' => "Hospital Approved", 'description' => "Certified for use in medical facilities"],
                        ['icon' => 'package', 'title' => "Home Delivery", 'description' => "Fast and reliable delivery to your doorstep"],
                    ]
                ],
                'specifications' => null
            ],
            [
                'title' => "Industrial Gas Solutions",
                'description' => ['content' => "Industrial oxygen, nitrogen, and specialty gases for manufacturing, welding, and various industrial applications. Features: Bulk supply, Regular delivery, Custom mixtures."],
                'image' => "https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=800",
                'slug' => 'industrial-gas',
                'features' => [
                    'subtitle' => 'Industrial Features',
                    'title' => 'Key Advantages',
                    'items' => [
                        ['icon' => 'package', 'title' => "Bulk Supply", 'description' => "Large volume delivery for industrial needs"],
                        ['icon' => 'package', 'title' => "Regular Delivery", 'description' => "Scheduled supply chain management"],
                        ['icon' => 'gauge', 'title' => "Custom Mixtures", 'description' => "Tailored gas blends for specific applications"],
                    ]
                ],
                'specifications' => null
            ],
            [
                'title' => "Emergency Oxygen Kits",
                'description' => ['content' => "Portable emergency oxygen kits for rescue operations, helicopter evacuations, and emergency medical services. Features: Rapid deployment, Compact design, 24/7 support."],
                'image' => "https://images.unsplash.com/photo-1551076805-e1869033e561?w=800",
                'slug' => 'emergency-oxygen',
                'features' => [
                    'subtitle' => 'Emergency Features',
                    'title' => 'Critical Benefits',
                    'items' => [
                        ['icon' => 'wind', 'title' => "Rapid Deployment", 'description' => "Quick setup for emergency situations"],
                        ['icon' => 'package', 'title' => "Compact Design", 'description' => "Easy to transport and store"],
                        ['icon' => 'shield', 'title' => "24/7 Support", 'description' => "Always available technical assistance"],
                    ]
                ],
                'specifications' => null
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
