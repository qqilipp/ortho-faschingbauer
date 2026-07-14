'use client'

import React from 'react'
import Link from 'next/link'
import { Button } from './ui/button'
import { ArrowRight } from 'lucide-react'

export function HeroSection() {
  return (
    <section className="relative w-full bg-gradient-to-br from-primary-50 via-neutral-50 to-secondary-50 overflow-hidden">
      <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="min-h-screen flex items-center py-20">
          {/* Left Content */}
          <div className="w-full lg:w-1/2 space-y-8 animate-fade-in">
            <div className="space-y-4">
              <div className="inline-block">
                <span className="text-secondary-500 font-semibold text-lg tracking-wider">
                  WIEN • ENDOPROTHETIK
                </span>
              </div>
              
              <h1 className="text-5xl sm:text-6xl lg:text-7xl font-bold text-primary-900 leading-tight">
                Spezialist für künstliche Gelenke
              </h1>
              
              <p className="text-xl sm:text-2xl text-neutral-600 font-medium max-w-lg">
                Schmerzfreie Beweglichkeit durch Expertise und OP-Kompetenz
              </p>
            </div>

            {/* Description */}
            <div className="space-y-6 max-w-lg">
              <p className="text-neutral-700 text-lg leading-relaxed">
                Sich bewegen – ohne Schmerzen in Knie oder Hüfte: Das ist der Wunsch, den ich am häufigsten in meiner Praxis höre. 
              </p>
              <p className="text-neutral-700 text-lg leading-relaxed">
                In meiner Wiener Wahlarztordination erfülle ich diesen Wunsch mit meinem Fachwissen und meiner OP-Expertise – damit Sie wieder so beweglich sind wie früher.
              </p>
            </div>

            {/* CTA Buttons */}
            <div className="flex flex-col sm:flex-row gap-4 pt-8">
              <Button
                variant="default"
                size="lg"
                asChild
                className="group"
              >
                <Link href="#contact" className="flex items-center gap-2">
                  Termin vereinbaren
                  <ArrowRight size={20} className="group-hover:translate-x-1 transition-transform" />
                </Link>
              </Button>
              <Button
                variant="outline"
                size="lg"
                asChild
              >
                <Link href="#services">Mehr über mich</Link>
              </Button>
            </div>

            {/* Trust Markers */}
            <div className="flex flex-wrap gap-6 pt-8 border-t border-neutral-200">
              <div className="space-y-1">
                <div className="text-2xl font-bold text-primary-500">20+</div>
                <div className="text-sm text-neutral-600">Jahre Expertise</div>
              </div>
              <div className="space-y-1">
                <div className="text-2xl font-bold text-secondary-500">1000+</div>
                <div className="text-sm text-neutral-600">Erfolgreiche OPs</div>
              </div>
              <div className="space-y-1">
                <div className="text-2xl font-bold text-accent-500">Prof. DDr.</div>
                <div className="text-sm text-neutral-600">Hochqualifiziert</div>
              </div>
            </div>
          </div>

          {/* Right Side - Portrait (Placeholder) */}
          <div className="hidden lg:flex w-1/2 items-center justify-end relative">
            <div className="relative w-full h-full flex items-center justify-center">
              {/* Decorative Background Shape */}
              <div className="absolute inset-0 bg-gradient-to-b from-secondary-100 to-accent-100 rounded-3xl opacity-50 blur-3xl" />
              
              {/* Portrait Image Placeholder with gradient border */}
              <div className="relative z-10">
                <div className="w-96 h-96 rounded-2xl overflow-hidden shadow-2xl border-8 border-white animate-slide-up">
                  <div className="w-full h-full bg-gradient-to-br from-primary-200 via-neutral-200 to-secondary-200 flex items-center justify-center">
                    <div className="text-center text-neutral-600">
                      <div className="text-6xl mb-2">👨‍⚕️</div>
                      <p className="text-sm font-medium">Prof. DDr. Martin Faschingbauer</p>
                      <p className="text-xs text-neutral-500">Facharzt für Orthopädie</p>
                    </div>
                  </div>
                </div>
              </div>

              {/* Accent Circle */}
              <div className="absolute -bottom-10 -right-10 w-40 h-40 rounded-full bg-secondary-300 opacity-20 blur-3xl" />
              <div className="absolute top-20 -left-20 w-32 h-32 rounded-full bg-accent-300 opacity-20 blur-3xl" />
            </div>
          </div>
        </div>
      </div>

      {/* Bottom Wave */}
      <div className="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-neutral-200 to-transparent" />
    </section>
  )
}
