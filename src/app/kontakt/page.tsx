import { Header } from '@/components/Header'
import { Footer } from '@/components/Footer'
import { ContactForm } from '@/components/ContactForm'
import { Phone, Mail, MapPin, Clock } from 'lucide-react'

export default function ContactPage() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-1">
        {/* Hero */}
        <section className="w-full bg-gradient-to-br from-primary-500 to-primary-700 text-white py-16 md:py-24">
          <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 className="text-5xl md:text-6xl font-bold mb-4">Kontakt</h1>
            <p className="text-xl text-primary-100">Vereinbaren Sie einen Termin oder stellen Sie Ihre Fragen</p>
          </div>
        </section>

        <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Contact Info & Form */}
          <section className="py-16 grid grid-cols-1 lg:grid-cols-3 gap-12">
            {/* Contact Information */}
            <div className="lg:col-span-1 space-y-8">
              {/* Address */}
              <div>
                <div className="flex items-center gap-4 mb-4">
                  <div className="w-12 h-12 rounded-lg bg-secondary-100 flex items-center justify-center">
                    <MapPin className="text-secondary-500" size={24} />
                  </div>
                  <h3 className="text-xl font-bold text-primary-900">Adresse</h3>
                </div>
                <div className="text-neutral-700 space-y-1">
                  <p className="font-medium">Ortho Faschingbauer</p>
                  <p>Lazarettgasse 25 / 1.OG</p>
                  <p>A-1090 Wien</p>
                </div>
              </div>

              {/* Phone */}
              <div>
                <div className="flex items-center gap-4 mb-4">
                  <div className="w-12 h-12 rounded-lg bg-secondary-100 flex items-center justify-center">
                    <Phone className="text-secondary-500" size={24} />
                  </div>
                  <h3 className="text-xl font-bold text-primary-900">Telefon</h3>
                </div>
                <a href="tel:+4314018070010" className="text-neutral-700 hover:text-primary-500 transition-colors font-medium">
                  +43 1 40 180 – 7010
                </a>
              </div>

              {/* Email */}
              <div>
                <div className="flex items-center gap-4 mb-4">
                  <div className="w-12 h-12 rounded-lg bg-secondary-100 flex items-center justify-center">
                    <Mail className="text-secondary-500" size={24} />
                  </div>
                  <h3 className="text-xl font-bold text-primary-900">E-Mail</h3>
                </div>
                <a href="mailto:praxis@ortho-faschingbauer.at" className="text-neutral-700 hover:text-primary-500 transition-colors font-medium">
                  praxis@ortho-faschingbauer.at
                </a>
              </div>

              {/* Office Hours */}
              <div>
                <div className="flex items-center gap-4 mb-4">
                  <div className="w-12 h-12 rounded-lg bg-secondary-100 flex items-center justify-center">
                    <Clock className="text-secondary-500" size={24} />
                  </div>
                  <h3 className="text-xl font-bold text-primary-900">Ordinationszeiten</h3>
                </div>
                <div className="text-neutral-700 space-y-2 text-sm">
                  <div className="flex justify-between">
                    <span>Montag:</span>
                    <span className="font-medium">09:00 – 13:00</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Dienstag – Mittwoch:</span>
                    <span className="font-medium">Nach Vereinbarung</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Donnerstag:</span>
                    <span className="font-medium">14:00 – 20:00</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Freitag:</span>
                    <span className="font-medium">09:00 – 13:00</span>
                  </div>
                </div>
              </div>
            </div>

            {/* Contact Form */}
            <div className="lg:col-span-2">
              <div className="bg-white rounded-xl p-8 shadow-sm border border-neutral-200">
                <h2 className="text-3xl font-bold text-primary-900 mb-8">Kontaktformular</h2>
                <ContactForm />
              </div>
            </div>
          </section>

          {/* Map Section */}
          <section className="py-16">
            <h2 className="text-3xl font-bold text-primary-900 mb-8">Lage der Praxis</h2>
            <div className="w-full h-96 bg-neutral-200 rounded-xl overflow-hidden border border-neutral-300">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2662.7537850607573!2d16.37!3d48.23!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d07f6d5d5d5d5%3A0x0!2sLazarettgasse%2025%2F1.OG%2C%201090%20Wien!5e0!3m2!1sde!2sat!4v1234567890"
                width="100%"
                height="100%"
                style={{ border: 0 }}
                allowFullScreen
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
              />
            </div>
          </section>

          {/* FAQ */}
          <section className="py-16 bg-neutral-50 rounded-2xl -mx-4 sm:mx-0 px-4 sm:px-8 md:px-16">
            <h2 className="text-3xl font-bold text-primary-900 mb-8">Häufig gestellte Fragen</h2>
            <div className="space-y-6">
              <div>
                <h3 className="text-xl font-bold text-primary-900 mb-3">Wie lange dauert ein Gespräch in der Praxis?</h3>
                <p className="text-neutral-700">
                  Ein erstes Beratungsgespräch dauert in der Regel 30-45 Minuten. Ich nehme mir Zeit für eine ausführliche Anamnese und Diagnostik.
                </p>
              </div>
              <div>
                <h3 className="text-xl font-bold text-primary-900 mb-3">Kann ich ohne Überweisung einen Termin machen?</h3>
                <p className="text-neutral-700">
                  Ja, meine Praxis ist eine Wahlarztordination. Sie können direkt einen Termin buchen. Jedoch benötigen Sie eine Zuweisung Ihres Hausarztes für die Krankenkassenverrechnung, falls gewünscht.
                </p>
              </div>
              <div>
                <h3 className="text-xl font-bold text-primary-900 mb-3">Was sollte ich zu einem Termin mitbringen?</h3>
                <p className="text-neutral-700">
                  Bitte bringen Sie Ihre Versicherungskarte, aktuelle Röntgen- oder MRT-Bilder (falls vorhanden) und eine Liste Ihrer Medikamente mit.
                </p>
              </div>
            </div>
          </section>
        </div>
      </main>
      <Footer />
    </div>
  )
}
