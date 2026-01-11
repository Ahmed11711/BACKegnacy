
import React from 'react';
import { Service } from '../types';
import { useI18n } from '../contexts/I18nContext';

const Services: React.FC = () => {
  const { t } = useI18n();

  const services: Service[] = [
    { id: '1', title: t('services.service1.title'), description: t('services.service1.description'), icon: 'design_services' },
    { id: '2', title: t('services.service2.title'), description: t('services.service2.description'), icon: 'campaign' },
    { id: '3', title: t('services.service3.title'), description: t('services.service3.description'), icon: 'print' },
    { id: '4', title: t('services.service4.title'), description: t('services.service4.description'), icon: 'signpost' },
    { id: '5', title: t('services.service5.title'), description: t('services.service5.description'), icon: 'safety_divider' },
    { id: '6', title: t('services.service6.title'), description: t('services.service6.description'), icon: 'precision_manufacturing' },
    { id: '7', title: t('services.service7.title'), description: t('services.service7.description'), icon: 'architecture' },
    { id: '8', title: t('services.service8.title'), description: t('services.service8.description'), icon: 'theater_comedy' },
    { id: '9', title: t('services.service9.title'), description: t('services.service9.description'), icon: 'video_camera_front' },
  ];

  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213] dark:bg-[#201213] light:bg-gray-50">
      <div className="max-w-[1280px] mx-auto">
        <div className="text-center mb-16">
          <h1 className="text-white dark:text-white light:text-gray-900 text-4xl md:text-6xl font-black mb-6">{t('services.title')}</h1>
          <p className="text-gray-300 dark:text-gray-300 light:text-gray-700 text-lg md:text-xl font-normal max-w-2xl mx-auto">
            {t('services.subtitle')}
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.map((service) => (
            <div key={service.id} className="group flex flex-col gap-4 rounded-xl border border-white/5 dark:border-white/5 light:border-gray-200 bg-card-dark dark:bg-card-dark light:bg-white p-8 transition-all duration-300 hover:-translate-y-2 hover:border-primary/50 hover:bg-[#361e21] dark:hover:bg-[#361e21] light:hover:bg-gray-100 hover:shadow-2xl hover:shadow-primary/5">
              <div className="flex h-14 w-14 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                <span className="material-symbols-outlined text-3xl">{service.icon}</span>
              </div>
              <div className="flex flex-col gap-3">
                <h3 className="text-white dark:text-white light:text-gray-900 text-xl font-bold leading-tight group-hover:text-primary transition-colors">{service.title}</h3>
                <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-sm font-normal leading-relaxed">{service.description}</p>
              </div>
            </div>
          ))}
        </div>

        <div className="mt-24 text-center bg-gradient-to-br from-card-dark dark:from-card-dark light:from-gray-100 to-[#311c1d] dark:to-[#311c1d] light:to-gray-200 p-12 md:p-16 rounded-3xl border border-white/5 dark:border-white/5 light:border-gray-200">
          <h2 className="text-white dark:text-white light:text-gray-900 text-3xl md:text-4xl font-black mb-6">{t('services.cta.title')}</h2>
          <p className="text-gray-300 dark:text-gray-300 light:text-gray-700 text-lg mb-10 max-w-2xl mx-auto">
            {t('services.cta.description')}
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <button className="bg-primary hover:bg-primary-dark text-white font-bold h-12 px-10 rounded-lg transition-all shadow-lg shadow-primary/20">
              {t('common.startProject')}
            </button>
            <button className="border border-white/20 dark:border-white/20 light:border-gray-300 hover:border-white dark:hover:border-white light:hover:border-gray-900 text-white dark:text-white light:text-gray-900 font-bold h-12 px-10 rounded-lg transition-all">
              {t('common.downloadPortfolio')}
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Services;
