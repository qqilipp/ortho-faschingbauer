import React from 'react'
import Link from 'next/link'
import { Mail, Phone, MapPin } from 'lucide-react'

export function Footer() {
  const currentYear = new Date().getFullYear()

  return (
    <footer className="w-full bg-primary-500 text-white mt-20">
      <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Main Footer Content */}
        <div className="py-16 grid grid-cols-1 md:grid-cols-3 gap-8">
          {/* Brand */}
          <div className="space-y-4">
            <h3 className="text-xl font-bold">Ortho Faschingbauer</h3>
            <p className="text-primary-100 text-sm">
              Spezialist für Orthopädie & Endoprothetik in Wien
            </p>
          </div>

          {/* Contact Info */}
          <div className="space-y-4">
            <h4 className="font-semibold mb-3">Kontakt</h4>
            <div className="space-y-3 text-sm">
              <a
                href="tel:+4314018070010"
                className="flex items-center gap-3 text-primary-100 hover:text-white transition-colors"
              >
                <Phone size={18} />
                +43 1 40 180 – 7010
              </a>
              <a
                href="mailto:praxis@ortho-faschingbauer.at"
                className="flex items-center gap-3 text-primary-100 hover:text-white transition-colors"
              >
                <Mail size={18} />
                praxis@ortho-faschingbauer.at
              </a>
              <div className="flex items-start gap-3 text-primary-100">
                <MapPin size={18} className="mt-0.5 flex-shrink-0" />
                <div>
                  <div>Lazarettgasse 25 / 1.OG</div>
                  <div>A-1090 Wien</div>
                </div>
              </div>
            </div>
          </div>

          {/* Office Hours */}
          <div className="space-y-4">
            <h4 className="font-semibold mb-3">Ordinationszeiten</h4>
            <div className="space-y-2 text-sm text-primary-100">
              <div className="flex justify-between">
                <span>Montag:</span>
                <span>09:00 – 13:00</span>
              </div>
              <div className="flex justify-between">
                <span>Donnerstag:</span>
                <span>14:00 – 20:00</span>
              </div>
              <div className="flex justify-between">
                <span>Freitag:</span>
                <span>09:00 – 13:00</span>
              </div>
              <div className="pt-2 text-xs italic">
                und nach Vereinbarung
              </div>
            </div>
          </div>
        </div>

        {/* Divider */}
        <div className="border-t border-primary-400" />

        {/* Bottom Footer */}
        <div className="py-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-primary-100">
          <p>&copy; {currentYear} Prof. DDr. med. univ. Martin Faschingbauer. Alle Rechte vorbehalten.</p>
          <div className="flex gap-6">
            <Link href="/impressum" className="hover:text-white transition-colors">
              Impressum
            </Link>
            <Link href="/datenschutz" className="hover:text-white transition-colors">
              Datenschutz
            </Link>
          </div>
        </div>
      </div>
    </footer>
  )
}
