<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: dejavusans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; line-height: 1.4; }
table { border-collapse: collapse; width: 100%; }
td { padding: 5px 7px; vertical-align: top; }
td.lbl { background: #f0f0f0; font-weight: bold; font-size: 8.5pt; color: #333; white-space: nowrap; }
td.val { background: #fff; font-size: 9.5pt; min-height: 18px; }
.sec { background: #D92B1A; color: #fff; font-weight: bold; font-size: 9pt; padding: 5px 8px; letter-spacing: 0.4px; }
.hdr-main { font-size: 20pt; font-weight: bold; color: #D92B1A; line-height: 1.15; text-align: right; }
.hdr-sub { font-size: 12pt; font-weight: bold; color: #D92B1A; text-align: right; margin-top: 3px; }
.doc-header { width: 100%; margin-bottom: 10px; border-bottom: 2pt solid #D92B1A; padding-bottom: 10px; }
.doc-header td { border: none; background: none; padding: 0; vertical-align: middle; }
.legal { font-size: 7.5pt; color: #555; line-height: 1.5; border: 0.5pt solid #ccc; padding: 6px 8px; background: #fafafa; margin: 7px 0; }
.sig-box { border: 0.5pt solid #ccc; height: 32mm; min-height: 32mm; background: #fafafa; text-align: center; vertical-align: middle; padding: 4mm 6mm; }
.sig-box img { max-height: 28mm; height: 28mm; width: auto; max-width: 100%; display: block; margin: 0 auto; object-fit: contain; }
.text-block { font-size: 9pt; line-height: 1.6; padding: 6px 8px; border: 0.5pt solid #ccc; background: #fff; min-height: 40px; }
</style>
</head>
<body>

<?php
$dfLogoPath = get_template_directory() . '/assets/imgs/logo_vorleitner.png';

function ekVal(array $dfData, string $dfKey, string $dfDefault = ''): string {
    return PdfFieldOutput::text((string) ($dfData[$dfKey] ?? $dfDefault));
}
?>

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
        <div class="hdr-main">Kundenauftrag</div>
        <div class="hdr-sub">Abschleppen, Werkstatt &amp; Service</div>
    </td>
</tr>
</table>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Kundendaten / Auftraggeber</td></tr>
<tr>
    <td class="lbl" style="width:32%;border:0.5pt solid #ccc">Name, Vorname</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'kunde_nachname') ?>, <?= ekVal($dfData,'kunde_vorname') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Stra&szlig;e / Nr.</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'kunde_strasse') ?> <?= ekVal($dfData,'kunde_hausnummer') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">PLZ / Wohnort</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'kunde_plz') ?> <?= ekVal($dfData,'kunde_ort') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Telefonnummer (Handy)</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'kunde_telefon') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">E-Mail</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'kunde_email') ?></td>
</tr>
</table>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Fahrzeugeigent&uuml;mer</td></tr>
<tr>
    <td class="lbl" style="width:32%;border:0.5pt solid #ccc">Ich bin der Fahrzeugeigent&uuml;mer</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'ist_fahrzeugeigentuemer_label') ?></td>
</tr>
<?php if (($dfData['ist_fahrzeugeigentuemer'] ?? '') === 'nein'): ?>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Eigent&uuml;mer Name</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'eigentuemer_name') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Adresse</td>
    <td class="val" style="border:0.5pt solid #ccc">
        <?= ekVal($dfData,'eigentuemer_strasse') ?> <?= ekVal($dfData,'eigentuemer_hausnummer') ?>,
        <?= ekVal($dfData,'eigentuemer_plz') ?> <?= ekVal($dfData,'eigentuemer_ort') ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Telefon / E-Mail</td>
    <td class="val" style="border:0.5pt solid #ccc">
        <?= ekVal($dfData,'eigentuemer_telefon') ?> &mdash; <?= ekVal($dfData,'eigentuemer_email') ?>
    </td>
</tr>
<?php endif; ?>
</table>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Fahrzeugdaten</td></tr>
<tr>
    <td class="lbl" style="width:32%;border:0.5pt solid #ccc">Hersteller / Typ</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'fahrzeug_hersteller') ?> &mdash; <?= ekVal($dfData,'fahrzeug_typ') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Kennzeichen</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'kennzeichen') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">KM-Stand (ca.)</td>
    <td class="val" style="border:0.5pt solid #ccc"><?php
        $dfKm = $dfData['km_stand'] ?? '';
        echo ($dfKm !== '' && is_numeric($dfKm))
            ? number_format((int)$dfKm, 0, ',', '.') . ' km'
            : PdfFieldOutput::text((string)$dfKm);
    ?></td>
</tr>
</table>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Unfall / Panne</td></tr>
<tr>
    <td class="lbl" style="width:32%;border:0.5pt solid #ccc">Art</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'unfall_oder_panne_label') ?></td>
</tr>
<?php if (($dfData['unfall_oder_panne'] ?? '') === 'unfall'): ?>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Schuldfrage</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'unfall_schuldfrage_label') ?></td>
</tr>
<?php endif; ?>
</table>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td class="sec">Schadenbeschreibung</td></tr>
<tr><td class="text-block"><?= PdfFieldOutput::textMultiline((string)($dfData['schaden_beschreibung'] ?? '')) ?></td></tr>
</table>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Beauftragte Leistungen</td></tr>
<tr>
    <td class="val" colspan="2" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'beauftragte_leistungen_label') ?></td>
