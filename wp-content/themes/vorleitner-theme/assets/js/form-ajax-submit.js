class FormAjaxSubmit {
    constructor(dfFormSelector, dfFormType, dfSignaturePadInstance, dfNavigationInstance, dfPersistenceInstance, dfPdfActionsInstance) {
        this.dfForm        = document.querySelector(dfFormSelector);
        this.dfFormType    = dfFormType;
        this.dfSignPad     = dfSignaturePadInstance;
        this.dfNavigation  = dfNavigationInstance;
        this.dfPersistence = dfPersistenceInstance;
        this.dfPdfActions  = dfPdfActionsInstance;
    }

    init() {
        if (!this.dfForm) return;
        this.dfForm.addEventListener('submit', (dfEvent) => {
            dfEvent.preventDefault();
            this.submitFormData();
        });
    }

    collectFields() {
        const dfData = {};
        this.dfForm.querySelectorAll('input, textarea, select').forEach((dfInput) => {
            if (!dfInput.name) return;
            if (dfInput.type === 'checkbox') {
                if (!Array.isArray(dfData[dfInput.name])) dfData[dfInput.name] = [];
                if (dfInput.checked) dfData[dfInput.name].push(dfInput.value);
            } else if (dfInput.type === 'radio') {
                if (dfInput.checked) dfData[dfInput.name] = dfInput.value;
            } else {
                dfData[dfInput.name] = dfInput.value;
            }
        });

        if (this.dfSignPad) this.dfSignPad.updateHiddenInput();
        dfData['unterschrift_base64'] = this.dfForm.querySelector('#unterschrift_base64')?.value || '';
        return dfData;
    }

    async submitFormData() {
        const dfButton  = this.dfForm.querySelector('.btn-submit');
        const dfSuccess = this.dfForm.querySelector('.form-success-message');
        const dfData    = this.collectFields();

        dfButton.disabled    = true;
        dfButton.textContent = 'Wird gesendet…';

        try {
            const dfResponse = await fetch(vorleitnerFormConfig.restUrl + this.dfFormType, {
                method:  'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce':   vorleitnerFormConfig.nonce,
                },
                body: JSON.stringify(dfData),
            });

            const dfResult = await dfResponse.json();

            if (dfResult.success) {
                if (this.dfPersistence) this.dfPersistence.clear();
                this.dfForm.querySelectorAll('.form-step').forEach(dfStep => dfStep.style.display = 'none');
                if (dfSuccess) dfSuccess.style.display = 'block';
                if (this.dfPdfActions && dfResult.post_id && dfResult.pdf_token) {
                    this.dfPdfActions.activate(dfResult.post_id, dfResult.pdf_token);
                }
                return;
            }

            if (dfResult.errors && this.dfNavigation) {
                this.dfNavigation.markBackendErrors(dfResult.errors);
            }

            throw new Error(dfResult.message || dfResult.error || 'Unbekannter Fehler beim Senden');

        } catch (dfError) {
            alert('Fehler: ' + dfError.message + '\nBitte prüfen Sie Ihre Eingaben und versuchen Sie es erneut.');
            dfButton.disabled    = false;
            dfButton.textContent = 'Auftrag absenden';
        }
    }
}
