<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: dejavusans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; line-height: 1.4; }

/* ── Tabellen & Felder (identisch mit Werkstatt-PDF) ── */
table          { border-collapse: collapse; width: 100%; }
td             { padding: 5px 7px; vertical-align: top; }
td.lbl         { background: #f0f0f0; font-weight: bold; font-size: 8.5pt; color: #333; white-space: nowrap; }
td.val         { background: #fff; font-size: 9.5pt; min-height: 18px; }

/* ── Sektions-Titel (roter Balken, identisch mit Werkstatt-PDF) ── */
.sec           { background: #D92B1A; color: #fff; font-weight: bold; font-size: 9pt;
                 padding: 5px 8px; letter-spacing: 0.4px; }

/* ── Header ── */
.hdr-main      { font-size: 20pt; font-weight: bold; color: #D92B1A; line-height: 1.15; text-align: right; }
.hdr-sub       { font-size: 12pt; font-weight: bold; color: #D92B1A; text-align: right; margin-top: 3px; }
.doc-header    { width: 100%; margin-bottom: 10px; border-bottom: 2pt solid #D92B1A; padding-bottom: 10px; }
.doc-header td { border: none; background: none; padding: 0; vertical-align: middle; }

/* ── Checkboxen ── */
.cb-row  { font-size: 8pt; line-height: 1.9; }
.cb-item { display: inline; margin-right: 10px; white-space: nowrap; }
.cb-box  { font-size: 11pt; }

/* ── Leistungen (2-Spalten-Block) ── */
.cl-td   { padding: 4px 8px; font-size: 8.5pt; line-height: 1.4; }

/* ── Rechtstext ── */
.legal   { font-size: 7.5pt; color: #555; line-height: 1.5; border: 0.5pt solid #ccc;
           padding: 6px 8px; background: #fafafa; margin: 7px 0; }

/* ── Seite 2 ── */
.page-break  { page-break-before: always; }
.note-line   { border-bottom: 0.5pt solid #ccc; height: 22px; }
</style>
</head>
<body>

<?php
$dfLogoPath = get_template_directory() . '/assets/imgs/logo_vorleitner.png';
$dfDocDate  = date('d.m.Y');

function dfCb(bool $dfChecked): string {
    return $dfChecked ? '&#9745;' : '&#9744;';
}
function dfVal(array $dfData, string $dfKey, string $dfDefault = ''): string {
    return PdfFieldOutput::text((string) ($dfData[$dfKey] ?? $dfDefault));
}

$dfAuftragsart      = $dfData['auftragsart'] ?? '';
$dfEinsatzTypen     = (array)($dfData['einsatz_typ'] ?? []);
$dfHinweisKanaele   = (array)($dfData['standgeld_hingewiesen_per'] ?? []);
$dfZusatz           = (array)($dfData['zusatzleistungen'] ?? []);
$dfHasZusatz        = fn(string $k): bool => in_array($k, $dfZusatz, true);
?>

<!-- ═══ SEITE 1 ════════════════════════════════════════════════ -->

<!-- 1. HEADER -->
<table class="doc-header">
<tr>
    <td style="width:50%">
        <?php if (file_exists($dfLogoPath)): ?>
            <img src="<?= $dfLogoPath ?>" height="44" alt="Vorleitner">
        <?php else: ?>
            <span style="font-size:22pt;font-weight:bold;color:#D92B1A">VORLEITNER</span>
        <?php endif; ?>
    </td>
    <td style="width:50%">
        <div class="hdr-main">Auftragskarte</div>
        <div class="hdr-sub">Abschleppdienst</div>
    </td>
</tr>
</table>

<!-- 2. KUNDENDATEN | FAHRZEUGDATEN (2 Spalten) -->
<table style="margin-bottom:8px">
<tr>

    <!-- ── Kundendaten ── -->
    <td style="width:49%;vertical-align:top;padding:0;border:none">
        <table style="width:100%;border:0.5pt solid #ccc">
            <tr><td colspan="2" class="sec">Kundendaten</td></tr>
            <tr>
                <td class="lbl" style="width:42%;border:0.5pt solid #ccc">Name, Vorname</td>
                <td class="val" style="border:0.5pt solid #ccc">
                    <?= dfVal($dfData,'kunde_nachname') ?>, <?= dfVal($dfData,'kunde_vorname') ?>
                </td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Stra&szlig;e / Nr.</td>
                <td class="val" style="border:0.5pt solid #ccc">
                    <?= dfVal($dfData,'kunde_strasse') ?> <?= dfVal($dfData,'kunde_hausnummer') ?>
                </td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">PLZ / Ort</td>
                <td class="val" style="border:0.5pt solid #ccc">
                    <?= dfVal($dfData,'kunde_plz') ?> <?= dfVal($dfData,'kunde_ort') ?>
                </td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Telefon</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kunde_telefon') ?></td>
            </tr>
        </table>
    </td>

    <td style="width:4px;border:none;padding:0"></td>

    <!-- ── Fahrzeugdaten ── -->
    <td style="width:49%;vertical-align:top;padding:0;border:none">
        <table style="width:100%;border:0.5pt solid #ccc">
            <tr><td colspan="4" class="sec">Fahrzeugdaten</td></tr>
            <tr>
                <td class="lbl" style="width:22%;border:0.5pt solid #ccc">Datum</td>
                <td class="val" style="width:28%;border:0.5pt solid #ccc"><?= dfVal($dfData,'datum_formatiert',$dfDocDate) ?></td>
                <td class="lbl" style="width:20%;border:0.5pt solid #ccc">Uhrzeit</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'abholzeit') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Fahrzeug</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrzeug_typ') ?></td>
                <td class="lbl" style="border:0.5pt solid #ccc">Gew.</td>
                <td class="val" style="border:0.5pt solid #ccc">
                    <?= dfVal($dfData,'fahrzeug_gewicht_zulaessig') ?><?= !empty($dfData['fahrzeug_gewicht_zulaessig']) ? '&thinsp;kg' : '' ?>
                </td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Kennzeichen</td>
                <td class="val" colspan="3" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kennzeichen') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Abholtermin</td>
                <td class="val" colspan="3" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'abholtermin_formatiert') ?></td>
            </tr>
        </table>
    </td>

</tr>
</table>

<!-- 3. AUFTRAGSGEBER -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr>
    <td class="sec" style="width:26%;white-space:nowrap">Auftragsgeber</td>
    <td class="val cb-row" style="border-left:0.5pt solid #ccc">
        <?php foreach (AbschleppFieldLabels::auftragsart() as $dfV => $dfL): ?>
            <span class="cb-item"><span class="cb-box"><?= dfCb($dfAuftragsart === $dfV) ?></span> <?= $dfL ?></span>
        <?php endforeach; ?>
    </td>
</tr>
</table>

<!-- 4. STANDGELD + AUFTRAGSART -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Standgeld &amp; Auftragsart</td></tr>
<tr>
    <!-- Standgeld (links) -->
    <td style="width:50%;vertical-align:top;padding:0;border-right:0.5pt solid #ccc">
        <table style="width:100%;border-collapse:collapse">
            <tr>
                <td class="lbl" style="width:46%;border:0.5pt solid #ccc">Standgeld</td>
                <td class="val" style="border:0.5pt solid #ccc">
                    <?= dfVal($dfData,'standgeld_betrag_euro') ?><?= !empty($dfData['standgeld_betrag_euro']) ? '&thinsp;&euro; zzgl. MwSt.' : '' ?>
                </td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Hingewiesen am</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'standgeld_hingewiesen_am_formatiert') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Hingewiesen per</td>
                <td class="val cb-row" style="border:0.5pt solid #ccc">
                    <?php foreach (AbschleppFieldLabels::hinweisPerKanal() as $dfV => $dfL): ?>
                        <span class="cb-item"><span class="cb-box"><?= dfCb(in_array($dfV,$dfHinweisKanaele,true)) ?></span> <?= $dfL ?></span>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </td>
    <!-- Auftragsart (rechts) -->
    <td style="width:50%;vertical-align:top;padding:0">
        <table style="width:100%;border-collapse:collapse">
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Auftragsart</td>
            </tr>
            <tr>
                <td class="val cb-row" style="border:0.5pt solid #ccc;padding:6px 8px">
                    <?php foreach (AbschleppFieldLabels::einsatzTyp() as $dfV => $dfL): ?>
                        <span class="cb-item"><span class="cb-box"><?= dfCb(in_array($dfV,$dfEinsatzTypen,true)) ?></span> <?= $dfL ?></span>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>

<!-- 5. LEISTUNGEN / CHECKLISTE (2 Spalten) -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Leistungen / Checkliste</td></tr>
<tr>

    <!-- ── LINKE SPALTE ── -->
    <td style="width:50%;vertical-align:top;border-right:0.5pt solid #ccc;padding:0">
    <table style="width:100%;border-collapse:collapse">

        <tr><td class="cl-td">
            <span class="cb-box"><?= dfCb($dfHasZusatz('strassenreinigung')) ?></span>
            Stra&szlig;enreinigung
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('reinigung_einsatzfahrzeug')) ?></span>
            Reinigung Einsatzfahrzeug
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('reinigung_standflaeche')) ?></span>
            Reinigung Standfläche
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('gabelstapler')) ?></span>
            Gabelstaplereinsatz
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('gdv_pauschale')) ?></span>
            GDV-Notdienstpauschale
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('bergung_stunden')) ?></span>
            Bergung<?= !empty($dfData['bergung_stunden_anzahl']) ? ' &mdash; <strong>' . dfVal($dfData,'bergung_stunden_anzahl') . '&thinsp;Std.</strong>' : ' ___&thinsp;Std.' ?>
        </td></tr>

    </table>
    </td>

    <!-- ── RECHTE SPALTE ── -->
    <td style="width:50%;vertical-align:top;padding:0">
    <table style="width:100%;border-collapse:collapse">

        <tr><td class="cl-td">
            <span class="cb-box"><?= dfCb($dfHasZusatz('bergungshelfer')) ?></span>
            Bergungshelfer
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('gutachter')) ?></span>
            Gutachter beauftragen
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('schluessel_vorhanden')) ?></span>
            Schl&uuml;ssel vorhanden
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfHasZusatz('gewichtszuschlag')) ?></span>
            Gewichtszuschlag
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd;color:#555">
            Miet- / Ersatzfahrzeug:
            <?php $dfMiet = dfVal($dfData,'miet_ersatzfahrzeug'); ?>
            <?= $dfMiet !== '' ? '<strong style="color:#1a1a1a"> ' . $dfMiet . '</strong>' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd;color:#555">
            Weitertransport:
            <?php $dfWt = dfVal($dfData,'weitertransport_ziel'); ?>
            <?= $dfWt !== '' ? '<strong style="color:#1a1a1a"> ' . $dfWt . '</strong>' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd;color:#555">
            Sammler:
            <?php $dfSamm = dfVal($dfData,'sammler'); ?>
            <?= $dfSamm !== '' ? '<strong style="color:#1a1a1a"> ' . $dfSamm . '</strong>' : '' ?>
        </td></tr>

    </table>
    </td>

