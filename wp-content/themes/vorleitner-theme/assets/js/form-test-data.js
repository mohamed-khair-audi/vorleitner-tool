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
    }

    buildAbschleppData() {
        const dfToday    = new Date().toISOString().split('T')[0];
        const dfTomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];
        return {
            auftragsart:                    'privat',
            datum:                          dfToday,
            abholtermin:                    dfTomorrow,
            abholzeit:                      '14:00',
            kunde_vorname:                  'Max',
            kunde_nachname:                 'Mustermann',
            kunde_strasse:                  'Musterstraße',
            kunde_hausnummer:               '42',
            kunde_plz:                      '80331',
            kunde_ort:                      'München',
            kunde_telefon:                  '089123456789',
            fahrzeug_typ:                   'VW Golf 7',
            kennzeichen:                    'M-AB 1234',
            fahrzeug_gewicht_zulaessig:     '1800',
            einsatzort:                     'Leopoldstraße 50, 80802 München',
            schaden_beschreibung:           'Fahrzeug nicht fahrbereit, Motorschaden. Fahrzeug wurde gesichert.',
            sonstiges_bemerkung:            'Schlüssel beim Fahrer',
            'einsatz_beginn':               dfToday + 'T08:00',
            'einsatz_ende':                 dfToday + 'T10:30',
            fahrer_name:                    'Stefan Vorleitner',
            einsatz_fahrzeug_bezeichnung:   'Abschleppwagen 1 (M-AW 100)',
            'einsatz_typ[]':                ['panne'],
            standgeld_betrag_euro:          '25.00',
            standgeld_hingewiesen_am:       dfToday,
            'standgeld_hingewiesen_per[]':  ['telefon'],
            fahrzeug_versichert_bei:        'ADAC Versicherung',
            versicherung_schaden_nummer:    'SCH-2026-001234',
            interne_notizen:                'HINWEIS: Testdaten - bitte nicht absenden',
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
            fahrzeug_ident_nummer:              'WBA3C3100DF123456',
            annahmetermin:                      dfToday + 'T07:30',
            abholtermin_werkstatt:              dfToday + 'T17:00',
            ersatzfahrzeug_typ:                 'keines',
            kundenbeanstandung:                 'Motor zieht schlecht, Servicelampe leuchtet.',
            kostenangebot_euro:                 '450.00',
            arbeitsgang_und_ersatzteile:        'Ölwechsel durchgeführt. Luftfilter getauscht. Fehlerdiagnose: Steuergerät zurückgesetzt.',
            arbeitszeit_stunden:                '2.5',
            kundenberater_name:                 'Thomas Vorleitner',
            zustaendiger_monteur_name:          'Klaus Huber',
            probefahrt_durchgefuehrt:           '1',
            probefahrt_minuten:                 '15',
            motoroel_korrigiert_liter:          '5.5',
            motoroel_spezifikation:             '5W-30 LL04',
            kuehlmittel_ok:                     '1',
            motorraum_verschluesse_zu:          '1',
            fahrzeug_abholfertig_hergerichtet:  '1',
            abschlepphaken_entfernt:            '1',
            lack_spuren_entfernt:               '1',
            beleuchtung_ok:                     '1',
            serviceheft_eintrag_gemacht:        '1',
            service_intervall_zurueckgestellt:  '1',
            fahrzeug_gereinigt_innen_aussen:    '1',
            motoroel_stand_ok:                  '1',
            frostschutz_ok:                     '1',
            endkontrolle_fahrzeug_abholbereit:  '1',
            naechste_hauptuntersuchung:         '2028-06-15',
            werkstatt_notizen:                  'HINWEIS: Testdaten - bitte nicht absenden',
        };
    }
}
