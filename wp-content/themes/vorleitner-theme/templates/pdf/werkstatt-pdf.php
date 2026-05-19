<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: dejavusans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; line-height: 1.4; }

/* ── Tabellen & Felder (identisch mit Abschleppen-PDF) ── */
table          { border-collapse: collapse; width: 100%; }
td             { padding: 5px 7px; vertical-align: top; }
td.lbl         { background: #f0f0f0; font-weight: bold; font-size: 8.5pt; color: #333; white-space: nowrap; }
td.val         { background: #fff; font-size: 9.5pt; min-height: 18px; }

/* ── Sektions-Titel (roter Balken, wie Abschleppen-PDF) ── */
.sec           { background: #D92B1A; color: #fff; font-weight: bold; font-size: 9pt;
                 padding: 5px 8px; letter-spacing: 0.4px; }

/* ── Header ── */
.hdr-main      { font-size: 20pt; font-weight: bold; color: #D92B1A; line-height: 1.15; text-align: right; }
.hdr-sub       { font-size: 12pt; font-weight: bold; color: #D92B1A; text-align: right; margin-top: 3px; }
.doc-header    { width: 100%; margin-bottom: 10px; border-bottom: 2pt solid #D92B1A; padding-bottom: 10px; }
.doc-header td { border: none; background: none; padding: 0; vertical-align: middle; }

/* ── Checkboxen ── */
.cb-row  { font-size: 9pt; line-height: 2; }
.cb-item { display: inline; margin-right: 14px; white-space: nowrap; }
.cb-box  { font-size: 12pt; }

/* ── Checkliste (2-Spalten-Block) ── */
.cl-td   { padding: 4px 8px; font-size: 8.5pt; line-height: 1.4; }
.cl-line { border-bottom: 0.5pt solid #aaa; min-height: 16px; font-size: 9.5pt;
           padding: 1px 0; margin: 3px 0 2px 20px; }
.ek-head { font-weight: bold; font-size: 8.5pt; color: #fff; background: #555;
           padding: 4px 8px; }

/* ── Rechtstext ── */
.legal   { font-size: 7.5pt; color: #555; line-height: 1.5; border: 0.5pt solid #ccc;
           padding: 6px 8px; background: #fafafa; margin: 7px 0; }

/* ── Unterschrift ── */
.sig-box     { border: 0.5pt dashed #aaa; height: 60px; background: #fafafa; }
.sig-box img { max-height: 58px; max-width: 100%; display: block; }

/* ── Footer-Logos ── */
.logo-row td { text-align: center; vertical-align: middle; font-size: 6.5pt; font-weight: bold;
               color: #555; border: 0.5pt solid #ccc; padding: 3px 5px; background: #f7f7f7; }

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
        <div class="hdr-sub">Werkstatt</div>
    </td>
</tr>
</table>

<!-- 2. KUNDENDATEN | FAHRZEUGDATEN (2 Spalten nebeneinander) -->
<table style="margin-bottom:8px">
<tr>

    <!-- ── Kundendaten ── -->
    <td style="width:49%;vertical-align:top;padding:0;border:none">
        <table style="width:100%;border:0.5pt solid #ccc">
            <tr><td colspan="2" class="sec">Kundendaten</td></tr>
            <tr>
                <td class="lbl" style="width:40%;border:0.5pt solid #ccc">Name, Vorname</td>
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
            <!-- Telefon | E-Mail nebeneinander -->
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Telefon</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kunde_telefon') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">E-Mail</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kunde_email') ?></td>
            </tr>
        </table>
    </td>

    <td style="width:4px;border:none;padding:0"></td>

    <!-- ── Fahrzeugdaten ── -->
    <td style="width:49%;vertical-align:top;padding:0;border:none">
        <table style="width:100%;border:0.5pt solid #ccc">
            <tr><td colspan="2" class="sec">Fahrzeugdaten</td></tr>
            <tr>
                <td class="lbl" style="width:42%;border:0.5pt solid #ccc">Typ / Modell</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrzeug_typ_modell') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Motor-Nr.</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'motor_nummer') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Amtl. Kennzeichen</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kennzeichen') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">KM-Stand</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'km_stand') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Fahrzeug-Ident-Nr.</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'fahrzeug_ident_nummer') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Annahmetermin</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'annahmetermin_formatiert') ?></td>
            </tr>
            <tr>
                <td class="lbl" style="border:0.5pt solid #ccc">Abholtermin</td>
                <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'abholtermin_werkstatt_formatiert') ?></td>
            </tr>
        </table>
    </td>

</tr>
</table>

<!-- 3. MIETFAHRZEUG / WERKSTATTERSATZFAHRZEUG / CLUBMOBIL -->
<?php $dfErsatz = $dfData['ersatzfahrzeug_typ'] ?? ''; ?>
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Mietfahrzeug / Werkstattersatzfahrzeug / Clubmobil</td></tr>
<tr>
    <!-- Werkstattersatzfahrzeug + Freitextzeile -->
    <td class="val" style="width:26%;border:0.5pt solid #ccc;white-space:nowrap;font-size:8.5pt">
        <span class="cb-box"><?= dfCb($dfErsatz === 'werkstattersatzfahrzeug') ?></span>
        Werkstattersatzfahrzeug
    </td>
    <td class="val" style="border:0.5pt solid #ccc;font-size:8.5pt">
        <?= $dfErsatz === 'werkstattersatzfahrzeug' ? dfVal($dfData,'ersatzfahrzeug_info') : '' ?>&nbsp;
    </td>
    <!-- Clubmobil + Freitextzeile -->
    <td class="val" style="width:14%;border:0.5pt solid #ccc;white-space:nowrap;font-size:8.5pt">
        <span class="cb-box"><?= dfCb($dfErsatz === 'clubmobil') ?></span>
        Clubmobil
    </td>
    <td class="val" style="border:0.5pt solid #ccc;font-size:8.5pt">
        <?= $dfErsatz === 'clubmobil' ? dfVal($dfData,'ersatzfahrzeug_info') : '' ?>&nbsp;
    </td>
</tr>
</table>

<!-- 4. KUNDENBERATER + MONTEUR -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr>
    <td class="lbl" style="width:24%;border:0.5pt solid #ccc">Kundenberater</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'kundenberater_name') ?></td>
    <td class="lbl" style="width:28%;border:0.5pt solid #ccc">Zust&auml;ndiger Monteur</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'zustaendiger_monteur_name') ?></td>
</tr>
</table>

<!-- 5. ERSATZTEILE- & LEISTUNGSNACHWEIS -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc">
<tr><td colspan="4" class="sec">Ersatzteile- &amp; Leistungsnachweis</td></tr>
<tr>
    <td class="lbl" style="width:28%;border:0.5pt solid #ccc">Kundenbeanstandung</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:20px">
        <?= PdfFieldOutput::textMultiline((string)($dfData['kundenbeanstandung'] ?? '')) ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Kostenangebot</td>
    <td class="val" style="border:0.5pt solid #ccc;width:22%">
        <?= dfVal($dfData,'kostenangebot_euro') ?><?= !empty($dfData['kostenangebot_euro']) ? '&thinsp;&euro;' : '' ?>
    </td>
    <td class="lbl" style="border:0.5pt solid #ccc;width:22%">Arbeitszeit</td>
    <td class="val" style="border:0.5pt solid #ccc">
        <?= dfVal($dfData,'arbeitszeit_stunden') ?><?= !empty($dfData['arbeitszeit_stunden']) ? '&thinsp;Std.' : '' ?>
    </td>
</tr>
<tr>
    <td class="lbl" style="border:0.5pt solid #ccc">Arbeitsgang / Ersatzteile</td>
    <td class="val" colspan="3" style="border:0.5pt solid #ccc;min-height:52px">
        <?= PdfFieldOutput::textMultiline((string)($dfData['arbeitsgang_und_ersatzteile'] ?? '')) ?>
    </td>
</tr>
</table>

<!-- 6. ENDKONTROLLE / CHECKLISTE (2 Spalten) -->
<?php
$dfCl = fn(string $k): bool => ($dfData[$k] ?? '0') === '1';
$dfAbholbereit = $dfCl('endkontrolle_fahrzeug_abholbereit');
$dfMin = dfVal($dfData,'probefahrt_minuten');
$dfOelKorr = dfVal($dfData,'motoroel_korrigiert_liter');
$dfKuehlKorr = dfVal($dfData,'kuehlmittel_korrigiert_liter');
$dfFrost = dfVal($dfData,'frostschutz_temperatur_grad');
?>
<table style="margin-bottom:0;border:0.5pt solid #ccc">
<tr><td colspan="2" class="sec">Endkontrolle / Checkliste</td></tr>
<tr>

    <!-- ── LINKE SPALTE ── -->
    <td style="width:50%;vertical-align:top;border-right:0.5pt solid #ccc;padding:0">
    <table style="width:100%;border-collapse:collapse">

        <tr><td class="cl-td">
            <span class="cb-box"><?= dfCb($dfCl('probefahrt_durchgefuehrt')) ?></span>
            Probefahrt durchgef&uuml;hrt<?= $dfMin !== '' ? ' &mdash; ' . $dfMin . '&thinsp;min.' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('motorraum_verschluesse_zu')) ?></span>
            Alle Verschl&uuml;sse und Deckel im Motorraum zu?
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('fahrzeug_abholfertig_hergerichtet')) ?></span>
            Fzg. abholfertig hergerichtet
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('abschlepphaken_entfernt')) ?></span>
            Abschlepphaken entfernt
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('lack_spuren_entfernt')) ?></span>
            Alle Spuren, Fingerabdr&uuml;cke auf Lack entfernt
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('beleuchtung_ok')) ?></span>
            Beleuchtung ok?
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('serviceheft_eintrag_gemacht')) ?></span>
            Servicehefteintrag?
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('service_intervall_zurueckgestellt')) ?></span>
            Service zur&uuml;ckgestellt?
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd;color:#555">
            Radschrauben/Muttern angezogen durch:
            <?php $dfRs = dfVal($dfData,'radschrauben_angezogen_durch'); ?>
            <?= $dfRs !== '' ? '<strong style="color:#1a1a1a"> ' . $dfRs . '</strong>' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd;color:#555">
            &Ouml;lablassschraube nachgezogen durch:
            <?php $dfOl = dfVal($dfData,'oelablassschraube_nachgezogen_durch'); ?>
            <?= $dfOl !== '' ? '<strong style="color:#1a1a1a"> ' . $dfOl . '</strong>' : '' ?>
        </td></tr>

    </table>
    </td>

    <!-- ── RECHTE SPALTE ── -->
    <td style="width:50%;vertical-align:top;padding:0">
    <table style="width:100%;border-collapse:collapse">

        <tr><td class="cl-td">
            <span class="cb-box"><?= dfCb($dfCl('fahrzeug_gereinigt_innen_aussen')) ?></span>
            Fzg. gereinigt innen + au&szlig;en
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb(!$dfCl('motoroel_stand_ok')) ?></span>
            Motor&ouml;lstand ok?<?= !$dfCl('motoroel_stand_ok') && $dfOelKorr !== '' ? ' &mdash; Korrigiert: ' . $dfOelKorr . '&thinsp;L' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd;color:#555">
            Motor&ouml;l-Spezifikation:
            <?php $dfOs = dfVal($dfData,'motoroel_spezifikation'); ?>
            <?= !$dfCl('motoroel_stand_ok') && $dfOs !== '' ? '<strong style="color:#1a1a1a"> ' . $dfOs . '</strong>' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb(!$dfCl('kuehlmittel_ok')) ?></span>
            K&uuml;hlmittel ok?<?= !$dfCl('kuehlmittel_ok') && $dfKuehlKorr !== '' ? ' &mdash; Korrigiert: ' . $dfKuehlKorr . '&thinsp;L' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb(!$dfCl('frostschutz_ok')) ?></span>
            Frostschutz ok?<?= !$dfCl('frostschutz_ok') && $dfFrost !== '' ? ' &mdash; ' . $dfFrost . '&thinsp;&deg;C' : '' ?>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfCl('endkontrolle_durchgefuehrt')) ?></span>
            Endkontrolle durchgef&uuml;hrt
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb($dfAbholbereit) ?></span>
            <strong>Fzg. abholbereit</strong>
        </td></tr>

        <tr><td class="cl-td" style="border-top:0.5pt solid #ddd">
            <span class="cb-box"><?= dfCb(!$dfAbholbereit) ?></span>
            Fzg. nicht abholbereit, darf nicht bewegt werden
        </td></tr>

    </table>
    </td>