</tr>
</table>

<?php if (!empty($dfData['werkstattleistung_option_label'])): ?>
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Werkstattauftrag – Umfang</td></tr>
<tr>
    <td class="val" colspan="2" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'werkstattleistung_option_label') ?></td>
</tr>
</table>
<?php endif; ?>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Zusatzoptionen</td></tr>
<tr>
    <td class="lbl" style="width:42%;border:0.5pt solid #ccc">Ersatzfahrzeug / Mietfahrzeug</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'ersatzfahrzeug_gewuenscht_label') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Ich hole das Fahrzeug selbst ab</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'auto_selbst_abholung_label') ?></td>
</tr>
<?php if (($dfData['auto_selbst_abholung'] ?? '') === 'nein'): ?>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Abholer Name</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'abholer_name') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Abholer Adresse</td>
    <td class="val" style="border:0.5pt solid #ccc">
        <?= ekVal($dfData,'abholer_strasse') ?> <?= ekVal($dfData,'abholer_hausnummer') ?>,
        <?= ekVal($dfData,'abholer_plz') ?> <?= ekVal($dfData,'abholer_ort') ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Abholer Telefon</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'abholer_telefon') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Abholervollmacht</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'abholer_vollmacht_label') ?></td>
</tr>
<?php endif; ?>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Sammeltransport ADAC / andere Versicherung</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'sammeltransport_geplant_label') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Wertgegenst&auml;nde im Fahrzeug</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'wertgegenstaende_im_fzg_label') ?></td>
</tr>
<?php if (($dfData['wertgegenstaende_im_fzg'] ?? '') === 'ja'): ?>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Welche Gegenst&auml;nde</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= PdfFieldOutput::textMultiline((string)($dfData['wertgegenstaende_beschreibung'] ?? '')) ?></td>
</tr>
<?php endif; ?>
</table>

<?php if (!empty(trim($dfData['sonstige_anmerkungen'] ?? ''))): ?>
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td class="sec">Sonstige Anmerkungen</td></tr>
<tr><td class="text-block"><?= PdfFieldOutput::textMultiline((string) $dfData['sonstige_anmerkungen']) ?></td></tr>
</table>
<?php endif; ?>

<div class="legal">
    <?= nl2br(PdfFieldOutput::text((string)($dfData['rechtstext_plain'] ?? ''))) ?>
</div>

<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr>
    <td class="lbl" style="width:32%;border:0.5pt solid #ccc">Zustimmung AGB / Datenschutz</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'agb_akzeptiert_label') ?></td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Eingereicht am</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= ekVal($dfData,'eingereicht_am_formatiert') ?></td>
</tr>
</table>

<table style="margin-bottom:4px;border:0.5pt solid #ccc;width:100%">
<tr><td colspan="2" class="sec">Digitale Unterschrift des Kunden</td></tr>
<tr>
    <td class="sig-box" colspan="2" style="border:0.5pt solid #ccc;text-align:center">
        <?php if (!empty($dfData['unterschrift_base64'])): ?>
            <img src="<?= $dfData['unterschrift_base64'] ?>" alt="Unterschrift" style="max-height:28mm;height:28mm;width:auto;max-width:170mm">
        <?php endif; ?>
    </td>
</tr>
</table>


<div style="margin-top:14px;border-top:1pt solid #D92B1A;padding-top:6px;font-size:7pt;color:#555;line-height:1.5;text-align:center">
    <strong style="color:#1a1a1a">Helmut&nbsp;Vorleitner&nbsp;e.K.</strong> &nbsp;&bull;&nbsp;
    Otterloherstr.&nbsp;10,&nbsp;85649&nbsp;Brunnthal &nbsp;&bull;&nbsp;
    Tel.:&nbsp;08102&nbsp;7885-0 &nbsp;&bull;&nbsp;
    info@vorleitner.de &nbsp;&bull;&nbsp;
    www.vorleitner.de &nbsp;&bull;&nbsp;
    HRA&nbsp;84969 &nbsp;&bull;&nbsp;
    Ust.-IdNr.:&nbsp;DE316657917
</div>

</body>
</html>
