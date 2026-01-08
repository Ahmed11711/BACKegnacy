
import React from 'react';

const features = [
  { icon: 'business_center', title: 'Decades of Experience', desc: 'Our senior team brings decades of expertise navigating complex media landscapes across Fortune 500 sectors.' },
  { icon: 'verified', title: 'Uncompromised Quality', desc: 'We maintain pixel-perfect execution and premium production standards. "Good enough" is not in our vocabulary.' },
  { icon: 'lightbulb', title: 'Constant Innovation', desc: 'We leverage cutting-edge tech and creative trends before they hit the mainstream, giving you the advantage.' },
  { icon: 'handshake', title: 'Unwavering Commitment', desc: 'Dedicated account management and 24/7 support availability. We treat your brand reputation as our own.' },
  { icon: 'schedule', title: 'On-Time Delivery', desc: 'Rigorous project management ensuring deadlines are met, every time. No excuses, just results.' },
];

const WhyUs: React.FC = () => {
  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213]">
      <div className="max-w-[1280px] mx-auto">
        <section className="flex flex-col md:flex-row gap-12 items-end mb-24">
          <div className="flex-1 space-y-6">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/5 bg-secondary-gray/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-primary">
              <span className="size-2 rounded-full bg-primary animate-pulse"></span>
              Why Partner With Us
            </div>
            <h1 className="text-5xl md:text-7xl font-black text-white leading-tight tracking-tighter">
              Building Brands with <br/>
              <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary to-rose-400">Precision & Passion</span>
            </h1>
            <p className="max-w-2xl text-lg text-gray-400 leading-relaxed">
              We don't just create ads; we engineer market dominance. Our process is built on data, fueled by creativity, and executed with military precision.
            </p>
          </div>
          <div className="flex gap-12 border-l border-white/10 pl-12">
            <div>
              <div className="text-4xl font-black text-white">150+</div>
              <div className="text-sm text-gray-500 uppercase tracking-widest font-bold mt-1">Global Clients</div>
            </div>
            <div>
              <div className="text-4xl font-black text-white">12</div>
              <div className="text-sm text-gray-500 uppercase tracking-widest font-bold mt-1">Years Active</div>
            </div>
          </div>
        </section>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {features.map((f, i) => (
            <div key={i} className="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-white/5 bg-card-dark p-10 transition-all hover:border-primary/50 hover:bg-[#361e21] hover:shadow-2xl hover:shadow-primary/5">
              <div className="absolute -right-12 -top-12 size-40 rounded-full bg-primary/5 blur-3xl transition-all group-hover:bg-primary/10"></div>
              <div className="mb-8 inline-flex size-16 items-center justify-center rounded-xl bg-secondary-gray/20 text-white group-hover:bg-primary transition-all duration-500">
                <span className="material-symbols-outlined text-4xl">{f.icon}</span>
              </div>
              <div>
                <h3 className="mb-4 text-2xl font-bold text-white">{f.title}</h3>
                <p className="text-gray-400 leading-relaxed text-base">{f.desc}</p>
              </div>
            </div>
          ))}
          <div className="relative flex flex-col justify-center items-center text-center rounded-2xl border-2 border-dashed border-white/10 bg-transparent p-10 hover:bg-card-dark transition-all group cursor-pointer">
            <div className="mb-6 rounded-full bg-primary/10 p-5 text-primary group-hover:bg-primary group-hover:text-white transition-all">
              <span className="material-symbols-outlined text-4xl">arrow_forward</span>
            </div>
            <h3 className="text-2xl font-bold text-white">Ready to start?</h3>
            <p className="mt-2 text-gray-400">Let's build something great together.</p>
          </div>
        </div>

        <section className="relative mt-32 border-t border-white/5 py-24 text-center overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>
          <div className="relative z-10 max-w-4xl mx-auto px-6">
            <h2 className="text-4xl md:text-5xl font-black text-white mb-6">Ready to elevate your brand?</h2>
            <p className="text-gray-400 text-xl mb-12">
              Join the ranks of market leaders who choose us for our precision, passion, and performance.
            </p>
            <div className="flex flex-col sm:flex-row items-center justify-center gap-6">
              <button className="bg-primary hover:bg-primary-dark text-white px-10 py-4 rounded-xl font-bold text-lg shadow-2xl shadow-primary/30 transition-all hover:-translate-y-1">
                Start Your Project
              </button>
              <button className="bg-transparent border border-white/20 hover:border-white text-white px-10 py-4 rounded-xl font-bold text-lg transition-all">
                View Portfolio
              </button>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
};

export default WhyUs;
