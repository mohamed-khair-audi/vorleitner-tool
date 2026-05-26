<div class="step-header">
    <h2>Unfall oder Panne</h2>
    <p class="step-subtitle">Schuldfrage bei Unfall und Schadenbeschreibung</p>
</div>

<?php
$dfPartialDir = get_template_directory() . '/templates/form-steps/endkunde/_partials/';
include $dfPartialDir . 'unfall-panne-fields.php';
include $dfPartialDir . 'schadenbeschreibung-fields.php';
?>
