<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: dejavusans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; line-height: 1.4; }

/* ── Tables ── */
table          { border-collapse: collapse; width: 100%; }
td             { padding: 5px 7px; vertical-align: top; }
td.lbl         { background: #f0f0f0; font-weight: bold; font-size: 8.5pt; color: #333; white-space: nowrap; }
td.val         { background: #fff; font-size: 9.5pt; min-height: 18px; }

/* ── Section Titles ── */
.sec           { background: #D92B1A; color: #fff; font-weight: bold; font-size: 9pt;
                 padding: 5px 8px; letter-spacing: 0.4px; }

/* ── Header ── */
.hdr-title     { font-size: 20pt; font-weight: bold; color: #D92B1A; line-height: 1.15; text-align: right; }
.hdr-subtitle  { font-size: 12pt; color: #555; text-align: right; margin-top: 4px; }

.doc-header  { width: 100%; margin-bottom: 10px; border-bottom: 2pt solid #D92B1A; padding-bottom: 10px; }
.doc-header td { border: none; background: none; padding: 0; vertical-align: middle; }
.doc-header__brand { width: 50%; }
.doc-header__brand-sub { font-size: 8pt; color: #777; margin-top: 10px; line-height: 1.4; }
.doc-header__title { width: 50%; text-align: right; }

/* ── Checkboxes ── */
.cb-row        { font-size: 9pt; line-height: 2; }
.cb-item       { display: inline; margin-right: 14px; white-space: nowrap; }
.cb-box        { font-size: 11pt; }

/* ── Legal ── */
.legal         { font-size: 7.5pt; color: #555; line-height: 1.5; border: 0.5pt solid #ccc;
                 padding: 6px 8px; background: #fafafa; margin: 7px 0; }

/* ── Signature ── */
.sig-box       { border: 0.5pt dashed #aaa; height: 60px; background: #fafafa; }
.sig-box img   { max-height: 58px; max-width: 100%; display: block; }

.page-break-before { page-break-before: always; }
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
$dfAuftragsart    = $dfData['auftragsart'] ?? '';
$dfEinsatzTypen   = (array)($dfData['einsatz_typ'] ?? []);
$dfHinweisKanaele = (array)($dfData['standgeld_hingewiesen_per'] ?? []);
$dfZusatzleistungen = (array)($dfData['zusatzleistungen'] ?? []);
?>

<!-- ═══════════════════ SEITE 1 ═══════════════════ -->

<!-- Header -->
<table class="doc-header">
<tr>
    <td class="doc-header__brand">
        <?php if (file_exists($dfLogoPath)): ?>
            <img src="<?= $dfLogoPath ?>" height="44" alt="Vorleitner">
        <?php endif; ?>
        <div class="doc-header__brand-sub">Abschlepp- &amp; Pannendienst | M&uuml;nchen</div>
    </td>
    <td class="doc-header__title">
        <div class="hdr-title">Auftragskarte</div>
        <div class="hdr-subtitle">Abschleppdienst</div>
    </td>
</tr>
</table>

<!-- Kundendaten | Fahrzeugdaten (2 Spalten) -->
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
                <td class="lbl" style="border:0.5pt solid #ccc">Stra&szlig;e / Hausnummer</td>
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
        </table>
    </td>
    <td style="width:4px;border:none;padding:0"></td>
    <td style="width:50%;padding:0;vertical-align:top;border:none">
        <table style="width:100%;border:0.5pt solid #ccc">
            <tr><td colspan="2" class="sec">Fahrzeugdaten</td></tr>
            <tr>
                <td class="lbl" style="width:42%;border:0.5pt solid #ccc">Datum</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'datum_formatiert', $dfDocDate) ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Fahrzeug</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeug_typ') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Kennzeichen</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kennzeichen') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Abholtermin</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'abholtermin_formatiert') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Uhrzeit</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'abholzeit') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">zul. ges. Gew.</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeug_gewicht_zulaessig') ?><?= !empty($dfData['fahrzeug_gewicht_zulaessig']) ? ' kg' : '' ?></td>
            </tr>
        </table>
    </td>
</tr>
</table>

<!-- Auftragsgeber -->
<table style="margin-bottom:8px">
<tr>
    <td class="sec" style="width:22%">Auftragsgeber</td>
    <td style="padding:5px 8px;border:0.5pt solid #ccc" class="cb-row">
        <?php foreach (AbschleppFieldLabels::auftragsart() as $dfV => $dfL): ?>
            <span class="cb-item"><span class="cb-box"><?= dfCb($dfAuftragsart === $dfV) ?></span> <?= $dfL ?></span>
        <?php endforeach; ?>
    </td>
</tr>
</table>

<!-- Einsatzdetails -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
    <tr><td colspan="2" class="sec">Einsatzdetails</td></tr>
    <tr>
        <td class="lbl" style="width:28%;border:0.5pt solid #ccc">Einsatzort</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'einsatzort') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Schaden / Bemerkung</td>
        <td class="val" style="border:0.5pt solid #ccc;min-height:18px"><?= PdfFieldOutput::textMultiline((string)($dfData['schaden_beschreibung'] ?? '')) ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Sonstiges</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'sonstiges_bemerkung') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Einsatzbeginn</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'einsatz_beginn_formatiert') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Einsatzende</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'einsatz_ende_formatiert') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Fahrer</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrer_name') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Einsatzfahrzeug</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'einsatz_fahrzeug_bezeichnung') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Miet- / Ersatzfahrzeug</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'miet_ersatzfahrzeug') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Weitertransport</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'weitertransport_ziel') ?></td>
    </tr>
    <tr>
        <td class="lbl" style="border:0.5pt solid #ccc">Sammler</td>
        <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'sammler') ?></td>
    </tr>
