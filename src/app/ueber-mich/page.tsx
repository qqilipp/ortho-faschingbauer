import { Header } from '@/components/Header'
import { Footer } from '@/components/Footer'
import { Button } from '@/components/ui/button'
import Link from 'next/link'
import { Award, Users, Zap } from 'lucide-react'

export default function AboutPage() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-1">
        {/* Hero */}
        <section className="w-full bg-gradient-to-br from-primary-500 to-primary-700 text-white py-16 md:py-24">
          <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 className="text-5xl md:text-6xl font-bold mb-4">Über mich</h1>
            <p className="text-xl text-primary-100">Prof. DDr. Martin Faschingbauer – Spezialist für Orthopädie & Endoprothetik</p>
          </div>
        </section>

        <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Main Content */}
          <section className="py-16 grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
            {/* Left: Image Placeholder */}
            <div className="lg:col-span-1 flex justify-center">
              <div className="w-80 h-96 rounded-2xl bg-gradient-to-br from-primary-200 via-neutral-200 to-secondary-200 flex items-center justify-center shadow-lg border-8 border-white">
                <div className="text-center">
                  <div className="text-6xl mb-2">👨‍⚕️</div>
                  <p className="text-primary-900 font-bold">Prof. DDr. Martin Faschingbauer</p>
                </div>
              </div>
            </div>

            {/* Right: Bio */}
            <div className="lg:col-span-2 space-y-6">
              <div className="space-y-4">
                <h2 className="text-4xl font-bold text-primary-900">Willkommen</h2>
                <p className="text-lg text-neutral-700 leading-relaxed">
                  Ich bin Prof. DDr. Martin Faschingbauer und praktiziere als Facharzt für Orthopädie und Unfallchirurgie in Wien. Mit über 20 Jahren Erfahrung habe ich mich auf die Behandlung von Gelenkerkrankungen spezialisiert – insbesondere auf künstliche Hüft- und Kniegelenke.
                </p>
                <p className="text-lg text-neutral-700 leading-relaxed">
                  Mein Anliegen ist es, Ihnen eine individuelle, hochqualifizierte Betreuung anzubieten und gemeinsam den besten Weg zu Ihrer Schmerzfreiheit und Lebensqualität zu finden.
                </p>
              </div>

              <div className="space-y-3 pt-4 border-t border-neutral-200">
                <h3 className="text-xl font-bold text-primary-900">Qualifikationen</h3>
                <ul className="space-y-2 text-neutral-700">
                  <li>✓ DDr. med. univ. (Doctor of Medicine)</li>
                  <li>✓ Professor für Orthopädie und Endoprothetik</li>
                  <li>✓ MBA (Business Administration)</li>
                  <li>✓ Facharzt für Orthopädie und Unfallchirurgie</li>
                  <li>✓ Spezialisierung: Gelenkersatz & Endoprothetik</li>
                </ul>
              </div>
            </div>
          </section>

          {/* Philosophy */}
          <section className="py-16 bg-neutral-50 rounded-2xl -mx-4 sm:mx-0 px-4 sm:px-8 md:px-16">
            <h2 className="text-4xl font-bold text-primary-900 mb-8">Meine Philosophie</h2>
            <div className="space-y-6">
              <div className="space-y-3">
                <h3 className="text-2xl font-bold text-secondary-500">Realistische Erwartungen</h3>
                <p className="text-neutral-700 text-lg leading-relaxed">
                  Ich glaube an offene Kommunikation. Ein künstliches Gelenk ist immer nur ein Ersatz für das natürliche Gelenk – nicht eine Verbesserung. Viele Bewegungen werden damit gut gehen, manche werden unter Umständen nicht mehr gänzlich so funktionieren wie früher.
                </p>
              </div>

              <div className="space-y-3">
                <h3 className="text-2xl font-bold text-secondary-500">Individualisierte Behandlung</h3>
                <p className="text-neutral-700 text-lg leading-relaxed">
                  Jeder Patient ist einzigartig. Ich nehme mir Zeit für eine umfassende Diagnostik, höre Ihnen zu und entwickle ein Behandlungskonzept, das perfekt zu Ihren Bedürfnissen passt.
                </p>
              </div>

              <div className="space-y-3">
                <h3 className="text-2xl font-bold text-secondary-500">Moderne Techniken, Bewährte Methoden</h3>
                <p className="text-neutral-700 text-lg leading-relaxed">
                  Ich nutze die neuesten Implantat- und OP-Techniken, verbinde diese aber mit bewährten Methoden – das ist die beste Grundlage für langfristige Erfolge.
                </p>
              </div>

              <div className="space-y-3">
                <h3 className="text-2xl font-bold text-secondary-500">Langfristiges Follow-up</h3>
                <p className="text-neutral-700 text-lg leading-relaxed">
                  Meine Verantwortung endet nicht nach der Operation. Regelmäßige Nachuntersuchungen und kontinuierliche Betreuung sichern den Erfolg.
                </p>
              </div>
            </div>
          </section>

          {/* Highlights */}
          <section className="py-16">
            <h2 className="text-4xl font-bold text-primary-900 mb-12 text-center">Meine Stärken</h2>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              <div className="text-center space-y-4">
                <div className="flex justify-center">
                  <div className="w-16 h-16 rounded-full bg-secondary-100 flex items-center justify-center">
                    <Award className="text-secondary-500" size={32} />
                  </div>
                </div>
                <h3 className="text-2xl font-bold text-primary-900">Expertise</h3>
                <p className="text-neutral-700">
                  20+ Jahre Erfahrung in Orthopädie, Endoprothetik und über 1000 erfolgreiche Operationen
                </p>
              </div>

              <div className="text-center space-y-4">
                <div className="flex justify-center">
                  <div className="w-16 h-16 rounded-full bg-accent-100 flex items-center justify-center">
                    <Zap className="text-accent-500" size={32} />
                  </div>
                </div>
                <h3 className="text-2xl font-bold text-primary-900">Innovation</h3>
                <p className="text-neutral-700">
                  Moderne chirurgische Techniken, hochwertige Implantate und evidenzbasierte Methoden
                </p>
              </div>

              <div className="text-center space-y-4">
                <div className="flex justify-center">
                  <div className="w-16 h-16 rounded-full bg-primary-100 flex items-center justify-center">
                    <Users className="text-primary-500" size={32} />
                  </div>
                </div>
                <h3 className="text-2xl font-bold text-primary-900">Patientenfokus</h3>
                <p className="text-neutral-700">
                  Individuelle Beratung, transparente Kommunikation und langfristige Betreuung
                </p>
              </div>
            </div>
          </section>

          {/* CTA */}
          <section className="py-16 text-center">
            <div className="max-w-2xl mx-auto space-y-6">
              <h2 className="text-4xl font-bold text-primary-900">Ich freue mich auf Sie</h2>
              <p className="text-xl text-neutral-700">
                Gerne berate ich Sie persönlich in meiner Praxis in Wien. Vereinbaren Sie einen Termin!
              </p>
              <Button
                variant="default"
                size="lg"
                asChild
              >
                <Link href="/#contact">Kontakt aufnehmen</Link>
              </Button>
            </div>
          </section>
        </div>
      </main>
      <Footer />
    </div>
  )
}
