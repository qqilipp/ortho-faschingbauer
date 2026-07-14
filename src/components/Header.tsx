'use client'

import React, { useState } from 'react'
import Link from 'next/link'
import { Button } from './ui/button'
import { Menu, X } from 'lucide-react'

export function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)

  const navItems = [
    { label: 'Schwerpunkte', href: '#services' },
    { label: 'Behandlungen', href: '#treatments' },
    { label: 'Über mich', href: '#about' },
    { label: 'Wissen', href: '#resources' },
  ]

  return (
    <header className="sticky top-0 z-50 w-full border-b border-neutral-200 bg-neutral-50/80 backdrop-blur-sm">
      <div className="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo / Branding */}
          <Link href="/" className="flex-shrink-0">
            <div className="text-xl font-bold text-primary-500 hover:text-secondary-500 transition-colors">
              Ortho Faschingbauer
            </div>
            <div className="text-xs text-neutral-600">Wien • Endoprothetik</div>
          </Link>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center gap-8">
            {navItems.map((item) => (
              <Link
                key={item.href}
                href={item.href}
                className="text-neutral-700 hover:text-primary-500 transition-colors text-sm font-medium"
              >
                {item.label}
              </Link>
            ))}
          </nav>

          {/* CTA Button + Mobile Menu */}
          <div className="flex items-center gap-4">
            <Button
              variant="secondary"
              size="md"
              asChild
              className="hidden sm:flex"
            >
              <Link href="#contact">Termin vereinbaren</Link>
            </Button>

            {/* Mobile Menu Button */}
            <button
              className="md:hidden p-2 text-neutral-700 hover:bg-neutral-100 rounded-md transition-colors"
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              aria-label="Toggle menu"
            >
              {mobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
            </button>
          </div>
        </div>

        {/* Mobile Navigation */}
        {mobileMenuOpen && (
          <nav className="md:hidden border-t border-neutral-200 py-4 space-y-2">
            {navItems.map((item) => (
              <Link
                key={item.href}
                href={item.href}
                className="block px-4 py-2 text-neutral-700 hover:bg-neutral-100 rounded-md transition-colors"
                onClick={() => setMobileMenuOpen(false)}
              >
                {item.label}
              </Link>
            ))}
            <Button
              variant="secondary"
              size="md"
              className="w-full mt-4"
              asChild
            >
              <Link href="#contact">Termin vereinbaren</Link>
            </Button>
          </nav>
        )}
      </div>
    </header>
  )
}