</table>

<!-- Standgeld & Auftragsart -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr>
    <td class="lbl" style="width:28%;border:0.5pt solid #ccc">Standgeld</td>
    <td class="val" style="width:22%;border:0.5pt solid #ccc"><?= dfVal($dfData, 'standgeld_betrag_euro') ?><?= !empty($dfData['standgeld_betrag_euro']) ? ' &euro; zzgl. MwSt.' : '' ?></td>
    <td class="lbl" style="width:24%;border:0.5pt solid #ccc">Auftragsart</td>
    <td class="val cb-row" style="border:0.5pt solid #ccc">
        <?php foreach (AbschleppFieldLabels::einsatzTyp() as $dfV => $dfL): ?>
            <span class="cb-item"><span class="cb-box"><?= dfCb(in_array($dfV, $dfEinsatzTypen)) ?></span> <?= $dfL ?></span>
        <?php endforeach; ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Hingewiesen am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'standgeld_hingewiesen_am') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Hingewiesen per</td>
    <td class="val cb-row" style="border:0.5pt solid #ccc">
        <?php foreach (AbschleppFieldLabels::hinweisPerKanal() as $dfV => $dfL): ?>
            <span class="cb-item"><span class="cb-box"><?= dfCb(in_array($dfV, $dfHinweisKanaele)) ?></span> <?= $dfL ?></span>
        <?php endforeach; ?>
    </td>
</tr>
</table>

<!-- Zusatzleistungen -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Zusatzleistungen</td></tr>
<?php foreach (array_chunk(AbschleppFieldLabels::zusatzleistungen(), 2, true) as $dfRow): ?>
<tr>
    <?php foreach ($dfRow as $dfZKey => $dfZLabel): ?>
        <td style="width:50%;border:0.5pt solid #ccc;padding:3px 5px" class="cb-row">
            <span class="cb-box"><?= dfCb(in_array($dfZKey, $dfZusatzleistungen)) ?></span> <?= $dfZLabel ?>
        </td>
    <?php endforeach; ?>
    <?php if (count($dfRow) < 2): ?><td style="border:0.5pt solid #ccc"></td><?php endif; ?>
</tr>
<?php endforeach; ?>
<?php if (!empty($dfData['bergung_stunden_anzahl'])): ?>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Bergung (Stunden)</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'bergung_stunden_anzahl') ?></td>
</tr>
<?php endif; ?>
</table>

