
import React from 'react';
import { useI18n } from '../contexts/I18nContext';

const Footer: React.FC = () => {
  const { t } = useI18n();

  return (
    <footer className="bg-[#1a0f10] dark:bg-[#1a0f10] light:bg-gray-50 border-t border-white/10 dark:border-white/10 light:border-gray-200 pt-16 pb-8">
      <div className="max-w-[1440px] mx-auto px-6 lg:px-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
          <div className="col-span-1 md:col-span-1 flex flex-col gap-6">
            <div className="flex items-center gap-3">
              <div className="size-8 bg-primary rounded flex items-center justify-center text-white">
                <span className="material-symbols-outlined text-xl">campaign</span>
              </div>
              <h2 className="text-white dark:text-white light:text-gray-900 text-lg font-bold tracking-tight">{t('footer.companyName')}</h2>
            </div>
            <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-sm leading-relaxed">
              {t('footer.tagline')}
            </p>
            <div className="flex gap-4">
              <a href="#" className="size-10 rounded-full bg-white/5 dark:bg-white/5 light:bg-gray-200 border border-white/10 dark:border-white/10 light:border-gray-300 flex items-center justify-center text-gray-400 dark:text-gray-400 light:text-gray-600 hover:bg-primary hover:text-white transition-all">
                <span className="material-symbols-outlined text-xl">public</span>
              </a>
              <a href="#" className="size-10 rounded-full bg-white/5 dark:bg-white/5 light:bg-gray-200 border border-white/10 dark:border-white/10 light:border-gray-300 flex items-center justify-center text-gray-400 dark:text-gray-400 light:text-gray-600 hover:bg-primary hover:text-white transition-all">
                <span className="material-symbols-outlined text-xl">mail</span>
              </a>
              <a href="#" className="size-10 rounded-full bg-white/5 dark:bg-white/5 light:bg-gray-200 border border-white/10 dark:border-white/10 light:border-gray-300 flex items-center justify-center text-gray-400 dark:text-gray-400 light:text-gray-600 hover:bg-primary hover:text-white transition-all">
                <span className="material-symbols-outlined text-xl">call</span>
              </a>
            </div>
          </div>

          <div className="flex flex-col gap-4">
            <h4 className="text-white dark:text-white light:text-gray-900 font-bold text-base uppercase tracking-widest">{t('footer.company')}</h4>
            <nav className="flex flex-col gap-2">
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('footer.aboutUs')}</a>
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('footer.ourWork')}</a>
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('footer.careers')}</a>
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('common.contact')}</a>
            </nav>
          </div>

          <div className="flex flex-col gap-4">
            <h4 className="text-white dark:text-white light:text-gray-900 font-bold text-base uppercase tracking-widest">{t('footer.services')}</h4>
            <nav className="flex flex-col gap-2">
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('footer.branding')}</a>
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('footer.digitalMedia')}</a>
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('footer.production')}</a>
              <a href="#" className="text-gray-400 dark:text-gray-400 light:text-gray-600 hover:text-primary text-sm">{t('footer.printing')}</a>
            </nav>
          </div>

          <div className="flex flex-col gap-4">
            <h4 className="text-white dark:text-white light:text-gray-900 font-bold text-base uppercase tracking-widest">{t('footer.newsletter')}</h4>
            <p className="text-gray-400 dark:text-gray-400 light:text-gray-600 text-sm">{t('footer.newsletterDescription')}</p>
            <div className="flex gap-2">
              <input type="email" placeholder={t('common.email')} className="bg-white/5 dark:bg-white/5 light:bg-white border border-white/10 dark:border-white/10 light:border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary flex-grow text-gray-900 dark:text-white light:text-gray-900" />
              <button className="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-bold">{t('common.join')}</button>
            </div>
          </div>
        </div>

        <div className="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/5 dark:border-white/5 light:border-gray-200 gap-4">
          <p className="text-gray-500 dark:text-gray-500 light:text-gray-600 text-xs">{t('footer.copyright')}</p>
          <div className="flex gap-6">
            <a href="#" className="text-gray-500 dark:text-gray-500 light:text-gray-600 hover:text-white dark:hover:text-white light:hover:text-gray-900 text-xs">{t('common.privacyPolicy')}</a>
            <a href="#" className="text-gray-500 dark:text-gray-500 light:text-gray-600 hover:text-white dark:hover:text-white light:hover:text-gray-900 text-xs">{t('common.termsOfService')}</a>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
