# Vorleitner Theme

Custom WordPress-Theme für digitale Auftragsformulare der Firma Vorleitner.

## Was macht dieses Theme?

- **Werkstatt-Auftragsformular** – mehrstufiges Formular für Werkstattaufträge inkl. Checkliste, Mietfahrzeug, Endkontrolle
- **Abschleppdienst-Auftragsformular** – mehrstufiges Formular für Abschleppaufträge inkl. Leistungen, Einsatzdaten, Versicherungsdaten
- **PDF-Generierung** – automatische Erstellung druckfertiger Auftragskarten (mPDF) nach Formularabgabe
- **E-Mail-Versand** – Benachrichtigung der zuständigen Stelle nach Eingang
- **Admin-Dashboard** – PDFs direkt im WP-Admin ansehen und herunterladen (on-demand, kein öffentlicher Zugriff)

## Technischer Aufbau

```
forms/
  admin-settings/   – WordPress-Einstellungen (Testdaten, Admin-Ansicht)
  email/            – E-Mail-Templates und Versandlogik
  form-handling/    – Validierung, Sanitierung, Formular-Orchestrierung
  helpers/          – Hilfsfunktionen (z. B. Pods-Label-Loader)
  pdf-generation/   – PDF-Datenvorbereitung und Feldausgabe
  post-creation/    – Speichern von Aufträgen als Custom Post Type
  post-types/       – Registrierung des CPT `vorleitner_auftrag`
  rest-api/         – REST-Endpunkte für Formular-Submit und PDF-Download

templates/
  form-steps/       – Frontend-Schritte (Werkstatt & Abschleppen)
  pdf/              – PHP-Templates für PDF-Ausgabe

assets/
  css/              – Formularlayout und Schrittanzeige
  js/               – Formular-Init, Testdaten, Schritt-Navigation
```

## Einstellungen

Unter **WP-Admin → Einstellungen → Vorleitner Einstellungen** (Pods):

| Feld | Beschreibung |
|------|--------------|
| `vorleitner_testdaten_aktiv` | Aktiviert den „Testdaten ausfüllen"-Button im Frontend (nur für Admins sichtbar) |
| E-Mail Empfänger Werkstatt | Zieladresse für Werkstatt-Aufträge |
| E-Mail Empfänger Abschleppen | Zieladresse für Abschlepp-Aufträge |

## Abhängigkeiten

- [Pods Framework](https://pods.io/) – Custom Post Types & Einstellungs-Felder
- [mPDF](https://mpdf.github.io/) – PDF-Generierung (via Composer)
- WordPress 6+, PHP 8+
