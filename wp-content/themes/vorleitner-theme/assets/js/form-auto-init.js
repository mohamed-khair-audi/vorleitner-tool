document.addEventListener('DOMContentLoaded', function () {
    const dfForm = document.querySelector('.multi-step-form[data-form-type]');
    if (!dfForm) return;

    const dfFormType  = dfForm.dataset.formType;
    const dfCanvasMap = {
        abschleppen: 'abschlepp-signature-canvas',
        werkstatt:   'werkstatt-signature-canvas',
        endkunde:    'endkunde-signature-canvas',
    };
    const dfCanvasId  = dfCanvasMap[dfFormType] || null;
    const dfIsEndkunde    = dfFormType === 'endkunde';
    const dfStoreKey      = 'vorleitner_form_' + dfFormType;
    const dfPersistence   = dfIsEndkunde
        ? null
        : new FormPersistence('.multi-step-form', dfStoreKey);

    if (dfIsEndkunde) {
        try {
            sessionStorage.removeItem(dfStoreKey);
        } catch (_) {}
    }

    const dfConditional  = new FormConditionalFields('.multi-step-form');
    const dfStepsNav     = new FormStepsNavigation('.multi-step-form', dfConditional);
    const dfSignPad      = dfCanvasId
        ? new SignaturePadIntegration('#' + dfCanvasId, '#unterschrift_base64')
        : null;
    const dfPdfActions   = dfForm.dataset.publicForm === '1' ? null : new FormPdfActions();
    const dfFormSubmit   = new FormAjaxSubmit('.multi-step-form', dfFormType, dfSignPad, dfStepsNav, dfPersistence, dfPdfActions);

    dfConditional.init();
    if (dfPersistence) dfPersistence.init();
    dfStepsNav.init();
    if (dfSignPad) {
        dfSignPad.init();
        window.vorleitnerSignPad = dfSignPad;
    }
    dfFormSubmit.init();

    if (typeof FormTestData !== 'undefined') {
        new FormTestData('.multi-step-form', dfFormType).init();
    }
});
