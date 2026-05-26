<?php
defined('ABSPATH') || exit;

class AuftragPostFactory
{
    public function createAbschleppPost(array $dfData): int
    {
        $dfPostTitle = sprintf(
            'Abschleppen – %s – %s',
            $dfData['kennzeichen'] ?? 'kein Kennzeichen',
            date('d.m.Y H:i')
        );

        $dfPostId = $this->savePodsPost($dfPostTitle, $dfData);

        wp_set_object_terms($dfPostId, AuftragConstants::TAXONOMY_TERM_ABSCHLEPPEN, AuftragConstants::TAXONOMY_SLUG);

        return $dfPostId;
    }

    public function createWerkstattPost(array $dfData): int
    {
        $dfPostTitle = sprintf(
            'Werkstatt – %s, %s – %s',
            $dfData['kunde_nachname'] ?? '',
            $dfData['fahrzeug_typ_modell'] ?? '',
            date('d.m.Y H:i')
        );

        $dfPostId = $this->savePodsPost($dfPostTitle, $dfData);

        wp_set_object_terms($dfPostId, AuftragConstants::TAXONOMY_TERM_WERKSTATT, AuftragConstants::TAXONOMY_SLUG);

        return $dfPostId;
    }

    public function createEndkundePost(array $dfData): int
    {
        $dfPostTitle = sprintf(
            'Kundenanfrage – %s – %s – %s',
            $dfData['kennzeichen'] ?? 'kein Kennzeichen',
            trim(($dfData['kunde_nachname'] ?? '') . ' ' . ($dfData['kunde_vorname'] ?? '')),
            date('d.m.Y H:i')
        );

        $dfPostId = $this->savePodsPost($dfPostTitle, $dfData);

        wp_set_object_terms($dfPostId, AuftragConstants::TAXONOMY_TERM_ENDKUNDE, AuftragConstants::TAXONOMY_SLUG);

        return $dfPostId;
    }

    private function savePodsPost(string $dfPostTitle, array $dfData): int
    {
        $dfFieldValues = array_merge(['post_title' => $dfPostTitle, 'post_status' => 'publish'], $dfData);
        $dfPostId      = pods(AuftragConstants::POST_TYPE_SLUG)->save($dfFieldValues);

        if (!$dfPostId) {
            throw new \RuntimeException('Pods: Auftrag konnte nicht gespeichert werden.');
        }

        return (int) $dfPostId;
    }
}
