
import React from 'react';
import { HashRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Layout from './components/Layout';
import Hero from './pages/Hero';
import Services from './pages/Services';
import Mission from './pages/Mission';
import Testimonials from './pages/Testimonials';
import About from './pages/About';
import Portfolio from './pages/Portfolio';
import WhyUs from './pages/WhyUs';

const App: React.FC = () => {
  return (
    <Router>
      <Layout>
        <Routes>
          <Route path="/" element={<Hero />} />
          <Route path="/services" element={<Services />} />
          <Route path="/mission" element={<Mission />} />
          <Route path="/testimonials" element={<Testimonials />} />
          <Route path="/about" element={<About />} />
          <Route path="/portfolio" element={<Portfolio />} />
          <Route path="/why-us" element={<WhyUs />} />
          <Route path="*" element={<Navigate to="/" replace />} />
        </Routes>
      </Layout>
    </Router>
  );
};

export default App;
