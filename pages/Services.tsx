
import React from 'react';
import { Service } from '../types';

const services: Service[] = [
  { id: '1', title: 'Visual Identity & Branding', description: 'Logo design, comprehensive brand guidelines, corporate stationery, and visual strategy.', icon: 'design_services' },
  { id: '2', title: 'Social Media & Marketing', description: 'Strategic planning, content creation, community management, and targeted ad campaigns.', icon: 'campaign' },
  { id: '3', title: 'Banners & Printing', description: 'High-quality large format printing, stickers, acrylics, and vinyl applications for all surfaces.', icon: 'print' },
  { id: '4', title: 'Outdoor Signage', description: 'Illuminated signs, wayfinding systems, 3D rooftop lettering, and storefront visibility.', icon: 'signpost' },
  { id: '5', title: 'Site Fences & Safety', description: 'Construction branding, project boards, safety signage, and perimeter hoarding solutions.', icon: 'safety_divider' },
  { id: '6', title: 'Metal & Artistic Fabrication', description: 'Custom metalwork, artistic sculptures, decorative structures, and bespoke installations.', icon: 'precision_manufacturing' },
  { id: '7', title: 'Building & Exhibition Facades', description: 'Modern cladding, temporary event structures, booth design, and architectural wrapping.', icon: 'architecture' },
  { id: '8', title: 'Events Management', description: 'End-to-end planning for exhibitions, conferences, corporate events, and logistics.', icon: 'theater_comedy' },
  { id: '9', title: 'Media & Production', description: 'Professional video production, corporate photography, and comprehensive audio services.', icon: 'video_camera_front' },
];

const Services: React.FC = () => {
  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213]">
      <div className="max-w-[1280px] mx-auto">
        <div className="text-center mb-16">
          <h1 className="text-white text-4xl md:text-6xl font-black mb-6">Our <span className="text-primary">Services</span></h1>
          <p className="text-gray-300 text-lg md:text-xl font-normal max-w-2xl mx-auto">
            Comprehensive advertising and media solutions designed to elevate modern enterprises. We deliver premium quality across all media spectrums.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.map((service) => (
            <div key={service.id} className="group flex flex-col gap-4 rounded-xl border border-white/5 bg-card-dark p-8 transition-all duration-300 hover:-translate-y-2 hover:border-primary/50 hover:bg-[#361e21] hover:shadow-2xl hover:shadow-primary/5">
              <div className="flex h-14 w-14 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                <span className="material-symbols-outlined text-3xl">{service.icon}</span>
              </div>
              <div className="flex flex-col gap-3">
                <h3 className="text-white text-xl font-bold leading-tight group-hover:text-primary transition-colors">{service.title}</h3>
                <p className="text-gray-400 text-sm font-normal leading-relaxed">{service.description}</p>
              </div>
            </div>
          ))}
        </div>

        <div className="mt-24 text-center bg-gradient-to-br from-card-dark to-[#311c1d] p-12 md:p-16 rounded-3xl border border-white/5">
          <h2 className="text-white text-3xl md:text-4xl font-black mb-6">Ready to make an impact?</h2>
          <p className="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
            Whether you need a full rebrand or a single sign, our team is ready to bring your vision to life.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <button className="bg-primary hover:bg-primary-dark text-white font-bold h-12 px-10 rounded-lg transition-all shadow-lg shadow-primary/20">
              Start a Project
            </button>
            <button className="border border-white/20 hover:border-white text-white font-bold h-12 px-10 rounded-lg transition-all">
              Download Portfolio
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Services;
