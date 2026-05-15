class FormStepsNavigation {
    constructor(dfFormSelector) {
        this.dfForm          = document.querySelector(dfFormSelector);
        this.dfSteps         = this.dfForm ? Array.from(this.dfForm.querySelectorAll('.form-step')) : [];
        this.dfProgressSteps = Array.from(document.querySelectorAll('.progress-step'));
        this.dfCurrentIndex  = 0;
    }

    init() {
        if (!this.dfForm) return;
        this.dfForm.addEventListener('click', (dfEvent) => {
            if (dfEvent.target.classList.contains('btn-next') && this.validateCurrentStep()) {
                this.showStep(this.dfCurrentIndex + 1);
            }
            if (dfEvent.target.classList.contains('btn-previous')) {
                this.clearErrors(this.dfSteps[this.dfCurrentIndex]);
                this.showStep(this.dfCurrentIndex - 1);
            }
        });
    }

    showStep(dfIndex) {
        this.dfSteps.forEach((dfStep, dfI) => {
            dfStep.style.display = dfI === dfIndex ? 'block' : 'none';
        });
        this.dfProgressSteps.forEach((dfStep, dfI) => {
            dfStep.classList.toggle('active', dfI === dfIndex);
            dfStep.classList.toggle('completed', dfI < dfIndex);
        });
        this.dfCurrentIndex = dfIndex;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    validateCurrentStep() {
        const dfStep = this.dfSteps[this.dfCurrentIndex];
        this.clearErrors(dfStep);
        let dfValid           = true;
        const dfHandledRadios = new Set();

        dfStep.querySelectorAll('input, textarea, select').forEach((dfInput) => {
            if (!dfInput.name || dfInput.type === 'hidden') return;

            if (dfInput.type === 'radio') {
                if (dfInput.required && !dfHandledRadios.has(dfInput.name) && !dfStep.querySelector(`[name="${dfInput.name}"]:checked`)) {
                    dfHandledRadios.add(dfInput.name);
                    const dfGroup = dfInput.closest('.radio-group') || dfInput.parentElement;
                    this.addError(dfGroup, 'Bitte eine Option auswählen');
                    dfValid = false;
                }
                return;
            }

            if (dfInput.type === 'checkbox') return;

            if (!dfInput.checkValidity()) {
                this.addError(dfInput, this.resolveMessage(dfInput));
                dfValid = false;
            }
        });

        return dfValid;
    }

    resolveMessage(dfInput) {
        const dfCustom = dfInput.dataset.errorMessage;
        if (dfCustom) return dfCustom;
        const dfValidity = dfInput.validity;
        if (dfValidity.valueMissing)    return 'Dieses Feld ist erforderlich';
        if (dfValidity.patternMismatch) return 'Ungültiges Format';
        if (dfValidity.typeMismatch)    return 'Ungültige Eingabe (z.B. E-Mail-Format prüfen)';
        if (dfValidity.rangeUnderflow)  return `Mindestens ${dfInput.min}`;
        if (dfValidity.rangeOverflow)   return `Maximal ${dfInput.max}`;
        if (dfValidity.stepMismatch)    return `Schrittweite: ${dfInput.step}`;
        if (dfValidity.tooLong)         return `Maximal ${dfInput.maxLength} Zeichen`;
        if (dfValidity.badInput)        return 'Ungültige Eingabe';
        return dfInput.validationMessage || 'Ungültige Eingabe';
    }

    addError(dfElement, dfMessage) {
        dfElement.classList.add('field-error');
        const dfSpan = document.createElement('span');
        dfSpan.className     = 'field-error-message';
        dfSpan.textContent   = dfMessage;
        dfSpan.setAttribute('role', 'alert');
        dfElement.insertAdjacentElement('afterend', dfSpan);
    }

    clearErrors(dfStep) {
        dfStep.querySelectorAll('.field-error').forEach(dfEl => dfEl.classList.remove('field-error'));
        dfStep.querySelectorAll('.field-error-message').forEach(dfEl => dfEl.remove());
    }

    markBackendErrors(dfErrors) {
        if (!dfErrors || typeof dfErrors !== 'object') return;
        Object.entries(dfErrors).forEach(([dfField, dfMessage]) => {
            const dfInput = this.dfForm.querySelector(`[name="${dfField}"]`);
            if (dfInput) this.addError(dfInput, dfMessage);
        });
    }
}
