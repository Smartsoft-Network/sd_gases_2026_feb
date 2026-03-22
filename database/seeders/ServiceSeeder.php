<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => "Cylinder Refilling",
                'description' => "Professional oxygen cylinder refilling service with quick turnaround and purity testing. Only company in Nepal using liquid trans-fill technology for high-pressure cylinders, maintaining optimal dew point moisture. Features: Same-day service, Purity certified, All cylinder sizes.",
                'image' => "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800",
                'slug' => 'cylinder-refilling',
                'icon' => 'RefreshCw',
            ],
            [
                'title' => "Equipment Rental",
                'description' => "Flexible rental options for oxygen equipment - from single cylinders to complete expedition packages. High-quality cylinders, regulators, and facemasks available for purchase or rental with fast service. Features: Daily/weekly/monthly, Maintenance included, Delivery available.",
                'image' => "https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=800",
                'slug' => 'equipment-rental',
                'icon' => 'ShoppingCart',
            ],
            [
                'title' => "Maintenance & Repair",
                'description' => "Expert maintenance, testing, and repair services for all oxygen equipment and regulators. Expert repair services with genuine Russian spare parts and professional purging services. Features: Certified technicians, Genuine parts, Warranty service.",
                'image' => "https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800",
                'slug' => 'maintenance',
                'icon' => 'Wrench',
            ],
            [
                'title' => "Bulk Supply Contracts",
                'description' => "Long-term supply agreements for hospitals, industries, and expedition companies. Features: Competitive pricing, Scheduled delivery, Dedicated account manager.",
                'image' => "https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=800",
                'slug' => 'bulk-supply',
                'icon' => 'Truck',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
