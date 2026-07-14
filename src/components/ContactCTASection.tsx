import React from 'react'
import Link from 'next/link'
import { Button } from './ui/button'
import { Phone, Mail, MapPin } from 'lucide-react'

export function ContactCTASection() {
  return (
    <section id="contact" className="w-full py-20 bg-gradient-to-br from-primary-500 to-primary-700 text-white">
      <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          {/* Left - Content */}
          <div className="space-y-8">
            <div className="space-y-4">
              <h2 className="text-4xl sm:text-5xl font-bold leading-tight">
                Vereinbaren Sie einen Termin
              </h2>
              <p className="text-xl text-primary-100">
                Ich freue mich auf Sie! Kontaktieren Sie meine Praxis für ein persönliches Beratungsgespräch.
              </p>
            </div>

            <div className="space-y-4">
              <a
                href="tel:+4314018070010"
                className="flex items-center gap-4 p-4 bg-primary-600/50 rounded-lg hover:bg-primary-600/70 transition-colors"
              >
                <Phone className="flex-shrink-0" size={24} />
                <div>
                  <div className="text-sm text-primary-100">Telefonisch</div>
                  <div className="font-semibold">+43 1 40 180 – 7010</div>
                </div>
              </a>

              <a
                href="mailto:praxis@ortho-faschingbauer.at"
                className="flex items-center gap-4 p-4 bg-primary-600/50 rounded-lg hover:bg-primary-600/70 transition-colors"
              >
                <Mail className="flex-shrink-0" size={24} />
                <div>
                  <div className="text-sm text-primary-100">E-Mail</div>
                  <div className="font-semibold">praxis@ortho-faschingbauer.at</div>
                </div>
              </a>

              <div className="p-4 bg-primary-600/50 rounded-lg">
                <div className="flex items-start gap-4">
                  <MapPin className="flex-shrink-0 mt-1" size={24} />
                  <div>
                    <div className="text-sm text-primary-100 mb-1">Adresse</div>
                    <div className="font-semibold">
                      Lazarettgasse 25 / 1.OG<br />
                      A-1090 Wien
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Right - Office Hours */}
          <div className="space-y-6">
            <div className="bg-primary-600/50 rounded-xl p-8 backdrop-blur-sm border border-primary-400">
              <h3 className="text-2xl font-bold mb-6">Ordinationszeiten</h3>
              
              <div className="space-y-4">
                <div className="flex justify-between items-center pb-4 border-b border-primary-400">
                  <span className="font-medium">Montag</span>
                  <span className="text-primary-100">09:00 – 13:00</span>
                </div>
                <div className="flex justify-between items-center pb-4 border-b border-primary-400">
                  <span className="font-medium">Dienstag – Mittwoch</span>
                  <span className="text-primary-100">Nach Vereinbarung</span>
                </div>
                <div className="flex justify-between items-center pb-4 border-b border-primary-400">
                  <span className="font-medium">Donnerstag</span>
                  <span className="text-primary-100">14:00 – 20:00</span>
                </div>
                <div className="flex justify-between items-center">
                  <span className="font-medium">Freitag</span>
                  <span className="text-primary-100">09:00 – 13:00</span>
                </div>
              </div>

              <p className="text-sm text-primary-100 mt-6 italic">
                Zusätzliche Termine nach Vereinbarung möglich
              </p>
            </div>

            {/* Quick Note */}
            <div className="bg-white/10 rounded-xl p-8 border border-white/20">
              <p className="text-primary-100 mb-4">
                Bei dringenden Anliegen oder Fragen kontaktieren Sie die Praxis direkt. Wir helfen Ihnen gerne weiter.
              </p>
              <Button
                variant="default"
                size="lg"
                className="w-full bg-white text-primary-500 hover:bg-primary-50"
                asChild
              >
                <Link href="tel:+4314018070010">Jetzt anrufen</Link>
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
