import { Header } from '@/components/Header'
import { Footer } from '@/components/Footer'
import { ServicePageTemplate } from '@/components/ServicePageTemplate'

const huefteData = {
  title: "Künstliches Hüftgelenk",
  subtitle: "Moderne Endoprothetik mit bewährten Langzeitergebnissen",
  description: `Das künstliche Hüftgelenk (Hüftendoprothese) ist eine häufig durchgeführte und hochgradig erfolgreiche Operation. Bei Verschleiß des Hüftgelenks (Coxarthrose) oder Hüftfrakturen bietet eine Hüftendoprothese eine zuverlässige Lösung für Schmerzlinderung und Mobilitätsverbesserung.

Mit modernen Implantattechniken und jahrelanger Erfahrung kann ich Ihnen zu einem lang haltbaren künstlichen Hüftgelenk verhelfen, das Ihre Lebensqualität deutlich verbessert.`,
  benefits: [
    "Deutliche Schmerzreduktion im Hüftgelenk",
    "Wiederherstellung der Gehfähigkeit und Mobilität",
    "Rückkehr zu Alltag, Sport und Freizeit",
    "Bewährte Langzeitbeständigkeit (20-25+ Jahre)",
    "Verschiedene Implantatoptionen für individuelle Bedürfnisse",
    "Minimale Narbenbildung mit modernen OP-Techniken"
  ],
  process: [
    {
      step: 1,
      title: "Detaillierte Diagnostik",
      description: "Anamnese, körperliche Untersuchung und bildgebende Verfahren (Röntgen, CT, MRT) ermöglichen eine präzise Diagnose und individualisierte Operationsplanung."
    },
    {
      step: 2,
      title: "Präoperative Beratung",
      description: "Ich bespreche mit Ihnen den geplanten Eingriff, die Implantat-Optionen, mögliche Risiken und das Rehabilitationsprogramm."
    },
    {
      step: 3,
      title: "Hüftgelenk-Ersatz",
      description: "Der beschädigte Hüftkopf und die Gelenkpfanne werden durch hochwertige Implantatkomponenten ersetzt. Die Operation dauert etwa 60-120 Minuten."
    },
    {
      step: 4,
      title: "Stationäre Betreuung",
      description: "Sie werden postoperativ überwacht und erhalten bereits am ersten Tag Mobilisierung und Physiotherapie."
    },
    {
      step: 5,
      title: "Rehabilitation & Nachsorge",
      description: "Mit gezielter Therapie und regelmäßigen Kontrollen werden Sie schrittweise mobiler und kehren zu normalen Aktivitäten zurück."
    }
  ],
  recovery: [
    "Woche 1: Überwachung im Krankenhaus, erste Mobilitätsübungen, Thromboembolieprophylaxe",
    "Woche 2-4: Intensivierte Physiotherapie, Gewichtbelastung erhöhen, Mobilität verbessern",
    "Monat 1-3: Leichte bis moderate Alltagsaktivitäten wieder aufnehmen",
    "Monat 3-6: Progressive Rückkehr zu Sport, Wandern und Freizeitaktivitäten",
    "Langfristig: Regelmäßige Nachuntersuchungen, angepasste körperliche Aktivitäten"
  ]
}

export default function HuefteEndoprothesePage() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-1">
        <ServicePageTemplate {...huefteData} />
      </main>
      <Footer />
    </div>
  )
}