<!-- Legal -->
<div class="legal">
    Wir m&ouml;chten Sie darauf hinweisen, dass f&uuml;r Ihr abgestelltes Fahrzeug Standgeld verrechnet wird. Wir bitten Sie in Ihrem eigenen Interesse, lange Standzeiten zu vermeiden.
    Die Herausgabe des Fahrzeugs kann nur an den Eigent&uuml;mer oder eine durch Vollmacht berechtigte Person erfolgen. Alle angefallenen Kosten m&uuml;ssen bei Abholung beglichen werden.
    Der Unterzeichnende erteilt den Auftrag f&uuml;r Abschlepp- &amp; Bergungsarbeiten, f&uuml;r alle anfallenden Reinigungsarbeiten und f&uuml;r das Hinterstellen des Fahrzeugs.
    Er best&auml;tigt ausdr&uuml;cklich, dass er zur Erteilung des Auftrages berechtigt ist. Die allgemeinen Gesch&auml;ftsbedingungen werden anerkannt.
    Informationen zu AGBs und Datenschutz: <strong>www.vorleitner.de/impressum</strong> &amp; <strong>www.vorleitner.de/datenschutz</strong>
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

<!-- ═══════════════════ SEITE 2 ═══════════════════ -->
<div class="page-break-before">

<!-- Seite 2 Mini-Header -->
<table style="margin-bottom:8px;border-bottom:1.5pt solid #D92B1A;padding-bottom:7px">
<tr>
    <td style="border:none;background:none;padding:0;vertical-align:middle;width:40%">
        <?php if (file_exists($dfLogoPath)): ?>
            <img src="<?= $dfLogoPath ?>" height="26" alt="Vorleitner">
        <?php endif; ?>
    </td>
    <td style="border:none;background:none;padding:0;text-align:right;vertical-align:middle">
        <span style="font-size:9pt;font-weight:bold;color:#D92B1A">Auftragskarte Abschleppdienst</span>
        <span style="font-size:7.5pt;color:#777"> | Versicherung &amp; Sicherstellung</span>
        <br><span style="font-size:7pt;color:#aaa"><?= esc_html(trim(dfVal($dfData, 'kunde_nachname') . ', ' . dfVal($dfData, 'kunde_vorname'))) ?> | <?= dfVal($dfData, 'kennzeichen') ?></span>
    </td>
</tr>
</table>

<!-- Versicherung -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Versicherung</td></tr>
<tr>
    <td class="lbl" style="width:30%;border:0.5pt solid #ccc">Fahrzeug versichert bei</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeug_versichert_bei') ?></td>
    <td class="lbl" style="width:30%;border:0.5pt solid #ccc">Schadennummer</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'versicherung_schaden_nummer') ?></td>
</tr>
</table>

<!-- Sicherstellung & Abholung -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Sicherstellung &amp; Abholung</td></tr>
<tr>
    <td class="lbl" style="width:30%;border:0.5pt solid #ccc">Fahrzeug abgeholt am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeug_abgeholt_am') ?></td>
    <td class="lbl" style="width:26%;border:0.5pt solid #ccc">Fahrzeug abgeholt durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeug_abgeholt_durch') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Kennzeichen abgeholt am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kennzeichen_abgeholt_am') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Kennzeichen abgeholt durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'kennzeichen_abgeholt_durch') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Inhalt entnommen am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeuginhalt_entnommen_am') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Inhalt entnommen durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'fahrzeuginhalt_entnommen_durch') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Gegenst&auml;nde</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:18px"><?= dfVal($dfData, 'fahrzeuginhalt_gegenstaende') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Sichergestellt am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'sichergestellt_am') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Sichergestellt durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'sichergestellt_durch') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Freigabe am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'freigabe_am') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Freigabe durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'freigabe_durch') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Besichtigt am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'besichtigt_am') ?></td>
    <td class="lbl" style="border:0.5pt solid #ccc">Besichtigt durch</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData, 'besichtigt_durch') ?></td>
</tr>
</table>

<!-- Notizen -->
<table style="border:0.5pt solid #ccc">
<tr><td class="sec">Notizen</td></tr>
<tr><td style="padding:5px;font-style:italic;color:#333"><?= PdfFieldOutput::textMultiline((string)($dfData['interne_notizen'] ?? '')) ?></td></tr>
</table>

</div>

</body>
</html>
