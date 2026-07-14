import React from 'react'
import Link from 'next/link'
import { Button } from '@/components/ui/button'
import { Check, ArrowLeft } from 'lucide-react'

interface ServicePageProps {
  title: string
  subtitle: string
  description: string
  benefits: string[]
  process: { step: number; title: string; description: string }[]
  recovery: string[]
  ctaText?: string
}

export function ServicePageTemplate({
  title,
  subtitle,
  description,
  benefits,
  process,
  recovery,
  ctaText = "Termin vereinbaren",
}: ServicePageProps) {
  return (
    <>
      {/* Hero Section */}
      <section className="w-full bg-gradient-to-br from-primary-500 to-primary-700 text-white py-16 md:py-24">
        <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <Link href="/" className="inline-flex items-center gap-2 text-primary-100 hover:text-white transition-colors mb-8">
            <ArrowLeft size={20} />
            Zurück
          </Link>
          <h1 className="text-5xl md:text-6xl font-bold mb-4">{title}</h1>
          <p className="text-xl text-primary-100">{subtitle}</p>
        </div>
      </section>

      <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Overview */}
        <section className="py-16">
          <div className="max-w-3xl">
            <h2 className="text-4xl font-bold text-primary-900 mb-6">Übersicht</h2>
            <div className="text-lg text-neutral-700 leading-relaxed space-y-4">
              {description.split('\n').map((paragraph, idx) => (
                <p key={idx}>{paragraph}</p>
              ))}
            </div>
          </div>
        </section>

        {/* Benefits */}
        <section className="py-16 bg-neutral-50 rounded-2xl -mx-4 sm:mx-0 px-4 sm:px-8 md:px-16">
          <h2 className="text-4xl font-bold text-primary-900 mb-10">Vorteile der Behandlung</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {benefits.map((benefit, idx) => (
              <div key={idx} className="flex items-start gap-4">
                <div className="flex-shrink-0">
                  <Check className="text-accent-500" size={28} />
                </div>
                <div>
                  <p className="text-neutral-700 leading-relaxed">{benefit}</p>
                </div>
              </div>
            ))}
          </div>
        </section>

        {/* Process */}
        <section className="py-16">
          <h2 className="text-4xl font-bold text-primary-900 mb-10">Behandlungsablauf</h2>
          <div className="space-y-6">
            {process.map((phase) => (
              <div key={phase.step} className="flex gap-6">
                <div className="flex-shrink-0">
                  <div className="flex items-center justify-center w-12 h-12 rounded-full bg-secondary-500 text-white font-bold">
                    {phase.step}
                  </div>
                </div>
                <div className="flex-1">
                  <h3 className="text-2xl font-bold text-primary-900 mb-2">{phase.title}</h3>
                  <p className="text-neutral-700 leading-relaxed">{phase.description}</p>
                </div>
              </div>
            ))}
          </div>
        </section>

        {/* Recovery */}
        <section className="py-16 bg-accent-50 rounded-2xl -mx-4 sm:mx-0 px-4 sm:px-8 md:px-16">
          <h2 className="text-4xl font-bold text-primary-900 mb-10">Genesungsverlauf</h2>
          <div className="space-y-4">
            {recovery.map((phase, idx) => (
              <div key={idx} className="bg-white rounded-lg p-6 border border-accent-200">
                <p className="text-neutral-700 leading-relaxed">{phase}</p>
              </div>
            ))}
          </div>
        </section>

        {/* CTA */}
        <section className="py-16 text-center">
          <div className="max-w-2xl mx-auto space-y-6">
            <h2 className="text-4xl font-bold text-primary-900">Haben Sie Fragen?</h2>
            <p className="text-xl text-neutral-700">
              Ich berate Sie gerne persönlich zu Ihrer individuellen Situation.
            </p>
            <Button
              variant="default"
              size="lg"
              asChild
            >
              <Link href="/#contact">{ctaText}</Link>
            </Button>
          </div>
        </section>
      </div>
    </>
  )
}
