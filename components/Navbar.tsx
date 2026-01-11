
import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { useI18n } from '../contexts/I18nContext';
import { useTheme } from '../contexts/ThemeContext';

const Navbar: React.FC = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [isLangMenuOpen, setIsLangMenuOpen] = useState(false);
  const location = useLocation();
  const { t, language, setLanguage } = useI18n();
  const { theme, toggleTheme } = useTheme();

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      const target = event.target as HTMLElement;
      if (!target.closest('.lang-menu')) {
        setIsLangMenuOpen(false);
      }
    };
    document.addEventListener('mousedown', handleClickOutside);
    return () => document.removeEventListener('mousedown', handleClickOutside);
  }, []);

  const navLinks = [
    { key: 'home', path: '/' },
    { key: 'services', path: '/services' },
    { key: 'mission', path: '/mission' },
    { key: 'portfolio', path: '/portfolio' },
    { key: 'testimonials', path: '/testimonials' },
    { key: 'about', path: '/about' },
    { key: 'whyUs', path: '/why-us' },
  ];

  return (
    <header className={`fixed top-0 left-0 w-full z-50 transition-all duration-300 ${
      isScrolled 
        ? 'bg-[#201213]/90 dark:bg-[#201213]/90 light:bg-white/90 backdrop-blur-md shadow-lg py-3' 
        : 'bg-transparent py-6'
    }`}>
      <div className="max-w-[1440px] mx-auto px-6 lg:px-12 flex items-center justify-between">
        <Link to="/" className="flex items-center gap-3 group">
          <div className="size-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/20 transition-transform group-hover:scale-110">
            <span className="material-symbols-outlined text-2xl">campaign</span>
          </div>
          <div className="flex flex-col">
            <span className="text-xl font-bold tracking-tight text-white dark:text-white light:text-gray-900 uppercase leading-none">Vertex</span>
            <span className="text-[10px] tracking-[0.2em] text-gray-400 dark:text-gray-400 light:text-gray-600 uppercase font-medium">Media Group</span>
          </div>
        </Link>

        <nav className="hidden md:flex items-center gap-8 bg-surface-dark/20 dark:bg-surface-dark/20 light:bg-white/80 backdrop-blur-md rounded-full px-8 py-2 border border-white/5 dark:border-white/5 light:border-gray-200">
          {navLinks.map((link) => (
            <Link
              key={link.path}
              to={link.path}
              className={`text-sm font-medium transition-colors ${
                location.pathname === link.path 
                  ? 'text-primary' 
                  : 'text-gray-300 dark:text-gray-300 light:text-gray-700 hover:text-white dark:hover:text-white light:hover:text-gray-900'
              }`}
            >
              {t(`navbar.${link.key}`)}
            </Link>
          ))}
        </nav>

        <div className="flex items-center gap-3">
          {/* Theme Toggle */}
          <button 
            onClick={toggleTheme}
            className="hidden sm:flex items-center justify-center rounded-lg bg-white/5 dark:bg-white/5 light:bg-gray-100 hover:bg-white/10 dark:hover:bg-white/10 light:hover:bg-gray-200 p-2.5 transition-all"
            aria-label={theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode'}
          >
            <span className="material-symbols-outlined text-xl text-white dark:text-white light:text-gray-900">
              {theme === 'dark' ? 'light_mode' : 'dark_mode'}
            </span>
          </button>

          {/* Language Switcher */}
          <div className="relative lang-menu">
            <button 
              onClick={() => setIsLangMenuOpen(!isLangMenuOpen)}
              className="flex items-center justify-center rounded-lg bg-white/5 dark:bg-white/5 light:bg-gray-100 hover:bg-white/10 dark:hover:bg-white/10 light:hover:bg-gray-200 px-4 py-2.5 text-sm font-bold text-white dark:text-white light:text-gray-900 transition-all"
            >
              <span className="uppercase">{language}</span>
              <span className="material-symbols-outlined text-lg ml-1">expand_more</span>
            </button>
            {isLangMenuOpen && (
              <div className="absolute right-0 mt-2 w-32 rounded-lg bg-card-dark dark:bg-card-dark light:bg-white border border-white/10 dark:border-white/10 light:border-gray-200 shadow-xl overflow-hidden">
                <button
                  onClick={() => {
                    setLanguage('en');
                    setIsLangMenuOpen(false);
                  }}
                  className={`w-full text-left px-4 py-2.5 text-sm font-medium transition-colors ${
                    language === 'en' 
                      ? 'bg-primary text-white' 
                      : 'text-gray-300 dark:text-gray-300 light:text-gray-700 hover:bg-white/5 dark:hover:bg-white/5 light:hover:bg-gray-100'
                  }`}
                >
                  English
                </button>
                <button
                  onClick={() => {
                    setLanguage('ar');
                    setIsLangMenuOpen(false);
                  }}
                  className={`w-full text-left px-4 py-2.5 text-sm font-medium transition-colors ${
                    language === 'ar' 
                      ? 'bg-primary text-white' 
                      : 'text-gray-300 dark:text-gray-300 light:text-gray-700 hover:bg-white/5 dark:hover:bg-white/5 light:hover:bg-gray-100'
                  }`}
                >
                  العربية
                </button>
              </div>
            )}
          </div>

          <button className="hidden sm:flex items-center justify-center rounded-lg bg-primary hover:bg-primary-dark px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all">
            {t('common.getQuote')}
          </button>
          <button className="md:hidden text-white dark:text-white light:text-gray-900">
            <span className="material-symbols-outlined text-3xl">menu</span>
          </button>
        </div>
      </div>
    </header>
  );
};

export default Navbar;