</tr>
</table>

<!-- 6. EINSATZDATEN -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr>
    <td class="lbl" style="width:22%;border:0.5pt solid #ccc">Einsatzbeginn</td>
    <td class="val" style="width:28%;border:0.5pt solid #ccc"><?= dfVal($dfData,'einsatz_beginn_formatiert') ?></td>
    <td class="lbl" style="width:20%;border:0.5pt solid #ccc">Einsatzende</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'einsatz_ende_formatiert') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Fahrer</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrer_name') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Einsatzfahrzeug</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'einsatz_fahrzeug_bezeichnung') ?></td>
</tr>
</table>

<!-- 7. AUFTRAGSBESTÄTIGUNG -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Auftragsbestätigung</td></tr>
<tr>
    <td class="lbl" style="width:28%;border:0.5pt solid #ccc">Einsatzort</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:28px">
        <?= PdfFieldOutput::textMultiline((string)($dfData['einsatzort'] ?? '')) ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Schaden / Bemerkung</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:80px">
        <?= PdfFieldOutput::textMultiline((string)($dfData['schaden_beschreibung'] ?? '')) ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Sonstiges</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:52px">
        <?= PdfFieldOutput::textMultiline((string)($dfData['sonstiges_bemerkung'] ?? '')) ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Fahrzeug abgeholt am</td>
    <td class="val" style="border:0.5pt solid #ccc;width:22%"><?= dfVal($dfData,'fahrzeug_abgeholt_am_formatiert') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc;width:22%">Abgeholt durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrzeug_abgeholt_durch') ?></td>
