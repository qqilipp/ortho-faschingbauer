import React from 'react'
import Link from 'next/link'
import { Button } from './ui/button'
import { CheckCircle } from 'lucide-react'

export function AboutSection() {
  const highlights = [
    'Realistische Erwartungshaltung und ehrliche Kommunikation',
    'Individuelle Behandlungsplanung für beste Ergebnisse',
    'Moderne OP-Techniken und bewährte Methoden',
    'Langfristiges Follow-up und Patientenbetreuung',
  ]

  return (
    <section id="about" className="w-full py-20 bg-white">
      <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          {/* Left - Content */}
          <div className="space-y-8">
            <div className="space-y-4">
              <span className="text-secondary-500 font-semibold text-lg tracking-wider">
                ÜBER MICH
              </span>
              <h2 className="text-4xl sm:text-5xl font-bold text-primary-900">
                Prof. DDr. Martin Faschingbauer
              </h2>
              <p className="text-xl text-neutral-600">
                Spezialist für Orthopädie & Endoprothetik
              </p>
            </div>

            <div className="space-y-6 text-neutral-700 leading-relaxed">
              <p>
                Als Spezialist für künstliche Knie- und Hüftgelenke ist mir eine realistische Erwartungshaltung wichtig: 
                <span className="font-semibold"> Ein künstliches Gelenk ist immer nur ein Ersatz für das natürliche Gelenk</span> – viele 
                Bewegungen werden damit gut gehen, manche werden unter Umständen nicht mehr gänzlich so funktionieren wie früher.
              </p>
              
              <p>
                Gemeinsam finden wir heraus, welche Behandlung Sie brauchen, damit Sie sich wieder bestmöglich und schmerzfrei bewegen können.
              </p>

              <p className="text-lg italic font-medium text-secondary-500">
                „Schritt für Schritt zu schmerzfreier Lebensqualität."
              </p>
            </div>

            {/* Highlights */}
            <div className="space-y-3 pt-4">
              {highlights.map((highlight) => (
                <div key={highlight} className="flex items-start gap-3">
                  <CheckCircle size={24} className="text-accent-500 flex-shrink-0 mt-0.5" />
                  <span className="text-neutral-700">{highlight}</span>
                </div>
              ))}
            </div>

            {/* CTA */}
            <Button
              variant="default"
              size="lg"
              asChild
            >
              <Link href="#contact">Vereinbaren Sie einen Termin</Link>
            </Button>
          </div>

          {/* Right - Credentials Card */}
          <div className="bg-gradient-to-br from-primary-50 to-secondary-50 rounded-2xl p-12 border border-primary-100">
            <div className="space-y-8">
              <div>
                <div className="text-5xl font-bold text-primary-500 mb-2">Prof. DDr.</div>
                <div className="text-lg font-semibold text-primary-900">Martin Faschingbauer</div>
                <div className="text-neutral-600 mt-1">MBA</div>
              </div>

              <div className="space-y-6 border-t border-primary-200 pt-6">
                <div>
                  <div className="text-sm font-semibold text-neutral-600 uppercase tracking-wider mb-2">Fachrichtung</div>
                  <div className="text-lg font-medium text-primary-900">
                    Facharzt für Orthopädie und Unfallchirurgie
                  </div>
                </div>

                <div>
                  <div className="text-sm font-semibold text-neutral-600 uppercase tracking-wider mb-2">Spezialisierung</div>
                  <div className="text-lg font-medium text-primary-900">
                    Endoprothetik<br />
                    Künstliche Gelenke<br />
                    Gelenkersatz
                  </div>
                </div>

                <div>
                  <div className="text-sm font-semibold text-neutral-600 uppercase tracking-wider mb-2">Standort</div>
                  <div className="text-lg font-medium text-primary-900">
                    Wien, Österreich
                  </div>
                </div>

                <div className="bg-white/60 rounded-lg p-4 border border-primary-200">
                  <div className="text-xs font-semibold text-secondary-500 uppercase tracking-wider mb-2">Patientenversprechen</div>
                  <p className="text-neutral-700 text-sm">
                    Hochwertige Diagnostik, transparente Beratung und spezialisierte Behandlungen für optimale Ergebnisse.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
