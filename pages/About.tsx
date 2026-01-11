
import React from 'react';
import { useI18n } from '../contexts/I18nContext';

const About: React.FC = () => {
  const { t } = useI18n();

  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213] dark:bg-[#201213] light:bg-gray-50">
      <div className="max-w-[1200px] mx-auto flex flex-col gap-24">
        <section className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div className="flex flex-col gap-8">
            <div className="flex items-center gap-3">
              <div className="h-1 w-12 bg-primary rounded-full"></div>
              <span className="text-primary text-sm font-bold tracking-widest uppercase">{t('about.label')}</span>
            </div>
            <h1 className="text-white dark:text-white light:text-gray-900 text-4xl md:text-6xl font-black leading-tight">
              {t('about.title1')} <br/> <span className="text-primary">{t('about.title2')}</span>
            </h1>
            <p className="text-gray-300 dark:text-gray-300 light:text-gray-700 text-lg font-normal leading-relaxed">
              {t('about.description')}
            </p>
            <div className="grid grid-cols-2 sm:grid-cols-3 gap-8 py-4">
              <div className="flex flex-col gap-1 border-l-2 border-primary/30 pl-4">
                <p className="text-white dark:text-white light:text-gray-900 text-4xl font-black">10+</p>
                <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-xs font-bold uppercase tracking-widest">{t('about.stats.years')}</p>
              </div>
              <div className="flex flex-col gap-1 border-l-2 border-primary/30 pl-4">
                <p className="text-white dark:text-white light:text-gray-900 text-4xl font-black">500+</p>
                <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-xs font-bold uppercase tracking-widest">{t('about.stats.projects')}</p>
              </div>
              <div className="flex flex-col gap-1 border-l-2 border-primary/30 pl-4">
                <p className="text-white dark:text-white light:text-gray-900 text-4xl font-black">50</p>
                <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-xs font-bold uppercase tracking-widest">{t('about.stats.globalClients')}</p>
              </div>
            </div>
            <div>
              <button className="bg-primary hover:bg-primary-dark text-white font-bold h-14 px-10 rounded-lg transition-all shadow-lg shadow-primary/20">
                {t('about.viewCapabilities')}
              </button>
            </div>
          </div>
          <div className="relative">
            <div 
              className="w-full aspect-[4/3] rounded-2xl bg-cover bg-center shadow-2xl overflow-hidden border border-white/5 dark:border-white/5 light:border-gray-200"
              style={{ backgroundImage: "url('https://lh3.googleusercontent.com/aida-public/AB6AXuB8k98PH1cIsdLy_bctknxRvn039OCwnzAvU1D5e8ghoiB1NOPe1s9kh9Fi3EkZmUi1lxNujxrYt_Qx9NyD_cWbMcgP7cGk-zhvhXmxNLYVzNYtvpUYBE8xyOOHexLrF1Tc2pt1WOHupgGRIv47DfL6czg3qtvIQXFHXAq8_l4RyZlmRHQ5f8kYSbEt3rK4nmy3ij_OgAfJ9WNopiuvdb2tW3VIWbPNKD8jcZWlH-EOm1tkRAF2H_HeI0LWAo1ACR8ktNPS654lWMg')" }}
            >
              <div className="absolute inset-0 bg-gradient-to-t from-[#201213]/80 dark:from-[#201213]/80 light:from-gray-50/80 to-transparent"></div>
            </div>
            <div className="absolute -bottom-6 -left-6 flex items-center gap-4 rounded-xl bg-card-dark dark:bg-card-dark light:bg-white p-6 border border-white/10 dark:border-white/10 light:border-gray-200 shadow-2xl backdrop-blur-md">
              <div className="flex h-14 w-14 items-center justify-center rounded-full bg-primary/20 text-primary">
                <span className="material-symbols-outlined text-3xl">award_star</span>
              </div>
              <div>
                <p className="text-white dark:text-white light:text-gray-900 text-base font-bold">{t('about.awardWinning')}</p>
                <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-xs uppercase tracking-widest font-bold">{t('about.topAgency')}</p>
              </div>
            </div>
          </div>
        </section>

        <section className="bg-secondary-gray/5 dark:bg-secondary-gray/5 light:bg-gray-100 rounded-3xl p-12 md:p-20 border border-white/5 dark:border-white/5 light:border-gray-200">
          <div className="text-center mb-16">
            <h2 className="text-white dark:text-white light:text-gray-900 text-3xl md:text-5xl font-black mb-6">{t('about.coreValues.title')}</h2>
            <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-lg max-w-2xl mx-auto">{t('about.coreValues.subtitle')}</p>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div className="group flex flex-col gap-4 rounded-xl border border-white/5 dark:border-white/5 light:border-gray-200 bg-card-dark dark:bg-card-dark light:bg-white p-10 transition-all hover:border-primary/50 hover:bg-[#311c1d] dark:hover:bg-[#311c1d] light:hover:bg-gray-200">
              <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-primary text-white mb-2">
                <span className="material-symbols-outlined">layers</span>
              </div>
              <h3 className="text-white dark:text-white light:text-gray-900 text-xl font-bold">{t('about.coreValues.value1.title')}</h3>
              <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-sm leading-relaxed">{t('about.coreValues.value1.description')}</p>
            </div>
            <div className="group flex flex-col gap-4 rounded-xl border border-white/5 dark:border-white/5 light:border-gray-200 bg-card-dark dark:bg-card-dark light:bg-white p-10 transition-all hover:border-primary/50 hover:bg-[#311c1d] dark:hover:bg-[#311c1d] light:hover:bg-gray-200">
              <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-primary text-white mb-2">
                <span className="material-symbols-outlined">trending_up</span>
              </div>
              <h3 className="text-white dark:text-white light:text-gray-900 text-xl font-bold">{t('about.coreValues.value2.title')}</h3>
              <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-sm leading-relaxed">{t('about.coreValues.value2.description')}</p>
            </div>
            <div className="group flex flex-col gap-4 rounded-xl border border-white/5 dark:border-white/5 light:border-gray-200 bg-card-dark dark:bg-card-dark light:bg-white p-10 transition-all hover:border-primary/50 hover:bg-[#311c1d] dark:hover:bg-[#311c1d] light:hover:bg-gray-200">
              <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-primary text-white mb-2">
                <span className="material-symbols-outlined">auto_awesome</span>
              </div>
              <h3 className="text-white dark:text-white light:text-gray-900 text-xl font-bold">{t('about.coreValues.value3.title')}</h3>
              <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-sm leading-relaxed">{t('about.coreValues.value3.description')}</p>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
};

export default About;
