import React from 'react'
import Link from 'next/link'
import { Zap, Shield, Activity } from 'lucide-react'

interface ServiceCardProps {
  icon: React.ReactNode
  title: string
  description: string
  link: string
}

function ServiceCard({ icon, title, description, link }: ServiceCardProps) {
  return (
    <Link href={link}>
      <div className="group h-full bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-neutral-200 hover:border-secondary-300 cursor-pointer">
        <div className="inline-flex items-center justify-center w-14 h-14 bg-secondary-50 rounded-lg group-hover:bg-secondary-100 transition-colors mb-4">
          <div className="text-secondary-500 group-hover:text-secondary-600 transition-colors">
            {icon}
          </div>
        </div>
        <h3 className="text-xl font-bold text-primary-900 mb-3 group-hover:text-secondary-500 transition-colors">
          {title}
        </h3>
        <p className="text-neutral-600 leading-relaxed mb-6">
          {description}
        </p>
        <span className="inline-flex items-center text-secondary-500 font-semibold group-hover:translate-x-1 transition-transform">
          Mehr erfahren →
        </span>
      </div>
    </Link>
  )
}

export function ServicesSection() {
  return (
    <section id="services" className="w-full py-20 bg-neutral-50">
      <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="max-w-3xl mx-auto text-center mb-16">
          <span className="text-secondary-500 font-semibold text-lg tracking-wider">
            MEINE SCHWERPUNKTE
          </span>
          <h2 className="text-4xl sm:text-5xl font-bold text-primary-900 mt-4 mb-6">
            Spezialisiertes Fachwissen für Ihre Gesundheit
          </h2>
          <p className="text-lg text-neutral-700">
            Mit meiner Expertise in Endoprothetik und Orthopädie biete ich spezialisierte Behandlungen für künstliche Gelenke.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          <ServiceCard
            icon={<Shield size={28} />}
            title="Künstliches Kniegelenk"
            description="Spezialisierte Therapien und operative Techniken für die Behandlung von Arthrose und die Implantation künstlicher Kniegelenke mit optimalen Langzeitergebnissen."
            link="/knie-endoprothetik"
          />
          <ServiceCard
            icon={<Zap size={28} />}
            title="Künstliches Hüftgelenk"
            description="Modernste Verfahren zur Implantat-Auswahl, OP-Techniken und Rehabilitation bei Hüftarthrose und Hüftgelenkersatz."
            link="/hueft-endoprothetik"
          />
          <ServiceCard
            icon={<Activity size={28} />}
            title="Orthopädische Behandlungen"
            description="Konservative und operative Therapieoptionen für vielfältige orthopädische Erkrankungen und Verletzungen mit evidenzbasierten Methoden."
            link="/orthopaedische-behandlungen"
          />
          <div className="h-full bg-white rounded-xl p-8 shadow-sm border border-neutral-200 border-dashed flex flex-col items-center justify-center text-center">
            <div className="inline-flex items-center justify-center w-14 h-14 bg-accent-50 rounded-lg mb-4">
              <span className="text-3xl">💬</span>
            </div>
            <h3 className="text-xl font-bold text-primary-900 mb-3">
              Persönliche Beratung
            </h3>
            <p className="text-neutral-600 leading-relaxed">
              Buchen Sie ein unverbindliches Erstgespräch, um Ihre individuelle Situation zu besprechen.
            </p>
          </div>
        </div>
      </div>
    </section>
  )
}
