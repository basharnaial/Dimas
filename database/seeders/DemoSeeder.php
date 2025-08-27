<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@demas.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Create categories
        $woundCare = Category::create([
            'name' => 'العناية بالجروح',
            'slug' => 'wound-care',
            'description' => 'منتجات العناية بالجروح والضمادات الطبية',
            'meta_title' => 'منتجات العناية بالجروح - ديماس',
            'meta_description' => 'منتجات احترافية للعناية بالجروح للمؤسسات الصحية والمهنيين الطبيين',
            'is_active' => true,
        ]);

        $infectionControl = Category::create([
            'name' => 'مكافحة العدوى',
            'slug' => 'infection-control',
            'description' => 'منتجات التعقيم ومكافحة العدوى',
            'meta_title' => 'حلول مكافحة العدوى - ديماس',
            'meta_description' => 'منتجات متقدمة لمكافحة العدوى للحفاظ على البيئات المعقمة في الأماكن الطبية',
            'is_active' => true,
        ]);

        // Create products for Wound Care
        $product1 = Product::create([
            'category_id' => $woundCare->id,
            'name' => 'Advanced Wound Dressing Kit',
            'slug' => 'advanced-wound-dressing-kit',
            'sku' => 'WC-001',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'Complete wound dressing kit with sterile components for professional wound care.',
            'description' => 'This comprehensive wound dressing kit includes sterile gauze pads, adhesive bandages, antiseptic wipes, and medical tape. Designed for healthcare professionals to provide optimal wound care in clinical settings.',
            'specs' => [
                'size' => 'Standard Kit',
                'sterility' => 'Sterile',
                'components' => '15 pieces',
                'shelf_life' => '3 years'
            ],
            'meta_title' => 'Advanced Wound Dressing Kit - Professional Medical Supplies',
            'meta_description' => 'Professional wound dressing kit with sterile components for optimal wound care in healthcare settings.',
        ]);

        $product2 = Product::create([
            'category_id' => $woundCare->id,
            'name' => 'Hydrocolloid Wound Patches',
            'slug' => 'hydrocolloid-wound-patches',
            'sku' => 'WC-002',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'Self-adhesive hydrocolloid patches for moist wound healing.',
            'description' => 'These hydrocolloid wound patches provide optimal moist wound healing environment. Self-adhesive and waterproof design makes them ideal for various wound types.',
            'specs' => [
                'material' => 'Hydrocolloid',
                'sizes' => '5cm x 5cm, 10cm x 10cm',
                'waterproof' => 'Yes',
                'adhesion' => 'Self-adhesive'
            ],
            'meta_title' => 'Hydrocolloid Wound Patches - Moist Wound Healing',
            'meta_description' => 'Self-adhesive hydrocolloid patches for optimal moist wound healing environment.',
        ]);

        $product3 = Product::create([
            'category_id' => $woundCare->id,
            'name' => 'Surgical Suture Kit',
            'slug' => 'surgical-suture-kit',
            'sku' => 'WC-003',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'Complete surgical suture kit with various needle types and thread materials.',
            'description' => 'Professional surgical suture kit containing different needle types, absorbable and non-absorbable sutures, and essential surgical instruments.',
            'specs' => [
                'needle_types' => 'Curved, Straight',
                'suture_materials' => 'Silk, Nylon, Absorbable',
                'sizes' => 'Multiple sizes included',
                'sterilization' => 'Gamma sterilized'
            ],
            'meta_title' => 'Surgical Suture Kit - Professional Medical Instruments',
            'meta_description' => 'Complete surgical suture kit with various needle types and thread materials for medical procedures.',
        ]);

        $product4 = Product::create([
            'category_id' => $woundCare->id,
            'name' => 'Medical Compression Bandages',
            'slug' => 'medical-compression-bandages',
            'sku' => 'WC-004',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'Elastic compression bandages for wound support and circulation improvement.',
            'description' => 'High-quality elastic compression bandages designed to provide consistent pressure for wound support, edema control, and circulation improvement.',
            'specs' => [
                'material' => 'Elastic cotton blend',
                'compression' => 'Graduated compression',
                'widths' => '5cm, 7.5cm, 10cm',
                'length' => '4.5 meters each'
            ],
            'meta_title' => 'Medical Compression Bandages - Wound Support',
            'meta_description' => 'Elastic compression bandages for wound support and circulation improvement in medical care.',
        ]);

        // Create products for Infection Control
        $product5 = Product::create([
            'category_id' => $infectionControl->id,
            'name' => 'Antimicrobial Hand Sanitizer',
            'slug' => 'antimicrobial-hand-sanitizer',
            'sku' => 'IC-001',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => '70% alcohol-based hand sanitizer for effective antimicrobial protection.',
            'description' => 'Professional-grade antimicrobial hand sanitizer with 70% alcohol content. Effective against bacteria, viruses, and fungi. Ideal for healthcare settings.',
            'specs' => [
                'alcohol_content' => '70%',
                'volume' => '500ml, 1L',
                'effectiveness' => '99.9% germ kill',
                'fragrance' => 'Unscented'
            ],
            'meta_title' => 'Antimicrobial Hand Sanitizer - Healthcare Grade',
            'meta_description' => '70% alcohol-based hand sanitizer for effective antimicrobial protection in healthcare settings.',
        ]);

        $product6 = Product::create([
            'category_id' => $infectionControl->id,
            'name' => 'Disposable Nitrile Gloves',
            'slug' => 'disposable-nitrile-gloves',
            'sku' => 'IC-002',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'Powder-free nitrile examination gloves for medical use.',
            'description' => 'High-quality powder-free nitrile examination gloves providing excellent barrier protection. Latex-free and suitable for sensitive skin.',
            'specs' => [
                'material' => 'Nitrile rubber',
                'powder' => 'Powder-free',
                'sizes' => 'S, M, L, XL',
                'thickness' => '4.0 mil'
            ],
            'meta_title' => 'Disposable Nitrile Gloves - Medical Examination',
            'meta_description' => 'Powder-free nitrile examination gloves providing excellent barrier protection for medical use.',
        ]);

        $product7 = Product::create([
            'category_id' => $infectionControl->id,
            'name' => 'Surface Disinfectant Wipes',
            'slug' => 'surface-disinfectant-wipes',
            'sku' => 'IC-003',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'Hospital-grade disinfectant wipes for surface cleaning and sanitization.',
            'description' => 'Hospital-grade disinfectant wipes effective against a broad spectrum of pathogens. Perfect for cleaning and disinfecting medical equipment and surfaces.',
            'specs' => [
                'active_ingredient' => 'Quaternary ammonium',
                'kill_time' => '30 seconds',
                'count' => '160 wipes per canister',
                'surface_compatibility' => 'Multi-surface'
            ],
            'meta_title' => 'Surface Disinfectant Wipes - Hospital Grade',
            'meta_description' => 'Hospital-grade disinfectant wipes for effective surface cleaning and sanitization.',
        ]);

        $product8 = Product::create([
            'category_id' => $infectionControl->id,
            'name' => 'UV Sterilization Cabinet',
            'slug' => 'uv-sterilization-cabinet',
            'sku' => 'IC-004',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'Professional UV-C sterilization cabinet for medical instruments.',
            'description' => 'Professional-grade UV-C sterilization cabinet designed for sterilizing medical instruments, tools, and equipment. Features automated cycle control and safety interlocks.',
            'specs' => [
                'uv_wavelength' => '254nm UV-C',
                'capacity' => '20 liters',
                'cycle_time' => '15-30 minutes',
                'safety_features' => 'Door interlock, timer'
            ],
            'meta_title' => 'UV Sterilization Cabinet - Medical Equipment',
            'meta_description' => 'Professional UV-C sterilization cabinet for effective sterilization of medical instruments.',
        ]);

        // Create sample product images
        $products = [$product1, $product2, $product3, $product4, $product5, $product6, $product7, $product8];
        
        foreach ($products as $index => $product) {
            // Create 2-3 sample images per product
            ProductImage::create([
                'product_id' => $product->id,
                'path' => "products/placeholder.svg",
                'sort_order' => 0,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'path' => "products/placeholder.svg",
                'sort_order' => 1,
            ]);

            if ($index % 2 === 0) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => "products/placeholder.svg",
                    'sort_order' => 2,
                ]);
            }
        }

        $this->command->info('Demo data seeded successfully!');
        $this->command->info('Admin user: admin@demas.com / password');
        $this->command->info('Regular user: user@example.com / password');
    }
}
