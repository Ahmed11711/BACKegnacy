
import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';

const Navbar: React.FC = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const navLinks = [
    { name: 'Home', path: '/' },
    { name: 'Services', path: '/services' },
    { name: 'Mission', path: '/mission' },
    { name: 'Portfolio', path: '/portfolio' },
    { name: 'Testimonials', path: '/testimonials' },
    { name: 'About', path: '/about' },
    { name: 'Why Us', path: '/why-us' },
  ];

  return (
    <header className={`fixed top-0 left-0 w-full z-50 transition-all duration-300 ${isScrolled ? 'bg-[#201213]/90 backdrop-blur-md shadow-lg py-3' : 'bg-transparent py-6'}`}>
      <div className="max-w-[1440px] mx-auto px-6 lg:px-12 flex items-center justify-between">
        <Link to="/" className="flex items-center gap-3 group">
          <div className="size-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/20 transition-transform group-hover:scale-110">
            <span className="material-symbols-outlined text-2xl">campaign</span>
          </div>
          <div className="flex flex-col">
            <span className="text-xl font-bold tracking-tight text-white uppercase leading-none">Vertex</span>
            <span className="text-[10px] tracking-[0.2em] text-gray-400 uppercase font-medium">Media Group</span>
          </div>
        </Link>

        <nav className="hidden md:flex items-center gap-8 bg-surface-dark/20 backdrop-blur-md rounded-full px-8 py-2 border border-white/5">
          {navLinks.map((link) => (
            <Link
              key={link.path}
              to={link.path}
              className={`text-sm font-medium transition-colors ${
                location.pathname === link.path ? 'text-primary' : 'text-gray-300 hover:text-white'
              }`}
            >
              {link.name}
            </Link>
          ))}
        </nav>

        <div className="flex items-center gap-4">
          <button className="hidden sm:flex items-center justify-center rounded-lg bg-primary hover:bg-primary-dark px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all">
            Get Quote
          </button>
          <button className="md:hidden text-white">
            <span className="material-symbols-outlined text-3xl">menu</span>
          </button>
        </div>
      </div>
    </header>
  );
};

export default Navbar;