</tr>
</table>

<!-- ═══ SEITE 2 ════════════════════════════════════════════════ -->
<div class="page-break">

<!-- 8. VERSICHERUNGS- / INHALTSBEREICH (2 Spalten) -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Versicherung &amp; Fahrzeuginhalt</td></tr>
<tr>
    <!-- Linke Spalte -->
    <td style="width:50%;vertical-align:top;padding:0;border-right:0.5pt solid #ccc">
        <table style="width:100%;border-collapse:collapse">
            <tr>
                <td class="lbl" style="width:48%;border:0.5pt solid #ccc">Fahrzeug versichert bei</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrzeug_versichert_bei') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Schadennummer</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'versicherung_schaden_nummer') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Kennzeichen abgeholt am</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kennzeichen_abgeholt_am_formatiert') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Kennzeichen abgeholt durch</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kennzeichen_abgeholt_durch') ?></td>
            </tr>
        </table>
    </td>
    <!-- Rechte Spalte -->
    <td style="width:50%;vertical-align:top;padding:0">
        <table style="width:100%;border-collapse:collapse">
            <tr>
                <td class="lbl" style="width:48%;border:0.5pt solid #ccc">Inhalt entnommen am</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrzeuginhalt_entnommen_am_formatiert') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Inhalt entnommen durch</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrzeuginhalt_entnommen_durch') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Gegenst&auml;nde</td>
                <td class="val" style="border:0.5pt solid #ccc;min-height:32px">
                    <?= PdfFieldOutput::textMultiline((string)($dfData['fahrzeuginhalt_gegenstaende'] ?? '')) ?>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>

