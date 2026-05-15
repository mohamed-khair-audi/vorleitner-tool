document.addEventListener('DOMContentLoaded', function () {
    const dfForm = document.querySelector('.multi-step-form[data-form-type]');
    if (!dfForm) return;

    const dfFormType  = dfForm.dataset.formType;
    const dfCanvasId  = dfFormType === 'abschleppen' ? 'abschlepp-signature-canvas' : 'werkstatt-signature-canvas';
    const dfStoreKey  = 'vorleitner_form_' + dfFormType;

    const dfPersistence = new FormPersistence('.multi-step-form', dfStoreKey);
    const dfStepsNav    = new FormStepsNavigation('.multi-step-form');
    const dfSignPad     = new SignaturePadIntegration('#' + dfCanvasId, '#unterschrift_base64');
    const dfPdfActions  = new FormPdfActions();
    const dfFormSubmit  = new FormAjaxSubmit('.multi-step-form', dfFormType, dfSignPad, dfStepsNav, dfPersistence, dfPdfActions);
    const dfTestData    = new FormTestData('.multi-step-form', dfFormType);

    dfPersistence.init();
    dfStepsNav.init();
    dfSignPad.init();
    dfFormSubmit.init();
    dfTestData.init();
});
