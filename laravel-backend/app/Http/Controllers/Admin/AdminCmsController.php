<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutCoreValue;
use App\Models\AboutStat;
use App\Models\HeroAdvantage;
use App\Models\HeroQuickLink;
use App\Models\MissionPillar;
use App\Models\PageContent;
use App\Models\PageImage;
use App\Models\PortfolioProject;
use App\Models\SeoSetting;
use App\Models\Testimonial;
use App\Models\WhyUsFeature;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCmsController extends Controller
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {}

    /**
     * Display CMS dashboard
     */
    public function index(): View
    {
        return view('admin.cms.index');
    }

    // ==================== Page Content Management ====================

    /**
     * Display page content management
     */
    public function pageContent(Request $request): View
    {
        $pageKey = $request->get('page', 'hero');
        $content = PageContent::forPage($pageKey)->orderBy('order')->get()->groupBy('section_key');
        
        return view('admin.cms.page-content', compact('content', 'pageKey'));
    }

    /**
     * Store or update page content
     */
    public function storePageContent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page_key' => 'required|string',
            'section_key' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'type' => 'nullable|string|in:text,image,json',
        ]);

        PageContent::updateOrCreate(
            [
                'page_key' => $validated['page_key'],
                'section_key' => $validated['section_key'],
            ],
            $validated
        );

        return redirect()->back()->with('success', 'Content updated successfully');
    }

    // ==================== Testimonials Management ====================

    /**
     * Display testimonials management
     */
    public function testimonials(): View
    {
        $testimonials = Testimonial::orderBy('order')->paginate(15);
        return view('admin.cms.testimonials.index', compact('testimonials'));
    }

    /**
     * Show form to create/edit testimonial
     */
    public function testimonialForm(?Testimonial $testimonial = null): View
    {
        return view('admin.cms.testimonials.form', compact('testimonial'));
    }

    /**
     * Store testimonial
     */
    public function storeTestimonial(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'author_name_en' => 'required|string|max:255',
            'author_name_ar' => 'required|string|max:255',
            'author_role_en' => 'required|string|max:255',
            'author_role_ar' => 'required|string|max:255',
            'quote_en' => 'required|string',
            'quote_ar' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $this->fileUploadService->uploadImage($request->file('avatar'), 'testimonials');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.cms.testimonials')->with('success', 'Testimonial created successfully');
    }

    /**
     * Update testimonial
     */
    public function updateTestimonial(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'author_name_en' => 'required|string|max:255',
            'author_name_ar' => 'required|string|max:255',
            'author_role_en' => 'required|string|max:255',
            'author_role_ar' => 'required|string|max:255',
            'quote_en' => 'required|string',
            'quote_ar' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $this->fileUploadService->uploadImage($request->file('avatar'), 'testimonials');
        }

        $testimonial->update($validated);
        return redirect()->route('admin.cms.testimonials')->with('success', 'Testimonial updated successfully');
    }

    /**
     * Delete testimonial
     */
    public function deleteTestimonial(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return redirect()->back()->with('success', 'Testimonial deleted successfully');
    }

    // ==================== Portfolio Projects Management ====================

    /**
     * Display portfolio projects management
     */
    public function portfolioProjects(): View
    {
        $projects = PortfolioProject::orderBy('order')->paginate(15);
        return view('admin.cms.portfolio.index', compact('projects'));
    }

    /**
     * Show form to create/edit portfolio project
     */
    public function portfolioProjectForm(?PortfolioProject $project = null): View
    {
        return view('admin.cms.portfolio.form', compact('project'));
    }

    /**
     * Store portfolio project
     */
    public function storePortfolioProject(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'category_key' => 'required|string|in:Branding,Advertising,Digital,Production,Strategy',
            'image' => 'required|image|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUploadService->uploadImage($request->file('image'), 'portfolio');
        }

        if ($request->hasFile('images')) {
            $validated['images'] = $this->fileUploadService->uploadMultiple($request->file('images'), 'portfolio');
        }

        PortfolioProject::create($validated);
        return redirect()->route('admin.cms.portfolio')->with('success', 'Portfolio project created successfully');
    }

    /**
     * Update portfolio project
     */
    public function updatePortfolioProject(Request $request, PortfolioProject $project): RedirectResponse
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'category_key' => 'required|string|in:Branding,Advertising,Digital,Production,Strategy',
            'image' => 'nullable|image|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUploadService->uploadImage($request->file('image'), 'portfolio');
        }

        if ($request->hasFile('images')) {
            $validated['images'] = $this->fileUploadService->uploadMultiple($request->file('images'), 'portfolio');
        }

        $project->update($validated);
        return redirect()->route('admin.cms.portfolio')->with('success', 'Portfolio project updated successfully');
    }

    /**
     * Delete portfolio project
     */
    public function deletePortfolioProject(PortfolioProject $project): RedirectResponse
    {
        $project->delete();
        return redirect()->back()->with('success', 'Portfolio project deleted successfully');
    }

    // ==================== Mission Pillars Management ====================

    /**
     * Display mission pillars management
     */
    public function missionPillars(): View
    {
        $pillars = MissionPillar::orderBy('order')->get();
        return view('admin.cms.mission-pillars.index', compact('pillars'));
    }

    /**
     * Store or update mission pillar
     */
    public function storeMissionPillar(Request $request, ?MissionPillar $pillar = null): RedirectResponse
    {
        $validated = $request->validate([
            'number' => 'required|string|max:10',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($pillar) {
            $pillar->update($validated);
            $message = 'Mission pillar updated successfully';
        } else {
            MissionPillar::create($validated);
            $message = 'Mission pillar created successfully';
        }

        return redirect()->route('admin.cms.mission-pillars')->with('success', $message);
    }

    /**
     * Delete mission pillar
     */
    public function deleteMissionPillar(MissionPillar $pillar): RedirectResponse
    {
        $pillar->delete();
        return redirect()->back()->with('success', 'Mission pillar deleted successfully');
    }

    // ==================== Hero Sections Management ====================

    /**
     * Display hero quick links management
     */
    public function heroQuickLinks(): View
    {
        $links = HeroQuickLink::orderBy('order')->get();
        return view('admin.cms.hero.quick-links', compact('links'));
    }

    /**
     * Store or update hero quick link
     */
    public function storeHeroQuickLink(Request $request, ?HeroQuickLink $link = null): RedirectResponse
    {
        $validated = $request->validate([
            'number' => 'required|string|max:10',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($link) {
            $link->update($validated);
            $message = 'Hero quick link updated successfully';
        } else {
            HeroQuickLink::create($validated);
            $message = 'Hero quick link created successfully';
        }

        return redirect()->route('admin.cms.hero-quick-links')->with('success', $message);
    }

    /**
     * Delete hero quick link
     */
    public function deleteHeroQuickLink(HeroQuickLink $link): RedirectResponse
    {
        $link->delete();
        return redirect()->back()->with('success', 'Hero quick link deleted successfully');
    }

    /**
     * Display hero advantages management
     */
    public function heroAdvantages(): View
    {
        $advantages = HeroAdvantage::orderBy('order')->get();
        return view('admin.cms.hero.advantages', compact('advantages'));
    }

    /**
     * Store or update hero advantage
     */
    public function storeHeroAdvantage(Request $request, ?HeroAdvantage $advantage = null): RedirectResponse
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($advantage) {
            $advantage->update($validated);
            $message = 'Hero advantage updated successfully';
        } else {
            HeroAdvantage::create($validated);
            $message = 'Hero advantage created successfully';
        }

        return redirect()->route('admin.cms.hero-advantages')->with('success', $message);
    }

    /**
     * Delete hero advantage
     */
    public function deleteHeroAdvantage(HeroAdvantage $advantage): RedirectResponse
    {
        $advantage->delete();
        return redirect()->back()->with('success', 'Hero advantage deleted successfully');
    }

    // ==================== About Sections Management ====================

    /**
     * Display about stats management
     */
    public function aboutStats(): View
    {
        $stats = AboutStat::orderBy('order')->get();
        return view('admin.cms.about.stats', compact('stats'));
    }

    /**
     * Store or update about stat
     */
    public function storeAboutStat(Request $request, ?AboutStat $stat = null): RedirectResponse
    {
        $validated = $request->validate([
            'label_en' => 'required|string|max:255',
            'label_ar' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($stat) {
            $stat->update($validated);
            $message = 'About stat updated successfully';
        } else {
            AboutStat::create($validated);
            $message = 'About stat created successfully';
        }

        return redirect()->route('admin.cms.about-stats')->with('success', $message);
    }

    /**
     * Delete about stat
     */
    public function deleteAboutStat(AboutStat $stat): RedirectResponse
    {
        $stat->delete();
        return redirect()->back()->with('success', 'About stat deleted successfully');
    }

    /**
     * Display about core values management
     */
    public function aboutCoreValues(): View
    {
        $values = AboutCoreValue::orderBy('order')->get();
        return view('admin.cms.about.core-values', compact('values'));
    }

    /**
     * Store or update about core value
     */
    public function storeAboutCoreValue(Request $request, ?AboutCoreValue $value = null): RedirectResponse
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($value) {
            $value->update($validated);
            $message = 'About core value updated successfully';
        } else {
            AboutCoreValue::create($validated);
            $message = 'About core value created successfully';
        }

        return redirect()->route('admin.cms.about-core-values')->with('success', $message);
    }

    /**
     * Delete about core value
     */
    public function deleteAboutCoreValue(AboutCoreValue $value): RedirectResponse
    {
        $value->delete();
        return redirect()->back()->with('success', 'About core value deleted successfully');
    }

    // ==================== Why Us Features Management ====================

    /**
     * Display why us features management
     */
    public function whyUsFeatures(): View
    {
        $features = WhyUsFeature::orderBy('order')->get();
        return view('admin.cms.why-us.index', compact('features'));
    }

    /**
     * Store or update why us feature
     */
    public function storeWhyUsFeature(Request $request, ?WhyUsFeature $feature = null): RedirectResponse
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($feature) {
            $feature->update($validated);
            $message = 'Why us feature updated successfully';
        } else {
            WhyUsFeature::create($validated);
            $message = 'Why us feature created successfully';
        }

        return redirect()->route('admin.cms.why-us-features')->with('success', $message);
    }

    /**
     * Delete why us feature
     */
    public function deleteWhyUsFeature(WhyUsFeature $feature): RedirectResponse
    {
        $feature->delete();
        return redirect()->back()->with('success', 'Why us feature deleted successfully');
    }

    // ==================== SEO Settings Management ====================

    /**
     * Display SEO settings management
     */
    public function seoSettings(): View
    {
        $seoSettings = SeoSetting::all()->keyBy('page_key');
        return view('admin.cms.seo.index', compact('seoSettings'));
    }

    /**
     * Store or update SEO setting
     */
    public function storeSeoSetting(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page_key' => 'required|string',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_description_en' => 'nullable|string|max:500',
            'meta_description_ar' => 'nullable|string|max:500',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $this->fileUploadService->uploadImage($request->file('og_image'), 'seo');
        }

        SeoSetting::updateOrCreate(
            ['page_key' => $validated['page_key']],
            $validated
        );

        return redirect()->route('admin.cms.seo-settings')->with('success', 'SEO settings updated successfully');
    }

    // ==================== Page Images Management ====================

    /**
     * Display page images management
     */
    public function pageImages(Request $request): View
    {
        $pageKey = $request->get('page', 'hero');
        $images = PageImage::forPage($pageKey)->orderBy('order')->get();
        return view('admin.cms.images.index', compact('images', 'pageKey'));
    }

    /**
     * Store page image
     */
    public function storePageImage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page_key' => 'required|string',
            'image_key' => 'required|string',
            'image' => 'required|image|max:5120',
            'alt_text_en' => 'nullable|string|max:255',
            'alt_text_ar' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $validated['image_path'] = $this->fileUploadService->uploadImage($request->file('image'), 'pages');

        PageImage::create($validated);
        return redirect()->back()->with('success', 'Page image uploaded successfully');
    }

    /**
     * Delete page image
     */
    public function deletePageImage(PageImage $image): RedirectResponse
    {
        $image->delete();
        return redirect()->back()->with('success', 'Page image deleted successfully');
    }
}
