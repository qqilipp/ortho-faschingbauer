'use client'

import React, { useState } from 'react'
import { Button } from './ui/button'
import { Send } from 'lucide-react'

export function ContactForm() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
  })
  const [isSubmitted, setIsSubmitted] = useState(false)
  const [isLoading, setIsLoading] = useState(false)

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    const { name, value } = e.target
    setFormData((prev) => ({ ...prev, [name]: value }))
  }

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    setIsLoading(true)

    try {
      // For now, log the form data
      console.log('Form submitted:', formData)
      
      // In the future, this will be connected to Payload CMS
      // For now, just show success message
      setIsSubmitted(true)
      setFormData({ name: '', email: '', phone: '', subject: '', message: '' })
      
      // Reset success message after 5 seconds
      setTimeout(() => setIsSubmitted(false), 5000)
    } catch (error) {
      console.error('Error submitting form:', error)
    } finally {
      setIsLoading(false)
    }
  }

  return (
    <div className="space-y-6">
      {isSubmitted && (
        <div className="p-4 bg-accent-50 border border-accent-200 rounded-lg text-accent-900">
          <p className="font-medium">✓ Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.</p>
          <p className="text-sm text-accent-800 mt-1">Ich werde mich baldmöglichst mit Ihnen in Verbindung setzen.</p>
        </div>
      )}

      <form onSubmit={handleSubmit} className="space-y-6">
        {/* Name */}
        <div>
          <label htmlFor="name" className="block text-sm font-semibold text-neutral-900 mb-2">
            Name *
          </label>
          <input
            type="text"
            id="name"
            name="name"
            value={formData.name}
            onChange={handleChange}
            required
            className="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
            placeholder="Ihr Name"
          />
        </div>

        {/* Email */}
        <div>
          <label htmlFor="email" className="block text-sm font-semibold text-neutral-900 mb-2">
            E-Mail *
          </label>
          <input
            type="email"
            id="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
            className="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
            placeholder="Ihre E-Mail-Adresse"
          />
        </div>

        {/* Phone */}
        <div>
          <label htmlFor="phone" className="block text-sm font-semibold text-neutral-900 mb-2">
            Telefon
          </label>
          <input
            type="tel"
            id="phone"
            name="phone"
            value={formData.phone}
            onChange={handleChange}
            className="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
            placeholder="Ihre Telefonnummer"
          />
        </div>

        {/* Subject */}
        <div>
          <label htmlFor="subject" className="block text-sm font-semibold text-neutral-900 mb-2">
            Betreff *
          </label>
          <select
            id="subject"
            name="subject"
            value={formData.subject}
            onChange={handleChange}
            required
            className="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
          >
            <option value="">-- Bitte wählen Sie --</option>
            <option value="termine">Terminanfrage</option>
            <option value="knie">Frage zu Knie-Endoprothetik</option>
            <option value="huefte">Frage zu Hüfte-Endoprothetik</option>
            <option value="allgemein">Allgemeine Anfrage</option>
            <option value="sonstiges">Sonstiges</option>
          </select>
        </div>

        {/* Message */}
        <div>
          <label htmlFor="message" className="block text-sm font-semibold text-neutral-900 mb-2">
            Nachricht *
          </label>
          <textarea
            id="message"
            name="message"
            value={formData.message}
            onChange={handleChange}
            required
            rows={6}
            className="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"
            placeholder="Ihre Nachricht oder Frage..."
          />
        </div>

        {/* Submit Button */}
        <Button
          type="submit"
          variant="default"
          size="lg"
          disabled={isLoading}
          className="w-full"
        >
          {isLoading ? 'Wird versendet...' : (
            <>
              <Send size={20} className="mr-2" />
              Nachricht versendet
            </>
          )}
        </Button>

        <p className="text-xs text-neutral-600 text-center">
          * Erforderliche Felder
        </p>
      </form>
    </div>
  )
}
