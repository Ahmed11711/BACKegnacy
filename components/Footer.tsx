
import React from 'react';

const Footer: React.FC = () => {
  return (
    <footer className="bg-[#1a0f10] border-t border-white/10 pt-16 pb-8">
      <div className="max-w-[1440px] mx-auto px-6 lg:px-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
          <div className="col-span-1 md:col-span-1 flex flex-col gap-6">
            <div className="flex items-center gap-3">
              <div className="size-8 bg-primary rounded flex items-center justify-center text-white">
                <span className="material-symbols-outlined text-xl">campaign</span>
              </div>
              <h2 className="text-white text-lg font-bold tracking-tight">VERTEX MEDIA</h2>
            </div>
            <p className="text-gray-400 text-sm leading-relaxed">
              Transforming ideas into powerful brand experiences. We lead with creativity and deliver with precision.
            </p>
            <div className="flex gap-4">
              <a href="#" className="size-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white transition-all">
                <span className="material-symbols-outlined text-xl">public</span>
              </a>
              <a href="#" className="size-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white transition-all">
                <span className="material-symbols-outlined text-xl">mail</span>
              </a>
              <a href="#" className="size-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white transition-all">
                <span className="material-symbols-outlined text-xl">call</span>
              </a>
            </div>
          </div>

          <div className="flex flex-col gap-4">
            <h4 className="text-white font-bold text-base uppercase tracking-widest">Company</h4>
            <nav className="flex flex-col gap-2">
              <a href="#" className="text-gray-400 hover:text-primary text-sm">About Us</a>
              <a href="#" className="text-gray-400 hover:text-primary text-sm">Our Work</a>
              <a href="#" className="text-gray-400 hover:text-primary text-sm">Careers</a>
              <a href="#" className="text-gray-400 hover:text-primary text-sm">Contact</a>
            </nav>
          </div>

          <div className="flex flex-col gap-4">
            <h4 className="text-white font-bold text-base uppercase tracking-widest">Services</h4>
            <nav className="flex flex-col gap-2">
              <a href="#" className="text-gray-400 hover:text-primary text-sm">Branding</a>
              <a href="#" className="text-gray-400 hover:text-primary text-sm">Digital Media</a>
              <a href="#" className="text-gray-400 hover:text-primary text-sm">Production</a>
              <a href="#" className="text-gray-400 hover:text-primary text-sm">Printing</a>
            </nav>
          </div>

          <div className="flex flex-col gap-4">
            <h4 className="text-white font-bold text-base uppercase tracking-widest">Newsletter</h4>
            <p className="text-gray-400 text-sm">Stay updated with our latest projects and insights.</p>
            <div className="flex gap-2">
              <input type="email" placeholder="Email address" className="bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary flex-grow" />
              <button className="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-bold">Join</button>
            </div>
          </div>
        </div>

        <div className="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/5 gap-4">
          <p className="text-gray-500 text-xs">© 2024 Vertex Media Group. All rights reserved.</p>
          <div className="flex gap-6">
            <a href="#" className="text-gray-500 hover:text-white text-xs">Privacy Policy</a>
            <a href="#" className="text-gray-500 hover:text-white text-xs">Terms of Service</a>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
