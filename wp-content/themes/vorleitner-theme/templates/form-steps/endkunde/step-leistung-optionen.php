<div class="step-header">
    <h2>Werkstattleistung &amp; Optionen</h2>
    <p class="step-subtitle">Reparatur, Diagnose, Ersatzfahrzeug und weitere Angaben</p>
</div>

<?php
$dfPartialDir = get_template_directory() . '/templates/form-steps/endkunde/_partials/';
include $dfPartialDir . 'werkstattleistung-fields.php';
include $dfPartialDir . 'zusatzoptionen-fields.php';
?>
