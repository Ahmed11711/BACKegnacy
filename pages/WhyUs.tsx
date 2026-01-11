
import React from 'react';
import { useI18n } from '../contexts/I18nContext';

const WhyUs: React.FC = () => {
  const { t } = useI18n();

  const features = [
    { icon: 'business_center', title: t('whyUs.feature1.title'), desc: t('whyUs.feature1.description') },
    { icon: 'verified', title: t('whyUs.feature2.title'), desc: t('whyUs.feature2.description') },
    { icon: 'lightbulb', title: t('whyUs.feature3.title'), desc: t('whyUs.feature3.description') },
    { icon: 'handshake', title: t('whyUs.feature4.title'), desc: t('whyUs.feature4.description') },
    { icon: 'schedule', title: t('whyUs.feature5.title'), desc: t('whyUs.feature5.description') },
  ];

  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213] dark:bg-[#201213] light:bg-gray-50">
      <div className="max-w-[1280px] mx-auto">
        <section className="flex flex-col md:flex-row gap-12 items-end mb-24">
          <div className="flex-1 space-y-6">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/5 dark:border-white/5 light:border-gray-200 bg-secondary-gray/10 dark:bg-secondary-gray/10 light:bg-gray-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-primary">
              <span className="size-2 rounded-full bg-primary animate-pulse"></span>
              {t('whyUs.badge')}
            </div>
            <h1 className="text-5xl md:text-7xl font-black text-white dark:text-white light:text-gray-900 leading-tight tracking-tighter">
              {t('whyUs.title1')} <br/>
              <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary to-rose-400">{t('whyUs.title2')}</span>
            </h1>
            <p className="max-w-2xl text-lg text-gray-400 dark:text-gray-400 light:text-gray-600 leading-relaxed">
              {t('whyUs.subtitle')}
            </p>
          </div>
          <div className="flex gap-12 border-l border-white/10 dark:border-white/10 light:border-gray-200 pl-12">
            <div>
              <div className="text-4xl font-black text-white dark:text-white light:text-gray-900">150+</div>
              <div className="text-sm text-gray-500 dark:text-gray-500 light:text-gray-600 uppercase tracking-widest font-bold mt-1">{t('whyUs.stats.globalClients')}</div>
            </div>
            <div>
              <div className="text-4xl font-black text-white dark:text-white light:text-gray-900">12</div>
              <div className="text-sm text-gray-500 dark:text-gray-500 light:text-gray-600 uppercase tracking-widest font-bold mt-1">{t('whyUs.stats.yearsActive')}</div>
            </div>
          </div>
        </section>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {features.map((f, i) => (
            <div key={i} className="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-white/5 dark:border-white/5 light:border-gray-200 bg-card-dark dark:bg-card-dark light:bg-white p-10 transition-all hover:border-primary/50 hover:bg-[#361e21] dark:hover:bg-[#361e21] light:hover:bg-gray-100 hover:shadow-2xl hover:shadow-primary/5">
              <div className="absolute -right-12 -top-12 size-40 rounded-full bg-primary/5 blur-3xl transition-all group-hover:bg-primary/10"></div>
              <div className="mb-8 inline-flex size-16 items-center justify-center rounded-xl bg-secondary-gray/20 dark:bg-secondary-gray/20 light:bg-gray-100 text-white dark:text-white light:text-gray-900 group-hover:bg-primary transition-all duration-500">
                <span className="material-symbols-outlined text-4xl">{f.icon}</span>
              </div>
              <div>
                <h3 className="mb-4 text-2xl font-bold text-white dark:text-white light:text-gray-900">{f.title}</h3>
                <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 leading-relaxed text-base">{f.desc}</p>
              </div>
            </div>
          ))}
          <div className="relative flex flex-col justify-center items-center text-center rounded-2xl border-2 border-dashed border-white/10 dark:border-white/10 light:border-gray-300 bg-transparent p-10 hover:bg-card-dark dark:hover:bg-card-dark light:hover:bg-gray-100 transition-all group cursor-pointer">
            <div className="mb-6 rounded-full bg-primary/10 p-5 text-primary group-hover:bg-primary group-hover:text-white transition-all">
              <span className="material-symbols-outlined text-4xl">arrow_forward</span>
            </div>
            <h3 className="text-2xl font-bold text-white dark:text-white light:text-gray-900">{t('whyUs.ctaCard.title')}</h3>
            <p className="mt-2 text-gray-400 dark:text-gray-400 light:text-gray-600">{t('whyUs.ctaCard.description')}</p>
          </div>
        </div>

        <section className="relative mt-32 border-t border-white/5 dark:border-white/5 light:border-gray-200 py-24 text-center overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>
          <div className="relative z-10 max-w-4xl mx-auto px-6">
            <h2 className="text-4xl md:text-5xl font-black text-white dark:text-white light:text-gray-900 mb-6">{t('whyUs.cta.title')}</h2>
            <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-xl mb-12">
              {t('whyUs.cta.description')}
            </p>
            <div className="flex flex-col sm:flex-row items-center justify-center gap-6">
              <button className="bg-primary hover:bg-primary-dark text-white px-10 py-4 rounded-xl font-bold text-lg shadow-2xl shadow-primary/30 transition-all hover:-translate-y-1">
                {t('whyUs.cta.startProject')}
              </button>
              <button className="bg-transparent border border-white/20 dark:border-white/20 light:border-gray-300 hover:border-white dark:hover:border-white light:hover:border-gray-900 text-white dark:text-white light:text-gray-900 px-10 py-4 rounded-xl font-bold text-lg transition-all">
                {t('whyUs.cta.viewPortfolio')}
              </button>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
};

export default WhyUs;
