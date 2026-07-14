import type { Metadata, Viewport } from "next";
import "./globals.css";

export const viewport: Viewport = {
  width: "device-width",
  initialScale: 1.0,
};

export const metadata: Metadata = {
  title: "Prof. DDr. Martin Faschingbauer | Orthopädie Wien",
  description: "Spezialist für künstliche Hüft- und Kniegelenke in Wien. Expertise in Endoprothetik und Orthopädie.",
  keywords: ["Orthopädie", "Wien", "Endoprothetik", "Künstliches Gelenk", "Hüfte", "Knie"],
  robots: "index, follow",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html
      lang="de"
      className="h-full antialiased"
    >
      <head>
        <link rel="canonical" href="https://ortho-faschingbauer.at/" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Ortho Faschingbauer" />
      </head>
      <body className="min-h-full flex flex-col bg-neutral-50 text-neutral-900">{children}</body>
    </html>
  );
}
