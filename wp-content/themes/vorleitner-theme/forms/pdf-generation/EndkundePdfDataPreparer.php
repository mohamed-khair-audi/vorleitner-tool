<?php
defined('ABSPATH') || exit;

class EndkundePdfDataPreparer
{
    public function prepare(array $dfFormData): array
    {
        return array_merge($dfFormData, [
            'eingereicht_am_formatiert' => date('d.m.Y H:i') . ' Uhr',
            'rechtstext_plain'          => EndkundeLegalText::plainForPdf(),
            'beauftragte_leistungen_label' => EndkundeFieldLabels::leistungenLabel((array) ($dfFormData['beauftragte_leistungen'] ?? [])),
            'ist_fahrzeugeigentuemer_label' => EndkundeFieldLabels::label('ist_fahrzeugeigentuemer', $dfFormData['ist_fahrzeugeigentuemer'] ?? ''),
            'unfall_oder_panne_label'   => EndkundeFieldLabels::label('unfall_oder_panne', $dfFormData['unfall_oder_panne'] ?? ''),
            'unfall_schuldfrage_label'  => EndkundeFieldLabels::label('unfall_schuldfrage', $dfFormData['unfall_schuldfrage'] ?? ''),
            'werkstattleistung_option_label' => EndkundeFieldLabels::label('werkstattleistung_option', $dfFormData['werkstattleistung_option'] ?? ''),
            'ersatzfahrzeug_gewuenscht_label' => EndkundeFieldLabels::label('ersatzfahrzeug_gewuenscht', $dfFormData['ersatzfahrzeug_gewuenscht'] ?? ''),
            'auto_selbst_abholung_label' => EndkundeFieldLabels::label('auto_selbst_abholung', $dfFormData['auto_selbst_abholung'] ?? ''),
            'abholer_vollmacht_label'   => ($dfFormData['abholer_vollmacht'] ?? '') === '1' ? 'Ja, Vollmacht erteilt' : '',
            'sammeltransport_geplant_label' => EndkundeFieldLabels::label('sammeltransport_geplant', $dfFormData['sammeltransport_geplant'] ?? ''),
            'wertgegenstaende_im_fzg_label' => EndkundeFieldLabels::label('wertgegenstaende_im_fzg', $dfFormData['wertgegenstaende_im_fzg'] ?? ''),
            'agb_akzeptiert_label'      => ($dfFormData['agb_akzeptiert'] ?? '') === '1' ? 'Ja, gelesen und akzeptiert' : 'Nein',
        ]);
    }
}
