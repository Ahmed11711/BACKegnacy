
export interface Service {
  id: string;
  title: string;
  description: string;
  icon: string;
}

export interface Testimonial {
  id: string;
  author: string;
  role: string;
  quote: string;
  rating: number;
  avatar: string;
}

export interface PortfolioProject {
  id: string;
  title: string;
  category: string;
  image: string;
  description: string;
}

export interface MissionPillar {
  number: string;
  title: string;
  description: string;
  icon: string;
}
