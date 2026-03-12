"use client";
import { Coffee, Heart, Users, Award } from "lucide-react";
import { motion } from "framer-motion";

export default function AboutPage() {
  const values = [
    { title: "Quality First", desc: "We source only the top 1% of coffee beans worldwide.", icon: Award },
    { title: "Sustainability", desc: "Our beans are ethically sourced from local farmers.", icon: Heart },
    { title: "Community", desc: "NextCafe is a space for everyone to connect and create.", icon: Users },
  ];

  return (
    <div className="pt-32 pb-20">
      {/* Hero */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
          <motion.div
            initial={{ opacity: 0, x: -30 }}
            animate={{ opacity: 1, x: 0 }}
          >
            <h1 className="text-6xl font-bold text-coffee-950 mb-8 leading-tight">
              Our Story of <br />
              <span className="text-coffee-600">Passion & Beans</span>
            </h1>
            <p className="text-xl text-coffee-800/80 leading-relaxed mb-8">
              Founded in 2026, NextCafe was born from the shared dreams of four young and talented students from FEU Institute of Technology. What started as a late-night idea during a coding session has blossomed into a real haven for coffee lovers. We built this not just as a shop, but as a testament to our passion for technology and great brewing.
            </p>
            <p className="text-lg text-coffee-700/70">
              We believe that every line of code and every cup of coffee requires the same thing—patience, precision, and an undeniable love for the craft. NextCafe is our perfect blend of innovation and tradition, serving the community one perfect cup at a time.
            </p>
          </motion.div>
          <motion.div
            initial={{ opacity: 0, scale: 0.9 }}
            animate={{ opacity: 1, scale: 1 }}
            className="relative"
          >
            <img 
              src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1000&auto=format&fit=crop" 
              className="rounded-[3rem] shadow-2xl rotate-2"
              alt="Our Cafe"
            />
            <div className="absolute -bottom-10 -left-10 bg-white p-8 rounded-3xl shadow-xl flex items-center space-x-4 max-w-xs">
              <div className="bg-coffee-100 p-3 rounded-2xl">
                <Coffee className="h-6 w-6 text-coffee-600" />
              </div>
              <div className="font-bold text-coffee-900 leading-tight">
                Crafting memories over coffee.
              </div>
            </div>
          </motion.div>
        </div>
      </section>

      {/* Values */}
      <section className="bg-coffee-950 py-32 text-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-20">
            <h2 className="text-4xl font-bold mb-4">Our Values</h2>
            <div className="w-20 h-1 bg-coffee-500 mx-auto"></div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-12">
            {values.map((v) => (
              <div key={v.title} className="text-center group">
                <div className="bg-white/10 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:bg-coffee-500 transition-all group-hover:-translate-y-2">
                  <v.icon className="h-8 w-8 text-white" />
                </div>
                <h3 className="text-2xl font-bold mb-4">{v.title}</h3>
                <p className="text-cream-300/80 leading-relaxed">{v.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Meet the Team */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div className="text-center mb-20">
          <h2 className="text-5xl font-black italic text-coffee-950 mb-4 tracking-tight">Meet the Team</h2>
          <p className="text-coffee-600 font-medium">A young and talented students at FEU Institute of Technology</p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
          {/* Van Ryan */}
          <div className="flex flex-col items-center group text-center">
            <div className="w-48 h-48 rounded-full overflow-hidden shadow-2xl mb-6 border-4 border-white group-hover:scale-105 transition-transform duration-300 bg-cream-100">
               {/* Using placeholder until you drop the original image here. Name it "vanryan.jpg" in public/images/team/ */}
               <img src="/images/team/vanryan.jpg" alt="Navarez, Van Ryan" className="w-full h-full object-cover" onError={(e) => { e.currentTarget.src = 'https://ui-avatars.com/api/?name=Van+Ryan&background=2D1B14&color=fff&size=200'; }} />
            </div>
            <p className="text-xs font-black uppercase text-coffee-400 tracking-widest mb-1">Back-End Developer</p>
            <h3 className="text-xl font-black text-coffee-950">Navarez, Van Ryan</h3>
          </div>

          {/* Martin */}
          <div className="flex flex-col items-center group text-center">
            <div className="w-48 h-48 rounded-full overflow-hidden shadow-2xl mb-6 border-4 border-white group-hover:scale-105 transition-transform duration-300 bg-cream-100">
               <img src="/images/team/martin.jpg" alt="Ore, Martin" className="w-full h-full object-cover" onError={(e) => { e.currentTarget.src = 'https://ui-avatars.com/api/?name=Martin+Ore&background=2D1B14&color=fff&size=200'; }} />
            </div>
            <p className="text-xs font-black uppercase text-coffee-400 tracking-widest mb-1">Front-End Developer</p>
            <h3 className="text-xl font-black text-coffee-950">Ore, Martin</h3>
          </div>

          {/* Jonell */}
          <div className="flex flex-col items-center group text-center">
            <div className="w-48 h-48 rounded-full overflow-hidden shadow-2xl mb-6 border-4 border-white group-hover:scale-105 transition-transform duration-300 bg-cream-100">
               <img src="/images/team/jonell.jpg" alt="Paguinto, Jonell" className="w-full h-full object-cover" onError={(e) => { e.currentTarget.src = 'https://ui-avatars.com/api/?name=Jonell+Paguinto&background=2D1B14&color=fff&size=200'; }} />
            </div>
            <p className="text-xs font-black uppercase text-coffee-400 tracking-widest mb-1">Project Lead</p>
            <h3 className="text-xl font-black text-coffee-950">Paguinto, Jonell</h3>
          </div>

          {/* Saira */}
          <div className="flex flex-col items-center group text-center">
            <div className="w-48 h-48 rounded-full overflow-hidden shadow-2xl mb-6 border-4 border-white group-hover:scale-105 transition-transform duration-300 bg-cream-100">
               <img src="/images/team/saira.jpg" alt="Salumbides, Saira Joyce" className="w-full h-full object-cover" onError={(e) => { e.currentTarget.src = 'https://ui-avatars.com/api/?name=Saira+Joyce&background=2D1B14&color=fff&size=200'; }} />
            </div>
            <p className="text-xs font-black uppercase text-coffee-400 tracking-widest mb-1">UI/UX Designer</p>
            <h3 className="text-xl font-black text-coffee-950">Salumbides, Saira Joyce</h3>
          </div>
        </div>
      </section>
    </div>
  );
}
