import { Header } from '@/components/Header'
import { HeroSection } from '@/components/HeroSection'
import { ServicesSection } from '@/components/ServicesSection'
import { AboutSection } from '@/components/AboutSection'
import { ContactCTASection } from '@/components/ContactCTASection'
import { Footer } from '@/components/Footer'

export default function Home() {
  return (
    <div className="min-h-screen flex flex-col bg-neutral-50">
      <Header />
      <main className="flex-1">
        <HeroSection />
        <ServicesSection />
        <AboutSection />
        <ContactCTASection />
      </main>
      <Footer />
    </div>
  )
}