</tr>
</table>

<!-- Nächste HU -->
<table style="margin-bottom:8px;border:0.5pt solid #ccc;border-top:none">
<tr>
    <td class="lbl" style="width:28%;border:0.5pt solid #ccc">N&auml;chste HU</td>
    <td class="val" style="border:0.5pt solid #ccc"><?= dfVal($dfData,'naechste_hu_formatiert') ?></td>
</tr>
</table>

<!-- 7. RECHTSTEXT -->
<div class="legal">
    Sehr geehrter Kunde, mit der Unterschrift best&auml;tigen Sie als Kunde, dass Sie uns als Reparaturwerkstatt beauftragen, um an Ihrem KFZ den Befund festzulegen,
    die ben&ouml;tigten Ersatzteile zu bestellen und einzubauen, und die Reparatur durchzuf&uuml;hren.
    Die Fehlersuche und Schadensfeststellung ist kostenpflichtig. Falls Ihr Fahrzeug nicht bis zur vollen Fahrt&uuml;chtigkeit repariert wird, fallen ab dem f&uuml;nften Tag
    des Abstellens Standgeb&uuml;hren an. Ihr Fahrzeug kann erst herausgegeben werden, wenn alle Kosten beglichen wurden.
    Sie best&auml;tigen, dass Sie unsere AGBs und Datenschutzbestimmungen gelesen haben und diese anerkennen.
    <strong>www.vorleitner.de/impressum</strong> &amp; <strong>www.vorleitner.de/datenschutz</strong>
</div>

<!-- 8. UNTERSCHRIFT -->
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

<!-- 9. NOTIZEN (direkt unter Unterschrift) -->
<div style="margin-top:10px;font-weight:bold;font-size:9pt;margin-bottom:4px">Notizen:</div>
<?php if (!empty(trim($dfData['werkstatt_notizen'] ?? ''))): ?>
<div style="font-size:9pt;color:#1a1a1a;line-height:1.7;padding:0 2px;margin-bottom:4px">
    <?= PdfFieldOutput::textMultiline((string) $dfData['werkstatt_notizen']) ?>
</div>
<?php endif; ?>
<?php for ($dfI = 0; $dfI < 6; $dfI++): ?>
<div class="note-line"></div>
<?php endfor; ?>

</body>
</html>
