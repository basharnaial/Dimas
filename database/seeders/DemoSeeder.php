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
            'name_en' => 'Wound Care',
            'slug' => 'wound-care',
            'description' => 'منتجات العناية بالجروح والضمادات الطبية المتقدمة للاستخدام في المؤسسات الصحية',
            'description_en' => 'Advanced wound care products and medical dressings for healthcare institutions',
            'meta_title' => 'منتجات العناية بالجروح - ديماس',
            'meta_title_en' => 'Wound Care Products - Demas',
            'meta_description' => 'منتجات احترافية للعناية بالجروح للمؤسسات الصحية والمهنيين الطبيين',
            'meta_description_en' => 'Professional wound care products for healthcare institutions and medical professionals',
            'is_active' => true,
        ]);

        $infectionControl = Category::create([
            'name' => 'الوقاية من العدوى والعناية بالبشرة',
            'name_en' => 'Infection Prevention and Skin Care Wipes',
            'slug' => 'infection-prevention-skin-care',
            'description' => 'منتجات التعقيم ومكافحة العدوى والعناية بالبشرة للمؤسسات الصحية',
            'description_en' => 'Infection prevention, disinfection and skin care products for healthcare facilities',
            'meta_title' => 'حلول الوقاية من العدوى والعناية بالبشرة - ديماس',
            'meta_title_en' => 'Infection Prevention & Skin Care Solutions - Demas',
            'meta_description' => 'منتجات متقدمة للوقاية من العدوى والعناية بالبشرة للحفاظ على البيئات المعقمة',
            'meta_description_en' => 'Advanced infection prevention and skin care products for maintaining sterile environments',
            'is_active' => true,
        ]);

        // Create products for Infection Prevention and Skin Care
        $product1 = Product::create([
            'category_id' => $infectionControl->id,
            'name' => 'ECO Protect Universal Antimicrobial Wipes (2% Chlorhexidine Gluconate)',
            'name_en' => 'ECO Protect Universal Antimicrobial Wipes (2% Chlorhexidine Gluconate)',
            'slug' => 'eco-protect-antimicrobial-wipes',
            'sku' => 'ECP-CHG2',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'مناديل مطهِّرة تُستخدم لإزالة التلوث وتقليل الحمل الميكروبي، بصيغة مضادّة للميكروبات تمنح فعالية مبيدة متبقية، فعّالة ضد الجراثيم موجبة وسالبة الغرام، وتساعد على إزالة الأوساخ بوجود عوامل تنظيف سطحية. صيغة 2% كلورهِكسيدين جلوكونات، بدون شطف، وجرعة متجانسة وسهلة الاستخدام.',
            'short_description_en' => 'Disinfectant wipes used to decontaminate and reduce microbial load. The active antimicrobial formula provides residual bactericidal activity, effective against Gram positive and Gram negative organisms, and helps remove dirt with cleansing/surface active agents. 2% Chlorhexidine Gluconate, rinse free, with uniform dosage and convenient use.',
            'description' => 'فعالية مستمرة مضادّة للميكروبات (Residual protection)، مع ادعاء قتل 99.99% من الجراثيم. فعّالة ضد MRSA و VRE وفق المعروض. صيغة 2% Chlorhexidine Gluconate ومعتمدة FDA كما هو مذكور في المادة. بدون شطف وتتلاءم مع انحناءات الجسم (سهولة الاستخدام). ادعاء حماية متبقية حتى 8 ساعات. يقلّل الاستحمام اليومي بالكلورهيكسيدين العدوى المكتسبة بالمستشفيات بنسبة 70%. موصى به من الأطباء والممرضين.',
            'description_en' => 'Persistent anti microbial protection with a 99.99% germ kill claim. Effective against MRSA and VRE (as shown). 2% Chlorhexidine Gluconate formula, FDA approved (per material). Rinse free; comfortably conforms to body curves. Up to 8 hours residual protection. Daily bathing with chlorhexidine reduces HAIs by 70%. Recommended by doctors & nurses.',
            'specs' => [
                'active_ingredient' => '2% Chlorhexidine Gluconate',
                'effectiveness' => '99.99% germ kill',
                'protection_duration' => 'Up to 8 hours residual protection',
                'fda_approved' => 'Yes',
                'rinse_free' => 'Yes'
            ],
            'meta_title' => 'مناديل ECO Protect المطهِّرة 2% كلورهيكسيدين (بدون شطف)',
            'meta_title_en' => 'ECO Protect Antimicrobial Wipes – 2% Chlorhexidine (Rinse Free)',
            'meta_description' => 'مناديل مطهِّرة بصيغة 2% كلورهيكسيدين، فعالية مبيدة متبقية وقتل 99.99% من الجراثيم، فعّالة ضد Gram+/Gram ، مناسبة للاستخدام السريري.',
            'meta_description_en' => 'Disinfectant wipes with 2% Chlorhexidine; residual protection and 99.99% germ kill; effective against Gram+/Gram  organisms; convenient, rinse free use.',
        ]);

        $product2 = Product::create([
            'category_id' => $infectionControl->id,
            'name' => 'MoM n PoP – مناديل العناية بالبشرة للبالغين',
            'name_en' => 'MoM n PoP – Adult Skincare Wipes',
            'slug' => 'mom-pop-adult-skincare-wipes',
            'sku' => 'MNP-AD20',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'مناديل مبللة ناعمة وكبيرة الحجم، مصممة للاستحمام والعناية بالبشرة للبالغين، تساعد على الترطيب، التنظيف والحماية من الطفح الجلدي الناتج عن الحفاضات.',
            'short_description_en' => 'Large, soft wipes for adult skin care and bathing. Provide 3-in-1 action: moisturize, clean, and protect, especially in diaper care routines.',
            'description' => 'مناديل MoM n PoP تم تطويرها خصيصًا للعناية بالبشرة الحساسة للبالغين، وتحتوي على تركيبة مهدئة تشمل الألوفيرا، فيتامين E، BZK، والسيليكون. تعمل على ترطيب البشرة وتنظيفها وقتل البكتيريا دون الحاجة للشطف. ناعمة جدًا لتفادي التهيجات وتساعد على الوقاية من الطفح الجلدي. مثالية للمرضى كبار السن أو أصحاب الأمراض المناعية.',
            'description_en' => 'MoM n PoP wipes are developed for sensitive adult skin, formulated with Aloe Vera, Vitamin E, BZK, and silicon agents. They offer bactericidal action while gently cleansing and moisturizing the skin. No rinse required. Super soft cellulose-based wipes reduce skin tearing. Ideal for elderly or immunocompromised patients.',
            'specs' => [
                'ingredients' => 'Aloe Vera, Vitamin E, BZK, Silicon',
                'action' => '3-in-1: Moisturize, Clean, Protect',
                'material' => 'Super soft cellulose',
                'rinse_required' => 'No',
                'target_use' => 'Adult diaper care and bathing'
            ],
            'option_tables' => [
                [
                    'title' => 'خيارات التعبئة المتاحة',
                    'title_en' => 'Available Packaging Options',
                    'description' => 'أحجام مختلفة من العبوات لتناسب احتياجات مختلفة',
                    'description_en' => 'Different pack sizes to suit various needs',
                    'columns' => ['حجم العبوة', 'الوصف', 'عدد المناديل'],
                    'columns_en' => ['Pack Size', 'Description', 'Wipes per Pack'],
                    'rows' => [
                        ["20's", "Adult Skincare Wipes for Bathing & Diaper Care", "20"],
                        ["40's", "Adult Skincare Wipes for Bathing & Diaper Care", "40"]
                    ]
                ]
            ],
            'meta_title' => 'مناديل MoM n PoP للعناية ببشرة البالغين',
            'meta_title_en' => 'MoM n PoP Adult Skincare Wipes for Bathing & Diaper Use',
            'meta_description' => 'مناديل ناعمة وكبيرة الحجم للعناية بالبشرة والاستحمام، بدون شطف، تساعد على ترطيب وتنظيف الجلد ومنع الطفح الجلدي.',
            'meta_description_en' => 'Large, no-rinse wipes for adult skin care and diaper use. Clean, moisturize, and protect skin—formulated with Aloe Vera and Vitamin E.',
        ]);

        // Create products for Wound Care
        $product3 = Product::create([
            'category_id' => $woundCare->id,
            'name' => 'THERUPTOR™ NOVO – ضمادة ثلاثية الأبعاد مضادة للميكروبات',
            'name_en' => 'THERUPTOR™ NOVO – 3D Hydrocellular Microbicidal Dressing',
            'slug' => 'theruptor-novo-3d-microbicidal-dressing',
            'sku' => 'TNV-7575',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'ضمادة طبية ثلاثية الأبعاد، مضادة للميكروبات، تعتمد على تقنية مبتكرة للقضاء الفيزيائي على البكتيريا، مناسبة للجروح المزمنة.',
            'short_description_en' => '3D antimicrobial wound dressing that uses a patented Physical Kill Mechanism (PKM) to reduce microbial load. Designed for chronic wounds.',
            'description' => 'THERUPTOR™ NOVO هي ضمادة طبية متقدمة للجروح المزمنة تعتمد على آلية قتل فيزيائي (PKM) حاصل على براءة اختراع، حيث تقوم بجذب البكتيريا، ربطها ثم تمزيقها، مما يقلل من الحمل الميكروبي بنسبة 99.99% خلال 30 دقيقة. فعالية مضادة للميكروبات تدوم حتى 7 أيام دون نفاد، وتُقلل الألم عند تغيير الضمادة. فعالة ضد مجموعة واسعة من الكائنات الدقيقة بما فيها G+، G−، MRSA والفطريات، وتساعد في إدارة الإفرازات والرطوبة في الجروح. مناسبة لقرح القدم السكري، قرح الساق، والحروق.',
            'description_en' => 'THERUPTOR™ NOVO is an advanced 3D wound dressing featuring a patented Physical Kill Mechanism (PKM) that attracts, binds, and ruptures microbes. Demonstrated to reduce microbial load by 99.99% within 30 minutes and offers lasting antimicrobial efficacy for up to 7 days. The dressing is non-adherent, provides broad-spectrum antimicrobial action, minimizes pain during dressing changes, and is ideal for managing exudate and moisture in chronic wounds. Suitable for Diabetic Foot Ulcers, Leg Ulcers, and Burns.',
            'specs' => [
                'mechanism' => 'Physical Kill Mechanism (PKM)',
                'efficacy' => '99.99% microbial reduction in 30 minutes',
                'duration' => 'Up to 7 days antimicrobial action',
                'indications' => 'Diabetic Foot Ulcers, Leg Ulcers, Burns',
                'pain_reduction' => 'Yes, during dressing changes'
            ],
            'option_tables' => [
                [
                    'title' => 'معلومات الطلب',
                    'title_en' => 'Ordering Information',
                    'description' => 'أكواد المنتج والأحجام المتاحة',
                    'description_en' => 'Product codes and available sizes',
                    'columns' => ['الكود', 'الوصف', 'عدد القطع/العبوة'],
                    'columns_en' => ['CODE', 'DESCRIPTION', 'NO OF UNITS/BOX'],
                    'rows' => [
                        ["TNV7575", "Antimicrobial Chronic Wound Dressing – For Managing Exudate & Moisture", "20"],
                        ["TNV1010", "Antimicrobial Chronic Wound Dressing – For Managing Exudate & Moisture", "10"],
                        ["TNV1515", "Antimicrobial Chronic Wound Dressing – For Managing Exudate & Moisture", "10"]
                    ]
                ]
            ],
            'meta_title' => 'ضمادة THERUPTOR NOVO ثلاثية الأبعاد للجروح المزمنة',
            'meta_title_en' => 'THERUPTOR™ NOVO – 3D Antimicrobial Dressing for Chronic Wounds',
            'meta_description' => 'ضمادة مبتكرة تعتمد على آلية قتل فيزيائي للقضاء على 99.99% من الميكروبات خلال 30 دقيقة، فعالية تدوم حتى 7 أيام.',
            'meta_description_en' => 'Advanced 3D wound dressing using Physical Kill Mechanism (PKM) – eliminates 99.99% of microbes in 30 minutes, lasting up to 7 days.',
        ]);

        $product4 = Product::create([
            'category_id' => $woundCare->id,
            'name' => 'THERUPTOR™ NXT – ضمادة ثلاثية الأبعاد مضادة للميكروبات',
            'name_en' => 'THERUPTOR™ NXT – 3D Microbicidal Composite Dressing',
            'slug' => 'theruptor-nxt-3d-microbicidal-composite-dressing',
            'sku' => 'TNX0607',
            'hero_image' => 'products/placeholder.svg',
            'short_description' => 'ضمادة طبية بعد العمليات الجراحية، غير لاصقة، مقاومة للماء، تقلل العدوى وتحسن التئام الجروح وتقلل الألم أثناء التغيير.',
            'short_description_en' => 'A sterile, waterproof, non-adherent 3D microbicidal dressing for post-operative wounds. Reduces infection risk and pain while enhancing healing.',
            'description' => 'THERUPTOR™ NXT هي ضمادة مبتكرة ما بعد العمليات الجراحية، تعتمد على تقنية PKM الحاصلة على براءة اختراع (Attract, Bind, Rupture)، لتقليل الحمل الميكروبي بنسبة 99.99%، وتتميز بتركيبة خلوية ثلاثية الأبعاد، وطبقة واقية ضد الماء، وتقلل خطر العدوى والألم، وتُسهّل التئام الجروح. تعليمات الاستخدام: قبل الاستخدام نظف الجرح جيدًا، دع المحلول المطهر يجف، لا تستخدم على الجلد الرطب. أثناء الاستخدام لا تلمس الطبقة اللاصقة، تأكد من تغطية الجرح بالكامل، أزل الغشاء بهدوء وثبّت الضمادة. بعد التثبيت تأكد من عدم وجود فراغات.',
            'description_en' => 'THERUPTOR™ NXT is a next-gen postoperative wound dressing with a patented PKM (Physical Kill Mechanism) that attracts, binds, and ruptures microbes. Offers waterproof protection, non-adherent application, and 99.99% microbial load reduction, while reducing surgical site infections and pain during dressing changes. Instructions: Before use clean the wound thoroughly, let antiseptic solution dry, do not use on wet skin. During use do not touch the adhesive layer, ensure complete wound coverage, remove backing gently and secure dressing. After application ensure no gaps remain.',
            'specs' => [
                'type' => 'ضمادة مضادة للميكروبات ثلاثية الطبقات',
                'use' => 'ما بعد العمليات الجراحية',
                'efficacy' => 'تقليل الحمل الميكروبي بنسبة 99.99%',
                'mechanism' => 'PKM – Attract | Bind | Rupture',
                'layers' => 'طبقة خلوية + طبقة داعمة + طبقة لاصقة مقاومة للماء',
                'waterproof' => 'نعم',
                'non_adherent' => 'نعم',
                'pain_reduction' => 'نعم، أثناء تغيير الضمادة',
                'optimal_use' => 'تنظيف الجرح جيداً، عدم الاستخدام على الجلد الرطب'
            ],
            'option_tables' => [
                [
                    'title' => 'متاح في 7 أحجام',
                    'title_en' => 'Available in 7 Sizes',
                    'description' => 'أحجام مختلفة من الضمادات لتناسب أنواع الجروح المختلفة',
                    'description_en' => 'Different dressing sizes to suit various wound types',
                    'columns' => ['الكود', 'حجم الضمادة', 'حجم الوسادة', 'عدد العبوات/الصندوق'],
                    'columns_en' => ['Code', 'Dressing Size', 'Pad Size', 'No. of packs/box'],
                    'rows' => [
                        ["TNX0607", "6 X 7 cm", "2 X 3 cm", "20"],
                        ["TNX0810", "8 X 10 cm", "3 X 5 cm", "20"],
                        ["TNX1015", "10 X 15 cm", "5 X 10 cm", "10"],
                        ["TNX1020", "10 X 20 cm", "5 X 15 cm", "10"],
                        ["TNX1025", "10 X 25 cm", "5 X 20 cm", "10"],
                        ["TNX1030", "10 X 30 cm", "5 X 25 cm", "10"],
                        ["TNX1035", "10 X 35 cm", "5 X 30 cm", "10"]
                    ]
                ]
            ],
            'meta_title' => 'ضمادة THERUPTOR NXT للجروح بعد العمليات',
            'meta_title_en' => 'THERUPTOR™ NXT – Microbicidal Post-Op Wound Dressing',
            'meta_description' => 'ضمادة طبية مقاومة للماء وغير لاصقة تقلل العدوى بعد العمليات الجراحية وتُسرّع التئام الجروح، بتقنية قتل الميكروبات بنسبة 99.99%.',
            'meta_description_en' => 'Advanced post-op wound dressing with patented PKM tech. Waterproof, non-adherent, and reduces microbial load by 99.99%. Available in 7 sizes.',
        ]);

        // Create sample product images
        $products = [$product1, $product2, $product3, $product4];
        
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
