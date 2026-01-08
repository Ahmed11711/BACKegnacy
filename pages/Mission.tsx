
import React from 'react';
import { MissionPillar } from '../types';

const pillars: MissionPillar[] = [
  { number: '01', title: 'Quality & Creativity', description: 'Deliver integrated advertising solutions based on quality and creativity. We refuse to compromise on aesthetics or strategy.', icon: 'diamond' },
  { number: '02', title: 'Innovation', description: 'Leverage experience and modern technologies. Staying ahead of the curve ensures your brand leads the conversation, not just follows it.', icon: 'rocket_launch' },
  { number: '03', title: 'Partnership', description: 'Build long-term relationships based on trust and commitment. We view ourselves as an extension of your team, dedicated to your growth.', icon: 'handshake' },
  { number: '04', title: 'Excellence', description: 'Turn every project into a professional achievement that exceeds client expectations. "Good enough" is not in our vocabulary.', icon: 'trophy' },
];

const Mission: React.FC = () => {
  return (
    <div className="flex flex-col">
      <section className="relative flex flex-col items-center justify-center min-h-[60vh] px-6 py-20 overflow-hidden pt-32">
        <div className="absolute inset-0 z-0">
          <div className="absolute inset-0 bg-gradient-to-b from-[#201213]/80 via-[#201213]/90 to-[#201213] z-10"></div>
          <div className="w-full h-full bg-cover bg-center opacity-40 transform scale-105" style={{ backgroundImage: "url('https://picsum.photos/1920/1080?business')" }}></div>
        </div>
        <div className="relative z-10 flex flex-col items-center text-center max-w-4xl gap-8">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-primary text-xs font-bold uppercase tracking-wider">
            <span className="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
            Our Core Purpose
          </div>
          <h1 className="text-white text-5xl md:text-7xl font-black leading-tight tracking-tighter">
            Driving growth through <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-500">creativity</span> and commitment.
          </h1>
          <p className="text-gray-300 text-lg md:text-xl font-normal leading-relaxed max-w-2xl mx-auto">
            We don't just build campaigns; we build legacies. Our mission is to elevate brands through a fusion of artistic excellence and strategic precision.
          </p>
        </div>
      </section>

      <section className="px-6 py-24 bg-[#201213]">
        <div className="max-w-[1280px] mx-auto">
          <div className="flex flex-col md:flex-row justify-between items-end gap-6 border-b border-white/10 pb-12 mb-16">
            <div className="flex flex-col gap-2">
              <h2 className="text-3xl md:text-5xl font-bold text-white tracking-tight">Mission Statement</h2>
              <p className="text-gray-400 text-lg">The four pillars that define our approach to every challenge.</p>
            </div>
            <div className="hidden md:flex gap-2">
              <div className="h-1 w-12 bg-primary rounded-full"></div>
              <div className="h-1 w-4 bg-secondary-gray rounded-full"></div>
              <div className="h-1 w-2 bg-secondary-gray rounded-full"></div>
            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {pillars.map((pillar) => (
              <div key={pillar.number} className="group relative flex flex-col gap-6 p-8 md:p-12 rounded-2xl bg-secondary-gray/20 hover:-translate-y-2 transition-all duration-500 overflow-hidden border border-white/5">
                <div className="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                  <span className="text-9xl font-black text-white leading-none">{pillar.number}</span>
                </div>
                <div className="w-16 h-16 rounded-xl bg-primary flex items-center justify-center text-white shadow-xl shadow-primary/30 group-hover:scale-110 transition-transform">
                  <span className="material-symbols-outlined text-4xl">{pillar.icon}</span>
                </div>
                <div className="flex flex-col gap-4 relative z-10">
                  <h3 className="text-white text-2xl font-bold">{pillar.title}</h3>
                  <div className="h-1 w-16 bg-primary/50 group-hover:w-full group-hover:bg-primary transition-all duration-700"></div>
                  <p className="text-gray-300 text-lg leading-relaxed mt-2">{pillar.description}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
};

export default Mission;
