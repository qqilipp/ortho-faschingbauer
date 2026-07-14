import { Header } from '@/components/Header'
import { Footer } from '@/components/Footer'
import { ServicePageTemplate } from '@/components/ServicePageTemplate'

const knieData = {
  title: "Künstliches Kniegelenk",
  subtitle: "Endoprothetik und spezialisierte Gelenkersatz-Techniken",
  description: `Das künstliche Kniegelenk (Knieendoprothese) ist eine bewährte Lösung für degenerative Gelenkerkrankungen wie Arthrose. Mit modernen Implantattechniken und präzisen chirurgischen Verfahren kann Ihnen ein künstliches Kniegelenk zu mehr Beweglichkeit und Schmerzfreiheit verhelfen.

Bei der Implantation eines künstlichen Kniegelenks wird die beschädigte Knorpel- und Knochenfläche des Kniegelenks durch eine speziell angepasste Prothese ersetzt. Die Prothese besteht aus Metall, Kunststoff und manchmal Keramik.`,
  benefits: [
    "Deutliche Schmerzreduktion bei alltäglichen Aktivitäten",
    "Verbesserte Beweglichkeit und Mobilität",
    "Wiederherstellung der Lebensqualität",
    "Langfristige Funktionalität (15-20+ Jahre)",
    "Modernes Implantatdesign mit bewährter Langzeitbeständigkeit",
    "Minimale Ausfallzeit mit gezielter Physiotherapie"
  ],
  process: [
    {
      step: 1,
      title: "Umfassende Diagnostik",
      description: "Durch Anamnese, klinische Untersuchung und bildgebende Verfahren (Röntgen, MRT) stelle ich die Diagnose und plane die Behandlung individuell für Sie."
    },
    {
      step: 2,
      title: "Präoperative Vorbereitung",
      description: "Vor der Operation beraten wir Sie ausführlich über den Eingriff, besprechen die Anästhesie und bereiten Sie körperlich vor."
    },
    {
      step: 3,
      title: "Operative Implantation",
      description: "Unter Vollnarkose wird das beschädigte Knie durch eine hochwertige Endoprothese ersetzt. Der Eingriff dauert etwa 60-90 Minuten."
    },
    {
      step: 4,
      title: "Stationärer Aufenthalt",
      description: "Sie bleiben 3-5 Tage zur postoperativen Überwachung und zur Einleitung der Physiotherapie im Krankenhaus."
    },
    {
      step: 5,
      title: "Rehabilitation",
      description: "Mit gezielter Physiotherapie und Heimübungen werden Sie schrittweise wieder mobil. Regelmäßige Kontrolluntersuchungen sichern den Erfolg."
    }
  ],
  recovery: [
    "Woche 1-2: Schmerzmanagement, Thromboembolieprophylaxe, erste Mobilitätsübungen",
    "Woche 3-6: Physiotherapie intensivieren, Gewichtbelastung graduell erhöhen",
    "Monat 2-3: Leichte Alltagsaktivitäten wieder aufnehmen",
    "Monat 3-6: Progressive Rückkehr zu alltäglichen und Freizeitaktivitäten",
    "Langfristig: Regelmäßige Kontrollen und angepasste körperliche Aktivitäten"
  ]
}

export default function KnieEndoprothesePage() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-1">
        <ServicePageTemplate {...knieData} />
      </main>
      <Footer />
    </div>
  )
}
