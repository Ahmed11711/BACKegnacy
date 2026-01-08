
import React from 'react';
import { Testimonial } from '../types';

const testimonials: Testimonial[] = [
  { id: '1', author: 'Sarah Jenkins', role: 'CMO at TechFlow', quote: 'MediaCo transformed our brand identity with a sophistication we didn\'t think possible. The cinematic quality of their production is simply unmatched in the region.', rating: 5, avatar: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDqxZs8Zi3egmaPAL-DtrrapNC8_0daup-Hn0UP7Cbvi8KhCaBN9pUc27oAo1hewBmh4SUbp_sw3nNPgUHLt_gVmPcKamas181LnrKS4iDKqmgBsjS6nOU5y3aAdAue5HUXFleivSY8Yvya7U7smFvb1PHgpUB4vrdjvPdZemTVLqJr3w7IYkch3KmDkSXrVI2VN4rTHclZaEGsngSInoEUklerieZKB064M3sdTueyrmpyMr4-Mc4uyc-kazBoxhuvfWTSVHATrQ0' },
  { id: '2', author: 'Ahmed Al-Fayed', role: 'Director at Dune Media', quote: 'The team\'s understanding of the Middle East market paired with global standards is unmatched. They delivered our campaign two weeks ahead of schedule.', rating: 5, avatar: 'https://lh3.googleusercontent.com/aida-public/AB6AX0x9zmGJhJXEezr9eUPi9ndjZxf6yClsnBlQT2kzvrVfbCXFvBvLl7NCGqc-LuDCoIupC28d0U6sbHVhNBtWVjySnuN1M2mBdBgRqvwaxhF5bS6Qw5dj8i1tJWpi8ckpVRwesHyhgFmfXOsp9k2f1lzfx2mdL9GX-wZF_kGfhOyA1A1_BlvbKU05qpQuuri7RS_0ZHUz0Q3A1Bk_QMQsPY8h2LmS0isED8ovq8hjtZwNk9QCp4GGlqh9o9pCziDo_PxG0aAb8zNs8' },
  { id: '3', author: 'Elena Rodriguez', role: 'VP at SolarEnergy', quote: 'Professional, creative, and incredibly high-impact results for our corporate campaigns. Their visual storytelling capability is the best in the business.', rating: 5, avatar: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBr3hzutuWYh6ejcL8kSvQWOWAx7wETkQP6OTJv1OhTV-KUh_EOnP0MZ1ho8Whi5Nv8ZTHhb6eeYIbm2R0LstUMykIMGQUzV3WojwvVpHawVT65-iheXK6xIL4QJ8ec1iHyKjAsjK61uJlQ6mUj-EZ7oRgoZ2kxTBSZKUxJ7cZsAcawPkfKUutNOAAVJ1gvHaBt8wlaTD--QEQNqk4Zu_fPuEPI6QYHBOGW1dsY3MVWrFz8ubZtWwZEA3WPphVU2p_sWYHnmWAhXl0' },
  { id: '4', author: 'Marcus Chen', role: 'Head of Brand, FinCorp', quote: 'We needed a partner who could handle enterprise-level demands without sacrificing creativity. MediaCo exceeded every expectation.', rating: 5, avatar: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBeb5izDGGlVGdfyHSE8kjd9SYVQU8IhfjOWa-hadjPXV7uJhGfM5TjLFVB9arGDMIU2xkgJVzJFnDCX2M342yYBI-MgXwGX7o1vU6R052G8Kna0Gc5zbKDGL2j8TKXO6tQIk4tc_WB7p83F_fP8LGiwyyplZbJ27hpefh1yexIjxtcZZKktX-UUdpaBQza20SI7L4m9tMl0PRCSup9HoZ54Fk1D9F1RLimoxEM2s1oRkWCAXcRz15V7NBokasTMJaj1vDJwQ37HdI' },
  { id: '5', author: 'Layla Hassan', role: 'Marketing Lead, RetailGroup', quote: 'Their strategic approach to digital advertising helped us increase our ROI by 150% in the first quarter alone.', rating: 5, avatar: 'https://lh3.googleusercontent.com/aida-public/AB6AXuClscAEIcIEyMYYOErFZLUAcxnsre4AqmiBkSB2eZog3bOkHBjVGT5AxgqF4ziBRHVyMbJL5Y3-fYbbzVwpQOaM49q0vuA6NiWerJjEAu9Kag3RkWKeWWnqQxtw_jI5T-LQxSNb9IRo7ejJcnVDIIY2vJBjhjiz7VPX1GV_LFQRB77BwW43396NtzY5txr4GD7mnyDVa_nBqrutyuUpO_mK1Du_syIIM-Dh219aD2kbIz5CO9c6XpEZ4SigaD9Yhr1Tp2pjOV9XYNI' },
  { id: '6', author: 'David Ross', role: 'CEO at AutoPrime', quote: 'From concept to execution, MediaCo operates on a completely different level. A truly premium service for premium brands.', rating: 5, avatar: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwst95VPrOaVVHZbywvl3NiCsfYbUCZKBzjojrG1mUdivdXfHwHHtXMmoFxE57rCvpYZWXZi7cFFHAmPB79hWQczz5itgnZ-4FnPwPCYW00Zd4lJHcjRexdjV9BBAohxulAPNgPm0Y2pLQelZpogqOMCQNSs5HjH09OdymNbaVtSzEb3yEf06zB9_bHCEptAybz5tXFxmNhdc1u1GRMeRcA40YQb1su8y-XqYvfuqScY0Pb0RAD_zWgH6gw1s1yKzCtzPluRemwgc' },
];

const Testimonials: React.FC = () => {
  return (
    <div className="pt-32 pb-24 px-6 bg-[#201213]">
      <div className="max-w-[1280px] mx-auto">
        <div className="flex flex-col md:text-left text-center mb-16">
          <div className="flex items-center justify-center md:justify-start gap-3 mb-4">
            <span className="h-px w-12 bg-primary"></span>
            <span className="text-primary font-bold tracking-widest uppercase text-xs">Client Success Stories</span>
          </div>
          <h1 className="text-white text-4xl md:text-6xl font-black mb-6">
            Trusted by <span className="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">Industry Leaders</span>
          </h1>
          <p className="text-gray-400 text-lg md:text-xl max-w-2xl">
            We partner with ambitious brands to create high-impact media campaigns that resonate globally.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {testimonials.map((t) => (
            <div key={t.id} className="group relative flex flex-col justify-between bg-[#2a1d1f] hover:bg-[#352225] border border-white/5 p-8 rounded-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/5">
              <div className="absolute top-8 right-8 text-primary opacity-20 group-hover:opacity-100 transition-opacity duration-500">
                <span className="material-symbols-outlined text-6xl">format_quote</span>
              </div>
              <div className="mb-8 relative z-10">
                <div className="flex gap-1 mb-4 text-primary">
                  {[...Array(t.rating)].map((_, i) => (
                    <span key={i} className="material-symbols-outlined text-sm">star</span>
                  ))}
                </div>
                <p className="text-gray-200 text-lg leading-relaxed font-light italic">
                  "{t.quote}"
                </p>
              </div>
              <div className="flex items-center gap-4 mt-auto border-t border-white/10 pt-6">
                <div 
                  className="size-14 rounded-full bg-secondary-gray bg-center bg-cover border-2 border-primary/20 shadow-md"
                  style={{ backgroundImage: `url('${t.avatar}')` }}
                />
                <div>
                  <h4 className="text-white font-bold text-base">{t.author}</h4>
                  <p className="text-primary text-sm font-medium">{t.role}</p>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default Testimonials;