<!-- 9. SICHERSTELLUNG & FREIGABE -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Sicherstellung &amp; Freigabe</td></tr>
<tr>
    <td class="lbl" style="width:22%;border:0.5pt solid #ccc">Sichergestellt am</td>
    <td class="val" style="width:28%;border:0.5pt solid #ccc"><?= dfVal($dfData,'sichergestellt_am_formatiert') ?></td>
    <td class="lbl" style="width:22%;border:0.5pt solid #ccc">Sichergestellt durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'sichergestellt_durch') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Freigabe am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'freigabe_am_formatiert') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Freigabe durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'freigabe_durch') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Besichtigt am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'besichtigt_am_formatiert') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Besichtigt durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'besichtigt_durch') ?></td>
</tr>
</table>

<!-- 10. RECHTSTEXT -->
<div class="legal">
    Wir m&ouml;chten Sie darauf hinweisen, dass f&uuml;r Ihr abgestelltes Fahrzeug Standgeld verrechnet wird. Wir bitten Sie in Ihrem eigenen Interesse, lange Standzeiten zu vermeiden.
    Die Herausgabe des Fahrzeugs kann nur an den Eigent&uuml;mer oder eine durch Vollmacht berechtigte Person erfolgen. Alle angefallenen Kosten m&uuml;ssen bei Abholung beglichen werden.
    Der Unterzeichnende erteilt den Auftrag f&uuml;r Abschlepp- &amp; Bergungsarbeiten, f&uuml;r alle anfallenden Reinigungsarbeiten und f&uuml;r das Hinterstellen des Fahrzeugs.
    Er best&auml;tigt ausdr&uuml;cklich, dass er zur Erteilung des Auftrages berechtigt ist und unsere AGBs sowie Datenschutzbestimmungen anerkennt.
    <strong>www.vorleitner.de/impressum</strong> &amp; <strong>www.vorleitner.de/datenschutz</strong>
</div>

<!-- 11. UNTERSCHRIFT -->
<table style="margin-bottom:7px;border-collapse:collapse">
<tr>
    <td style="white-space:nowrap;font-weight:bold;font-size:9.5pt;padding-right:8px;vertical-align:bottom;border:none">
        Datum / Unterschrift:
    </td>
    <td style="border-bottom:0.5pt solid #333;width:100%;vertical-align:bottom;padding-bottom:2px;border-top:none;border-left:none;border-right:none">
        &nbsp;
    </td>
</tr>
</table>

<!-- 12. NOTIZEN -->
<div style="margin-top:10px;font-weight:bold;font-size:9pt;margin-bottom:4px">Notizen:</div>
<?php if (!empty(trim($dfData['interne_notizen'] ?? ''))): ?>
<div style="font-size:9pt;color:#1a1a1a;line-height:1.7;padding:0 2px;margin-bottom:4px">
    <?= PdfFieldOutput::textMultiline((string) $dfData['interne_notizen']) ?>
</div>
<?php endif; ?>
<?php for ($dfI = 0; $dfI < 8; $dfI++): ?>
<div class="note-line"></div>
<?php endfor; ?>

</div><!-- /.page-break -->

</body>
</html>
