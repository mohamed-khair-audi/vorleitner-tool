<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: dejavusans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; line-height: 1.4; }

table        { border-collapse: collapse; width: 100%; }
td           { padding: 5px 7px; vertical-align: top; }
td.lbl       { background: #f0f0f0; font-weight: bold; font-size: 8.5pt; color: #333; white-space: nowrap; }
td.val       { background: #fff; font-size: 9.5pt; min-height: 18px; }

.sec         { background: #D92B1A; color: #fff; font-weight: bold; font-size: 9pt;
               padding: 5px 8px; letter-spacing: 0.4px; }

.hdr-title   { font-size: 20pt; font-weight: bold; color: #D92B1A; line-height: 1.15; text-align: right; }
.hdr-sub     { font-size: 12pt; color: #555; text-align: right; margin-top: 4px; }

.doc-header  { width: 100%; margin-bottom: 10px; border-bottom: 2pt solid #D92B1A; padding-bottom: 10px; }
.doc-header td { border: none; background: none; padding: 0; vertical-align: middle; }
.doc-header__brand { width: 50%; }
.doc-header__brand-sub { font-size: 8pt; color: #777; margin-top: 10px; line-height: 1.4; }
.doc-header__title { width: 50%; text-align: right; }

.cb-row      { font-size: 9pt; line-height: 2; }
.cb-item     { display: inline; margin-right: 14px; white-space: nowrap; }
.cb-box      { font-size: 11pt; }

.legal       { font-size: 7.5pt; color: #555; line-height: 1.5; border: 0.5pt solid #ccc;
               padding: 6px 8px; background: #fafafa; margin: 7px 0; }

.sig-box     { border: 0.5pt dashed #aaa; height: 60px; background: #fafafa; }
.sig-box img { max-height: 58px; max-width: 100%; display: block; }

.page-break-before { page-break-before: always; }

/* Checklist table */
table.cl td  { padding: 4.5px 7px; border: 0.5pt solid #ccc; }
table.cl td.cl-lbl { background: #f7f7f7; font-size: 9pt; width: 55%; }
table.cl td.cl-ja  { text-align: center; width: 22.5%; font-size: 10pt; color: #1a7a1a; }
table.cl td.cl-nein{ text-align: center; width: 22.5%; font-size: 10pt; color: #aaa; }
table.cl tr.cl-head td { background: #555; color: #fff; font-weight: bold; font-size: 8.5pt; text-align: center; }
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
?>

<!-- ═══════════════════ SEITE 1 ═══════════════════ -->

<!-- Header -->
<table class="doc-header">
<tr>
    <td class="doc-header__brand">
        <?php if (file_exists($dfLogoPath)): ?>
            <img src="<?= $dfLogoPath ?>" height="44" alt="Vorleitner">
        <?php endif; ?>
        <div class="doc-header__brand-sub">Werkstatt &amp; Service | M&uuml;nchen</div>
    </td>
    <td class="doc-header__title">
        <div class="hdr-title">Auftragskarte</div>
        <div class="hdr-sub">Werkstatt</div>
    </td>
</tr>
</table>

<!-- Kundendaten | Fahrzeugdaten -->
<table style="margin-bottom:8px">
<tr>
    <td style="width:50%;padding:0;vertical-align:top;border:none">
        <table style="width:100%;border:0.5pt solid #ccc">
            <tr><td colspan="2" class="sec">Kundendaten</td></tr>
            <tr>
                <td class="lbl" style="width:42%;border:0.5pt solid #ccc">Name, Vorname</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kunde_nachname') ?>, <?= dfVal($dfData, 'kunde_vorname') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Straße / Hausnummer</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kunde_strasse') ?> <?= dfVal($dfData, 'kunde_hausnummer') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">PLZ / Ort</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kunde_plz') ?> <?= dfVal($dfData, 'kunde_ort') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Telefon</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kunde_telefon') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">E-Mail</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kunde_email') ?></td>
            </tr>
        </table>
    </td>
    <td style="width:4px;border:none;padding:0"></td>
    <td style="width:50%;padding:0;vertical-align:top;border:none">
        <table style="width:100%;border:0.5pt solid #ccc">
            <tr><td colspan="2" class="sec">Fahrzeugdaten</td></tr>
            <tr>
                <td class="lbl" style="width:42%;border:0.5pt solid #ccc">Typ / Modell</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeug_typ_modell') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Amtl. Kennzeichen</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kennzeichen') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">KM-Stand</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'km_stand') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Motor-Nr.</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'motor_nummer') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Fahrzeug-Ident-Nr.</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeug_ident_nummer') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Annahmetermin</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'annahmetermin_formatiert') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Abholtermin</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'abholtermin_werkstatt_formatiert') ?></td>
            </tr>
        </table>
    </td>
</tr>
</table>

<!-- Ersatzfahrzeug -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr>
    <td class="lbl" style="width:28%;border:0.5pt solid #ccc">Mietfahrzeug / Ersatzfahrzeug</td>
    <td class="val cb-row" style="border:0.5pt solid #ccc">
        <?php
        $dfErsatz = $dfData['ersatzfahrzeug_typ'] ?? '';
        foreach (WerkstattFieldLabels::ersatzfahrzeugTyp() as $dfV => $dfL):
        ?>
            <span class="cb-item"><span class="cb-box"><?= dfCb($dfErsatz === $dfV) ?></span> <?= $dfL ?></span>
        <?php endforeach; ?>
    </td>
</tr>
</table>

<!-- Ersatzteile & Leistungsnachweis -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Ersatzteile- &amp; Leistungsnachweis</td></tr>
<tr>
    <td class="lbl" style="width:28%;border:0.5pt solid #ccc">Kundenbeanstandung</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:18px"><?= PdfFieldOutput::textMultiline((string) ($dfData['kundenbeanstandung'] ?? '')) ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Kostenangebot</td>
    <td class="val" style="border:0.5pt solid #ccc;width:22%"><?= dfVal($dfData, 'kostenangebot_euro') ?><?= !empty($dfData['kostenangebot_euro']) ? ' €' : '' ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc;width:22%">Arbeitszeit</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'arbeitszeit_stunden') ?><?= !empty($dfData['arbeitszeit_stunden']) ? ' Std.' : '' ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Arbeitsgang / Ersatzteile</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:28px"><?= PdfFieldOutput::textMultiline((string) ($dfData['arbeitsgang_und_ersatzteile'] ?? '')) ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Kundenberater</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kundenberater_name') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Zuständiger Monteur</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'zustaendiger_monteur_name') ?></td>
</tr>
</table>

<!-- Checkliste -->
<table class="cl" style="margin-bottom:8px">
<tr class="cl-head">
    <td class="cl-lbl">Checkliste</td>
    <td class="cl-ja">&#10003; Ja</td>
    <td class="cl-nein">– Nein</td>
</tr>
<?php
$dfChecklistItems = WerkstattFieldLabels::checklistItems();
foreach ($dfChecklistItems as $dfField => $dfLabel):
    $dfIsOk = ($dfData[$dfField] ?? '0') === '1';
?>
<tr>
    <td class="cl-lbl"><?= esc_html($dfLabel) ?></td>
    <td class="cl-ja"><?= $dfIsOk ? '&#10003;' : '' ?></td>
    <td class="cl-nein"><?= !$dfIsOk ? '&#8211;' : '' ?></td>
</tr>
<?php endforeach; ?>
<tr>
    <td class="cl-lbl" style="padding-left:12px;font-size:7.5pt;color:#555">&#8627; Probefahrt (Min.)</td>
    <td class="cl-ja" colspan="2" style="text-align:left;padding-left:8px"><?= dfVal($dfData, 'probefahrt_minuten') ?></td>
</tr>
</table>

<!-- Flüssigkeiten -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Flüssigkeiten &amp; Sonstiges</td></tr>
<tr>
    <td class="lbl" style="width:30%;border:0.5pt solid #ccc">Motoröl korrigiert</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'motoroel_korrigiert_liter') ?><?= !empty($dfData['motoroel_korrigiert_liter']) ? ' L' : '' ?></td>
    <td class="lbl" style="width:26%;border:0.5pt solid #ccc">Motoröl-Spezifikation</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'motoroel_spezifikation') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Kühlmittel korrigiert</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kuehlmittel_korrigiert_liter') ?><?= !empty($dfData['kuehlmittel_korrigiert_liter']) ? ' L' : '' ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Frostschutz bis</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'frostschutz_temperatur_grad') ?><?= !empty($dfData['frostschutz_temperatur_grad']) ? '°C' : '' ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Radschrauben angezogen durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'radschrauben_angezogen_durch') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Ölablassschraube nachgezogen durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'oelablassschraube_nachgezogen_durch') ?></td>
</tr>
</table>

<!-- Endkontrolle -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Endkontrolle</td></tr>
<?php $dfAbholbereit = ($dfData['endkontrolle_fahrzeug_abholbereit'] ?? '0') === '1'; ?>
<tr>
    <td class="lbl" style="width:30%;border:0.5pt solid #ccc">Fahrzeugstatus</td>
    <td colspan="3" style="border:0.5pt solid #ccc;padding:4px 6px">
        <span class="cb-box"><?= dfCb($dfAbholbereit) ?></span>
        <strong style="color:<?= $dfAbholbereit ? '#1a7a1a' : '#cc0000' ?>">
            <?= $dfAbholbereit ? 'Fahrzeug abholbereit' : 'Fahrzeug NICHT abholbereit – darf nicht bewegt werden' ?>
        </strong>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Nächste Hauptuntersuchung</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'naechste_hu_formatiert') ?></td>
</tr>
</table>

<?php if (!empty(trim($dfData['werkstatt_notizen'] ?? ''))): ?>
<!-- Notizen (Seite 1) -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td class="sec">Notizen</td></tr>
<tr><td style="padding:6px;font-style:italic;color:#333"><?= PdfFieldOutput::textMultiline((string) $dfData['werkstatt_notizen']) ?></td></tr>
</table>
<?php endif; ?>

<!-- Legal -->
<div class="legal">
    Sehr geehrter Kunde, mit der Unterschrift bestätigen Sie als Kunde, dass Sie uns als Reparaturwerkstatt beauftragen, um an Ihrem KFZ den Befund festzulegen,
    die benötigten Ersatzteile zu bestellen und einzubauen, und die Reparatur durchzuführen.
    Die Fehlersuche und Schadensfeststellung ist kostenpflichtig. Falls Ihr Fahrzeug nicht bis zur vollen Fahrtüchtigkeit repariert wird, fallen ab dem fünften Tag
    des Abstellens Standgebühren an. Ihr Fahrzeug kann erst herausgegeben werden, wenn alle Kosten beglichen wurden.
    Sie bestätigen, dass Sie unsere AGBs und Datenschutzbestimmungen gelesen haben und diese anerkennen.
    <strong>www.vorleitner.de/impressum</strong> &amp; <strong>www.vorleitner.de/datenschutz</strong>
</div>

<!-- Unterschrift -->
<table style="border:0.5pt solid #ccc">
<tr>
    <td style="width:28%;border:0.5pt solid #ccc" class="lbl">Datum / Unterschrift<br><span style="font-weight:normal;font-size:7pt;color:#777"><?= $dfDocDate ?></span></td>
    <td style="border:0.5pt solid #ccc;padding:3px">
        <?php if (!empty($dfData['unterschrift_base64'])): ?>
            <div class="sig-box"><img src="<?= $dfData['unterschrift_base64'] ?>" alt="Unterschrift"></div>
        <?php else: ?>
            <div class="sig-box"></div>
        <?php endif; ?>
    </td>
</tr>
</table>

</body>
</html>
