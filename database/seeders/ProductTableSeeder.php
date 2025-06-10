<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $stationeryProducts = [
            'Ballpoint Pen', 'Gel Pen', 'Mechanical Pencil', 'Wooden Pencil', 'Highlighter',
            'Permanent Marker', 'Whiteboard Marker', 'Eraser', 'Correction Tape', 'Ruler',
            'Stapler', 'Staple Remover', 'Paper Clips', 'Binder Clips', 'Scissors',
            'Glue Stick', 'Liquid Glue', 'Sticky Notes', 'Index Tabs', 'Notebook',
            'Spiral Notebook', 'Composition Book', 'Legal Pad', 'Sketchbook', 'Drawing Pad',
            'Fountain Pen', 'Rollerball Pen', 'Fineliner Pen', 'Colored Pencils', 'Crayons',
            'Watercolor Set', 'Paint Brush', 'Compass', 'Protractor', 'Set Square',
            'Clipboard', 'File Folder', 'Document Wallet', 'Expanding File', 'Ring Binder',
            'Lever Arch File', 'Presentation Folder', 'Plastic Sleeve', 'Envelope', 'Mailing Tube',
            'Desk Organizer', 'Pen Holder', 'Magazine File', 'Bookend', 'Paper Tray',
            'Memo Cube', 'Desk Calendar', 'Wall Calendar', 'Push Pins', 'Thumb Tacks',
            'Rubber Bands', 'Magnets', 'Label Maker', 'Address Book', 'Calculator',
            'Desk Lamp', 'Paper Shredder', 'Laminator', 'Tape Dispenser', 'Double-sided Tape',
            'Masking Tape', 'Packing Tape', 'Correction Fluid', 'Drawing Compass', 'Drafting Tape',
            'Blueprint Paper', 'Tracing Paper', 'Carbon Paper', 'Graph Paper', 'Index Cards',
            'Business Card Holder', 'Name Badge', 'ID Card Holder', 'Badge Reel', 'Clipboard Folder',
            'Document Case', 'Portfolio', 'Presentation Book', 'Display Book', 'Flip Chart',
            'Whiteboard', 'Cork Board', 'Notice Board', 'Chalk', 'Chalkboard',
            'Desk Mat', 'Mouse Pad', 'Keyboard Wrist Rest', 'Monitor Stand', 'Cable Organizer',
            'USB Hub', 'Letter Opener', 'Paper Cutter', 'Guillotine', 'Hole Punch'
        ];

        $colors = [
            'Red', 'Blue', 'Green', 'Yellow', 'Black', 'White', 'Purple', 'Orange', 'Pink', 'Gray',
            'Brown', 'Cyan', 'Magenta', 'Lime', 'Teal', 'Navy', 'Maroon', 'Olive', 'Silver', 'Gold'
        ];

        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => $stationeryProducts[$i % count($stationeryProducts)],
                'color' => $colors[array_rand($colors)],
                'description' => $faker->sentence(),
                'price' => $faker->randomFloat(2, 1, 100),
                'stock' => $faker->numberBetween(1, 200),
                'sku' => strtoupper($faker->unique()->bothify('SKU-####-???')),
            ]);
        }
    }
}