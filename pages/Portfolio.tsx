
import React, { useState } from 'react';
import { PortfolioProject } from '../types';

const projects: PortfolioProject[] = [
  { id: '1', title: 'TechGlobal Rebrand', category: 'Branding', image: 'https://picsum.photos/600/800?random=11', description: 'Comprehensive identity overhaul for a leading silicon valley tech giant.' },
  { id: '2', title: 'Apex Campaign', category: 'Advertising', image: 'https://picsum.photos/800/450?random=12', description: 'High-energy marketing campaign targeting Gen-Z gamers.' },
  { id: '3', title: 'Neon Dreams', category: 'Production', image: 'https://picsum.photos/600/600?random=13', description: 'Award-winning short film production with stunning visual effects.' },
  { id: '4', title: 'Urban Flow', category: 'Strategy', image: 'https://picsum.photos/600/900?random=14', description: 'Reimagining urban transportation systems for smart cities.' },
  { id: '5', title: 'Future Finance', category: 'Digital', image: 'https://picsum.photos/800/450?random=15', description: 'A seamless mobile banking experience for next-gen users.' },
  { id: '6', title: 'EcoEnergy', category: 'Branding', image: 'https://picsum.photos/600/600?random=16', description: 'Sustainable energy branding that connects with eco-conscious consumers.' },
];

const categories = ['All Work', 'Branding', 'Advertising', 'Digital', 'Production', 'Strategy'];

const Portfolio: React.FC = () => {
  const [activeCategory, setActiveCategory] = useState('All Work');

  const filteredProjects = activeCategory === 'All Work' 
    ? projects 
    : projects.filter(p => p.category === activeCategory);

  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213]">
      <div className="max-w-7xl mx-auto">
        <div className="mb-16">
          <h1 className="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tighter">
            Selected <span className="text-primary">Work</span>
          </h1>
          <p className="text-xl text-text-secondary max-w-xl">
            Transforming brands through bold strategy, creative excellence, and digital innovation.
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
                : 'bg-white/5 border-white/10 text-gray-400 hover:border-primary hover:text-white'
              }`}
            >
              {cat}
            </button>
          ))}
        </div>

        <div className="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
          {filteredProjects.map((project) => (
            <div key={project.id} className="group relative break-inside-avoid overflow-hidden rounded-2xl bg-card-dark cursor-pointer">
              <div className="w-full overflow-hidden">
                <img 
                  alt={project.title} 
                  className="w-full h-auto transition-transform duration-700 group-hover:scale-110" 
                  src={project.image} 
                />
              </div>
              <div className="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-500"></div>
              <div className="absolute inset-0 flex flex-col justify-end p-8 translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                <span className="mb-3 inline-block rounded bg-primary/20 px-3 py-1 text-xs font-bold uppercase tracking-widest text-primary backdrop-blur-md w-fit">
                  {project.category}
                </span>
                <h3 className="text-2xl font-black text-white mb-2">{project.title}</h3>
                <p className="text-gray-300 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 mb-4">
                  {project.description}
                </p>
                <div className="flex items-center gap-2 text-sm font-bold text-white opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                  View Case Study <span className="material-symbols-outlined text-lg">arrow_forward</span>
                </div>
              </div>
            </div>
          ))}
        </div>

        <div className="mt-20 flex justify-center">
          <button className="flex items-center gap-3 bg-secondary-gray/20 hover:bg-secondary-gray/40 border border-white/10 px-10 py-4 rounded-xl font-bold transition-all text-white">
            Load More Projects <span className="material-symbols-outlined">expand_more</span>
          </button>
        </div>
      </div>
    </div>
  );
};

export default Portfolio;
