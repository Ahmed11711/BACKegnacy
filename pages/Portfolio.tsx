
import React, { useState } from 'react';
import { PortfolioProject } from '../types';
import { useI18n } from '../contexts/I18nContext';

const Portfolio: React.FC = () => {
  const { t } = useI18n();
  const [activeCategory, setActiveCategory] = useState('All Work');

  const getCategoryTranslation = (key: string): string => {
    const map: Record<string, string> = {
      'All Work': 'portfolio.categoryAll',
      'Branding': 'portfolio.categoryBranding',
      'Advertising': 'portfolio.categoryAdvertising',
      'Digital': 'portfolio.categoryDigital',
      'Production': 'portfolio.categoryProduction',
      'Strategy': 'portfolio.categoryStrategy',
    };
    return t(map[key] || 'portfolio.categoryAll');
  };

  const projects: PortfolioProject[] = [
    { id: '1', title: t('portfolio.project1.title'), category: 'Branding', categoryKey: 'Branding', image: 'https://picsum.photos/600/800?random=11', description: t('portfolio.project1.description') },
    { id: '2', title: t('portfolio.project2.title'), category: 'Advertising', categoryKey: 'Advertising', image: 'https://picsum.photos/800/450?random=12', description: t('portfolio.project2.description') },
    { id: '3', title: t('portfolio.project3.title'), category: 'Production', categoryKey: 'Production', image: 'https://picsum.photos/600/600?random=13', description: t('portfolio.project3.description') },
    { id: '4', title: t('portfolio.project4.title'), category: 'Strategy', categoryKey: 'Strategy', image: 'https://picsum.photos/600/900?random=14', description: t('portfolio.project4.description') },
    { id: '5', title: t('portfolio.project5.title'), category: 'Digital', categoryKey: 'Digital', image: 'https://picsum.photos/800/450?random=15', description: t('portfolio.project5.description') },
    { id: '6', title: t('portfolio.project6.title'), category: 'Branding', categoryKey: 'Branding', image: 'https://picsum.photos/600/600?random=16', description: t('portfolio.project6.description') },
  ];

  const categories = ['All Work', 'Branding', 'Advertising', 'Digital', 'Production', 'Strategy'];

  const filteredProjects = activeCategory === 'All Work'
    ? projects
    : projects.filter(p => p.categoryKey === activeCategory);

  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213] dark:bg-[#201213] light:bg-gray-50">
      <div className="max-w-7xl mx-auto">
        <div className="mb-16">
          <h1 className="text-5xl md:text-7xl font-black text-white dark:text-white light:text-gray-900 mb-6 uppercase tracking-tighter">
            {t('portfolio.title1')} <span className="text-primary">{t('portfolio.title2')}</span>
          </h1>
          <p className="text-xl text-text-secondary dark:text-text-secondary light:text-gray-600 max-w-xl">
            {t('portfolio.subtitle')}
          </p>
        </div>

        <div className="mb-12 flex flex-wrap gap-3 overflow-x-auto pb-4 scrollbar-hide">
          {categories.map((cat) => (
            <button
              key={cat}
              onClick={() => setActiveCategory(cat)}
              className={`px-8 py-2.5 rounded-full text-sm font-bold transition-all border ${
                activeCategory === cat 
                ? 'bg-primary border-primary text-white' 
                : 'bg-white/5 dark:bg-white/5 light:bg-gray-100 border-white/10 dark:border-white/10 light:border-gray-300 text-gray-400 dark:text-gray-400 light:text-gray-700 hover:border-primary hover:text-white dark:hover:text-white light:hover:text-gray-900'
              }`}
            >
              {getCategoryTranslation(cat)}
            </button>
          ))}
        </div>

        <div className="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
          {filteredProjects.map((project) => (
            <div key={project.id} className="group relative break-inside-avoid overflow-hidden rounded-2xl bg-card-dark dark:bg-card-dark light:bg-white cursor-pointer">
              <div className="w-full overflow-hidden">
                <img 
                  alt={project.title} 
                  className="w-full h-auto transition-transform duration-700 group-hover:scale-110" 
                  src={project.image} 
                />
              </div>
              <div className="absolute inset-0 bg-gradient-to-t from-black/95 dark:from-black/95 light:from-black/80 via-black/40 dark:via-black/40 light:via-black/30 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-500"></div>
              <div className="absolute inset-0 flex flex-col justify-end p-8 translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                <span className="mb-3 inline-block rounded bg-primary/20 px-3 py-1 text-xs font-bold uppercase tracking-widest text-primary backdrop-blur-md w-fit">
                  {getCategoryTranslation(project.categoryKey)}
                </span>
                <h3 className="text-2xl font-black text-white mb-2">{project.title}</h3>
                <p className="text-gray-300 dark:text-gray-300 light:text-gray-100 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 mb-4">
                  {project.description}
                </p>
                <div className="flex items-center gap-2 text-sm font-bold text-white opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                  {t('portfolio.viewCaseStudy')} <span className="material-symbols-outlined text-lg">arrow_forward</span>
                </div>
              </div>
            </div>
          ))}
        </div>

        <div className="mt-20 flex justify-center">
          <button className="flex items-center gap-3 bg-secondary-gray/20 dark:bg-secondary-gray/20 light:bg-gray-100 hover:bg-secondary-gray/40 dark:hover:bg-secondary-gray/40 light:hover:bg-gray-200 border border-white/10 dark:border-white/10 light:border-gray-300 px-10 py-4 rounded-xl font-bold transition-all text-white dark:text-white light:text-gray-900">
            {t('portfolio.loadMore')} <span className="material-symbols-outlined">expand_more</span>
          </button>
        </div>
      </div>
    </div>
  );
};

export default Portfolio;
