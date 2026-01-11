<?php

namespace App\Http\Controllers;

use App\Models\AboutCoreValue;
use App\Models\AboutStat;
use App\Models\HeroAdvantage;
use App\Models\HeroQuickLink;
use App\Models\MissionPillar;
use App\Models\PageContent;
use App\Models\PageImage;
use App\Models\PortfolioProject;
use App\Models\SeoSetting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\WhyUsFeature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CmsContentController extends Controller
{
    /**
     * Get all website content for a specific locale
     */
    public function index(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en'); // en or ar

        return response()->json([
            'data' => [
                'hero' => $this->getHeroContent($locale),
                'services' => $this->getServices($locale),
                'mission' => $this->getMissionContent($locale),
                'testimonials' => $this->getTestimonialsContent($locale),
                'about' => $this->getAboutContent($locale),
                'portfolio' => $this->getPortfolioContent($locale),
                'whyUs' => $this->getWhyUsContent($locale),
                'footer' => $this->getFooterContent($locale),
                'seo' => $this->getSeoSettings($locale),
            ],
        ]);
    }

    /**
     * Get hero page content
     */
    public function getHero(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getHeroContent($locale)]);
    }

    /**
     * Get services page content
     */
    public function getServicesPage(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getServices($locale)]);
    }

    /**
     * Get mission page content
     */
    public function getMission(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getMissionContent($locale)]);
    }

    /**
     * Get testimonials
     */
    public function getTestimonials(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getTestimonialsContent($locale)]);
    }

    /**
     * Get about page content
     */
    public function getAbout(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getAboutContent($locale)]);
    }

    /**
     * Get portfolio
     */
    public function getPortfolio(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getPortfolioContent($locale)]);
    }

    /**
     * Get why us page content
     */
    public function getWhyUs(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getWhyUsContent($locale)]);
    }

    /**
     * Get footer content
     */
    public function getFooter(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        return response()->json(['data' => $this->getFooterContent($locale)]);
    }

    /**
     * Get SEO settings for a page
     */
    public function getSeo(Request $request): JsonResponse
    {
        $locale = $request->get('locale', 'en');
        $pageKey = $request->get('page', 'hero');
        return response()->json(['data' => $this->getSeoSettings($locale, $pageKey)]);
    }

    /**
     * Helper: Get hero content
     */
    private function getHeroContent(string $locale): array
    {
        $content = PageContent::forPage('hero')->get()->keyBy('section_key');
        $images = PageImage::forPage('hero')->get()->keyBy('image_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
            'quickLinks' => HeroQuickLink::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($link) use ($locale) {
                    return [
                        'number' => $link->number,
                        'title' => $locale === 'ar' ? $link->title_ar : $link->title_en,
                        'description' => $locale === 'ar' ? $link->description_ar : $link->description_en,
                    ];
                })->toArray(),
            'advantages' => HeroAdvantage::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($advantage) use ($locale) {
                    return [
                        'title' => $locale === 'ar' ? $advantage->title_ar : $advantage->title_en,
                        'description' => $locale === 'ar' ? $advantage->description_ar : $advantage->description_en,
                    ];
                })->toArray(),
            'services' => Service::where('is_active', true)
                ->orderBy('order')
                ->limit(6)
                ->get()
                ->map(function ($service) use ($locale) {
                    return [
                        'id' => $service->id,
                        'title' => $locale === 'ar' ? $service->name_ar : $service->name,
                        'description' => $locale === 'ar' ? ($service->short_description_ar ?? $service->description_ar) : ($service->short_description ?? $service->description),
                        'icon' => $service->icon,
                    ];
                })->toArray(),
            'portfolio' => PortfolioProject::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->limit(3)
                ->get()
                ->map(function ($project) use ($locale) {
                    return [
                        'id' => $project->id,
                        'title' => $locale === 'ar' ? $project->title_ar : $project->title_en,
                        'category' => $locale === 'ar' ? $this->getCategoryTranslation($project->category_key, 'ar') : $this->getCategoryTranslation($project->category_key, 'en'),
                        'image' => $project->image,
                    ];
                })->toArray(),
            'testimonialQuote' => Testimonial::where('is_active', true)
                ->inRandomOrder()
                ->first(),
            'images' => $images->map(function ($image) use ($locale) {
                return [
                    'path' => $image->image_path,
                    'alt' => $locale === 'ar' ? $image->alt_text_ar : $image->alt_text_en,
                ];
            })->toArray(),
        ];
    }

    /**
     * Helper: Get services
     */
    private function getServices(string $locale): array
    {
        $content = PageContent::forPage('services')->get()->keyBy('section_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
            'services' => Service::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($service) use ($locale) {
                    return [
                        'id' => $service->id,
                        'title' => $locale === 'ar' ? $service->name_ar : $service->name,
                        'description' => $locale === 'ar' ? ($service->short_description_ar ?? $service->description_ar) : ($service->short_description ?? $service->description),
                        'icon' => $service->icon,
                    ];
                })->toArray(),
        ];
    }

    /**
     * Helper: Get mission content
     */
    private function getMissionContent(string $locale): array
    {
        $content = PageContent::forPage('mission')->get()->keyBy('section_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
            'pillars' => MissionPillar::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($pillar) use ($locale) {
                    return [
                        'number' => $pillar->number,
                        'title' => $locale === 'ar' ? $pillar->title_ar : $pillar->title_en,
                        'description' => $locale === 'ar' ? $pillar->description_ar : $pillar->description_en,
                        'icon' => $pillar->icon,
                    ];
                })->toArray(),
        ];
    }

    /**
     * Helper: Get testimonials content
     */
    private function getTestimonialsContent(string $locale): array
    {
        $content = PageContent::forPage('testimonials')->get()->keyBy('section_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
            'testimonials' => Testimonial::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($testimonial) use ($locale) {
                    return [
                        'id' => $testimonial->id,
                        'author' => $locale === 'ar' ? $testimonial->author_name_ar : $testimonial->author_name_en,
                        'role' => $locale === 'ar' ? $testimonial->author_role_ar : $testimonial->author_role_en,
                        'quote' => $locale === 'ar' ? $testimonial->quote_ar : $testimonial->quote_en,
                        'rating' => $testimonial->rating,
                        'avatar' => $testimonial->avatar,
                    ];
                })->toArray(),
        ];
    }

    /**
     * Helper: Get about content
     */
    private function getAboutContent(string $locale): array
    {
        $content = PageContent::forPage('about')->get()->keyBy('section_key');
        $images = PageImage::forPage('about')->get()->keyBy('image_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
            'stats' => AboutStat::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($stat) use ($locale) {
                    return [
                        'label' => $locale === 'ar' ? $stat->label_ar : $stat->label_en,
                        'value' => $stat->value,
                    ];
                })->toArray(),
            'coreValues' => AboutCoreValue::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($value) use ($locale) {
                    return [
                        'title' => $locale === 'ar' ? $value->title_ar : $value->title_en,
                        'description' => $locale === 'ar' ? $value->description_ar : $value->description_en,
                        'icon' => $value->icon,
                    ];
                })->toArray(),
            'images' => $images->map(function ($image) use ($locale) {
                return [
                    'path' => $image->image_path,
                    'alt' => $locale === 'ar' ? $image->alt_text_ar : $image->alt_text_en,
                ];
            })->toArray(),
        ];
    }

    /**
     * Helper: Get portfolio content
     */
    private function getPortfolioContent(string $locale): array
    {
        $content = PageContent::forPage('portfolio')->get()->keyBy('section_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
            'projects' => PortfolioProject::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($project) use ($locale) {
                    return [
                        'id' => $project->id,
                        'title' => $locale === 'ar' ? $project->title_ar : $project->title_en,
                        'description' => $locale === 'ar' ? $project->description_ar : $project->description_en,
                        'category' => $project->category_key,
                        'categoryLabel' => $locale === 'ar' ? $this->getCategoryTranslation($project->category_key, 'ar') : $this->getCategoryTranslation($project->category_key, 'en'),
                        'image' => $project->image,
                        'images' => $project->images ?? [],
                    ];
                })->toArray(),
        ];
    }

    /**
     * Helper: Get why us content
     */
    private function getWhyUsContent(string $locale): array
    {
        $content = PageContent::forPage('why_us')->get()->keyBy('section_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
            'features' => WhyUsFeature::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($feature) use ($locale) {
                    return [
                        'title' => $locale === 'ar' ? $feature->title_ar : $feature->title_en,
                        'description' => $locale === 'ar' ? $feature->description_ar : $feature->description_en,
                        'icon' => $feature->icon,
                    ];
                })->toArray(),
        ];
    }

    /**
     * Helper: Get footer content
     */
    private function getFooterContent(string $locale): array
    {
        $content = PageContent::forPage('footer')->get()->keyBy('section_key');

        return [
            'content' => $content->map(function ($item) use ($locale) {
                return $locale === 'ar' ? $item->content_ar : $item->content_en;
            })->toArray(),
        ];
    }

    /**
     * Helper: Get SEO settings
     */
    private function getSeoSettings(string $locale, ?string $pageKey = null): array
    {
        if ($pageKey) {
            $seo = SeoSetting::where('page_key', $pageKey)->first();
            if ($seo) {
                return [
                    'meta_title' => $locale === 'ar' ? $seo->meta_title_ar : $seo->meta_title_en,
                    'meta_description' => $locale === 'ar' ? $seo->meta_description_ar : $seo->meta_description_en,
                    'meta_keywords' => $locale === 'ar' ? $seo->meta_keywords_ar : $seo->meta_keywords_en,
                    'og_image' => $seo->og_image,
                ];
            }
        }

        return SeoSetting::all()->mapWithKeys(function ($seo) use ($locale) {
            return [$seo->page_key => [
                'meta_title' => $locale === 'ar' ? $seo->meta_title_ar : $seo->meta_title_en,
                'meta_description' => $locale === 'ar' ? $seo->meta_description_ar : $seo->meta_description_en,
                'meta_keywords' => $locale === 'ar' ? $seo->meta_keywords_ar : $seo->meta_keywords_en,
                'og_image' => $seo->og_image,
            ]];
        })->toArray();
    }

    /**
     * Helper: Get category translation
     */
    private function getCategoryTranslation(string $categoryKey, string $locale): string
    {
        $translations = [
            'en' => [
                'Branding' => 'Branding',
                'Advertising' => 'Advertising',
                'Digital' => 'Digital',
                'Production' => 'Production',
                'Strategy' => 'Strategy',
            ],
            'ar' => [
                'Branding' => 'العلامة التجارية',
                'Advertising' => 'إعلان',
                'Digital' => 'رقمي',
                'Production' => 'إنتاج',
                'Strategy' => 'استراتيجية',
            ],
        ];

        return $translations[$locale][$categoryKey] ?? $categoryKey;
    }
}
