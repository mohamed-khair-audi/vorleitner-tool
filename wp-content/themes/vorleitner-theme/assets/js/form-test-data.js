class FormTestData {
    constructor(dfFormSelector, dfFormType) {
        this.dfForm     = document.querySelector(dfFormSelector);
        this.dfFormType = dfFormType;
        this.dfButton   = document.querySelector('#fill-test-data-btn');
    }

    init() {
        if (!this.dfButton || !this.dfForm) return;
        this.dfButton.addEventListener('click', (dfEvent) => {
            dfEvent.preventDefault();
            this.fill();
        });
    }

    fill() {
        const dfData = this.dfFormType === 'abschleppen'
            ? this.buildAbschleppData()
            : this.buildWerkstattData();

        Object.entries(dfData).forEach(([dfName, dfValue]) => {
            if (Array.isArray(dfValue)) {
                this.dfForm.querySelectorAll(`[name="${CSS.escape(dfName)}"]`).forEach((dfEl) => {
                    dfEl.checked = dfValue.includes(dfEl.value);
                });
                return;
            }
            const dfRadio = this.dfForm.querySelector(
                `[name="${CSS.escape(dfName)}"][value="${CSS.escape(String(dfValue))}"]`
            );
            if (dfRadio && dfRadio.type === 'radio') { dfRadio.checked = true; return; }
            const dfInput = this.dfForm.querySelector(`[name="${CSS.escape(dfName)}"]`);
            if (dfInput) dfInput.value = dfValue;
        });

        this.dfForm.dispatchEvent(new Event('input', { bubbles: true }));
        if (typeof window.dfUpdateConditionals === 'function') {
            window.dfUpdateConditionals();
        }
    }

    buildAbschleppData() {
        const dfToday    = new Date().toISOString().split('T')[0];
        const dfTomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];
        const dfYesterday = new Date(Date.now() - 86400000).toISOString().split('T')[0];
        const dfLastWeek  = new Date(Date.now() - 7 * 86400000).toISOString().split('T')[0];
        return {
            // ── Schritt 1: Kundendaten ──
            kunde_vorname:                  'Max',
            kunde_nachname:                 'Mustermann',
            kunde_strasse:                  'Musterstraße',
            kunde_hausnummer:               '42',
            kunde_plz:                      '80331',
            kunde_ort:                      'München',
            kunde_telefon:                  '089 123 456 789',

            // ── Schritt 2: Fahrzeugdaten ──
            fahrzeug_typ:                   'VW Golf 7 1.6 TDI',
            kennzeichen:                    'M-AB 1234',
            fahrzeug_gewicht_zulaessig:     '1800',
            datum:                          dfToday,
            abholtermin:                    dfTomorrow,
            abholzeit:                      '14:00',

            // ── Schritt 3: Auftraggeber ──
            auftragsart:                    'adac',

            // ── Schritt 4: Standgeld & Auftragsart ──
            'einsatz_typ[]':                ['panne', 'bergung'],
            standgeld_betrag_euro:          '25.00',
            standgeld_hingewiesen_am:       dfToday,
            'standgeld_hingewiesen_per[]':  ['telefon', 'whatsapp'],

            // ── Schritt 5: Leistungen ──
            'zusatzleistungen[]':           ['strassenreinigung', 'bergung_stunden', 'schluessel_vorhanden'],
            bergung_stunden_anzahl:         '2.5',
            miet_ersatzfahrzeug:            'M-ER 5678 – Opel Astra',
            weitertransport_ziel:           'KFZ Huber GmbH, Schleißheimer Str. 10, München',
            sammler:                        'Bayerischer Bergungsdienst',

            // ── Schritt 6: Einsatzdaten ──
            einsatz_beginn:                 dfToday + 'T08:15',
            einsatz_ende:                   dfToday + 'T10:45',
            fahrer_name:                    'Stefan Vorleitner',
            einsatz_fahrzeug_bezeichnung:   'Abschleppwagen 1 (M-AW 100)',

            // ── Schritt 7: Auftragsbestätigung ──
            einsatzort:                     'Leopoldstraße 50, 80802 München – Höhe Hausnummer 50',
            schaden_beschreibung:           'Fahrzeug nicht fahrbereit, Motorschaden. Fahrzeug stand auf der Fahrbahn und wurde gesichert. Totalschaden nicht auszuschließen.',
            sonstiges_bemerkung:            'Schlüssel beim Fahrer hinterlegt. Fahrzeug verschlossen übergeben.',
            fahrzeug_abgeholt_am:           dfYesterday,
            fahrzeug_abgeholt_durch:        'Max Mustermann (Eigentümer)',

            // ── Schritt 8: Versicherung & Zusatzdaten ──
            fahrzeug_versichert_bei:        'ADAC Versicherung AG',
            versicherung_schaden_nummer:    'SCH-2026-001234',
            kennzeichen_abgeholt_am:        dfYesterday,
            kennzeichen_abgeholt_durch:     'Max Mustermann',
            fahrzeuginhalt_entnommen_am:    dfYesterday,
            fahrzeuginhalt_entnommen_durch: 'Stefan Vorleitner (Fahrer)',
            fahrzeuginhalt_gegenstaende:    'Kindersitz, Regenmantel, Verbandskasten, Warndreieck',
            sichergestellt_am:              dfLastWeek,
            sichergestellt_durch:           'Polizei München',
            freigabe_am:                    dfYesterday,
            freigabe_durch:                 'PI München Mitte',
            besichtigt_am:                  dfToday,
            besichtigt_durch:               'Gutachter Huber (DEKRA)',

            // ── Schritt 9: Notizen ──
            interne_notizen:                'HINWEIS: Testdaten – bitte nicht absenden.\nFahrzeug steht im Hof Reihe 3, Platz 7.',
        };
    }

    buildWerkstattData() {
        const dfToday = new Date().toISOString().split('T')[0];
        return {
            kunde_vorname:                      'Maria',
            kunde_nachname:                     'Musterfrau',
            kunde_strasse:                      'Bahnhofstraße',
            kunde_hausnummer:                   '15',
            kunde_plz:                          '80335',
            kunde_ort:                          'München',
            kunde_telefon:                      '089987654321',
            kunde_email:                        'maria.musterfrau@example.com',
            fahrzeug_typ_modell:                'BMW 320d F30',
            motor_nummer:                       'N47D20C123456',
            kennzeichen:                        'M-BW 3200',
            km_stand:                           '87500',
            fahrzeug_ident_nummer:              'WBA3C3100DF123456',
            annahmetermin:                      dfToday + 'T07:30',
            abholtermin_werkstatt:              dfToday + 'T17:00',
            ersatzfahrzeug_typ:                 'werkstattersatzfahrzeug',
            ersatzfahrzeug_info:                'M-WE 999 – VW Polo',
            kundenbeanstandung:                 'Motor zieht schlecht, Servicelampe leuchtet.',
            kostenangebot_euro:                 '450.00',
            arbeitsgang_und_ersatzteile:        'Ölwechsel durchgeführt. Luftfilter getauscht. Fehlerdiagnose: Steuergerät zurückgesetzt.',
            arbeitszeit_stunden:                '2.5',
            kundenberater_name:                 'Thomas Vorleitner',
            zustaendiger_monteur_name:          'Klaus Huber',
            probefahrt_durchgefuehrt:           '1',
            probefahrt_minuten:                 '15',
            motorraum_verschluesse_zu:          '1',
            fahrzeug_abholfertig_hergerichtet:  '1',
            abschlepphaken_entfernt:            '1',
            lack_spuren_entfernt:               '1',
            beleuchtung_ok:                     '1',
            serviceheft_eintrag_gemacht:        '1',
            service_intervall_zurueckgestellt:  '1',
            radschrauben_angezogen_durch:       'K. Huber',
            oelablassschraube_nachgezogen_durch:'K. Huber',
            fahrzeug_gereinigt_innen_aussen:    '1',
            motoroel_stand_ok:                  '0',
            motoroel_korrigiert_liter:          '0.5',
            motoroel_spezifikation:             '5W-30 LL04',
            kuehlmittel_ok:                     '0',
            kuehlmittel_korrigiert_liter:       '0.3',
            frostschutz_ok:                     '0',
            frostschutz_temperatur_grad:        '-25',
            endkontrolle_durchgefuehrt:         '1',
            endkontrolle_fahrzeug_abholbereit:  '1',
            naechste_hauptuntersuchung:         '2028-06-15',
            werkstatt_notizen:                  'HINWEIS: Testdaten – bitte nicht absenden.\nFahrzeug wurde am Vormittag übergeben.',
        };
    }
}
