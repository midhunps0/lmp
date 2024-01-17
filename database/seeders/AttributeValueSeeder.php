<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributesConfig = config('attributes.attributes');

        foreach ($attributesConfig as $attribute => $values) {
            $attributeModel = Attribute::where('attribute', $attribute)->first();
        
            if ($attributeModel) {
                foreach ($values as $value) {
                    AttributeValue::create([
                        'attribute_id' => $attributeModel->id,
                        'value' => $value
                    ]);
                }
            } else {
                continue;
            }
        }
        
       
    }
}
