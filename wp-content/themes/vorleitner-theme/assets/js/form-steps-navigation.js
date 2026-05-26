class FormStepsNavigation {
    constructor(dfFormSelector, dfConditionalFieldsInstance = null) {
        this.dfForm          = document.querySelector(dfFormSelector);
        this.dfSteps         = this.dfForm ? Array.from(this.dfForm.querySelectorAll('.form-step')) : [];
        this.dfProgressSteps   = Array.from(document.querySelectorAll('.progress-step'));
        this.dfProgressCompact = document.querySelector('.form-progress-compact');
        this.dfCurrentIndex    = 0;
        this.dfConditional   = dfConditionalFieldsInstance;
    }

    init() {
        if (!this.dfForm) return;

        const dfAgb = this.dfForm.querySelector('#agb_akzeptiert');
        if (dfAgb) {
            dfAgb.addEventListener('change', () => {
                const dfBox = dfAgb.closest('.consent-box');
                if (dfBox && dfAgb.checked) {
                    dfBox.classList.remove('is-error');
                    dfBox.querySelector('.field-error-message')?.remove();
                }
            });
        }

        if (this.dfProgressCompact) {
            this.updateCompactProgress(0);
        }

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
        this.updateCompactProgress(dfIndex);
        this.dfCurrentIndex = dfIndex;
        document.dispatchEvent(new CustomEvent('vorleitner:step-shown', {
            detail: { index: dfIndex, step: this.dfSteps[dfIndex] },
        }));
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    validateCurrentStep() {
        const dfStep = this.dfSteps[this.dfCurrentIndex];
        this.clearErrors(dfStep);
        let dfValid           = true;
        const dfHandledRadios = new Set();

        dfStep.querySelectorAll('input, textarea, select').forEach((dfInput) => {
            if (!dfInput.name || dfInput.type === 'hidden') return;
            if (this.dfConditional && !this.dfConditional.isVisible(dfInput)) return;

            if (dfInput.type === 'radio') {
                if (dfInput.required && !dfHandledRadios.has(dfInput.name) && !dfStep.querySelector(`[name="${dfInput.name}"]:checked`)) {
                    dfHandledRadios.add(dfInput.name);
                    const dfGroup = dfInput.closest('.radio-group') || dfInput.parentElement;
                    this.addError(dfGroup, 'Bitte eine Option auswählen');
                    dfValid = false;
                }
                return;
            }

            if (dfInput.type === 'checkbox') {
                if (dfInput.required && !dfInput.checked) {
                    const dfConsentBox = dfInput.closest('.consent-box');
                    if (dfConsentBox) {
                        dfConsentBox.classList.add('is-error');
                        this.addError(dfConsentBox, 'Bitte aktivieren Sie das Kontrollkästchen, um fortzufahren.');
                    } else {
                        this.addError(dfInput.closest('.checkbox-option') || dfInput, 'Bitte bestätigen Sie die erforderliche Zustimmung');
                    }
                    dfValid = false;
                }
                return;
            }

            if (dfInput.hasAttribute('data-required-when-visible') && dfInput.required && dfInput.value.trim() === '') {
                this.addError(dfInput, 'Dieses Feld ist erforderlich');
                dfValid = false;
                return;
            }

            if (!dfInput.checkValidity()) {
                this.addError(dfInput, this.resolveMessage(dfInput));
                dfValid = false;
            }
        });

        dfStep.querySelectorAll('.conditional-block:not([hidden]) [data-required-when-visible][type="radio"]').forEach((dfRadio) => {
            const dfName = dfRadio.name;
            if (dfHandledRadios.has(dfName)) return;
            if (!dfStep.querySelector(`[name="${dfName}"]:checked`)) {
                dfHandledRadios.add(dfName);
                const dfGroup = dfRadio.closest('.radio-group') || dfRadio.parentElement;
                this.addError(dfGroup, 'Bitte eine Option auswählen');
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
        dfStep.querySelectorAll('.consent-box.is-error').forEach(dfEl => dfEl.classList.remove('is-error'));
    }

    updateCompactProgress(dfIndex) {
        if (!this.dfProgressCompact) return;
        const dfTotal   = this.dfSteps.length;
        const dfPercent = Math.round(((dfIndex + 1) / dfTotal) * 100);
        const dfFill    = this.dfProgressCompact.querySelector('.form-progress-bar__fill');
        const dfText    = this.dfProgressCompact.querySelector('.form-progress-text');
        const dfLabel   = this.dfProgressCompact.querySelector('.form-progress-label');
        const dfBar     = this.dfProgressCompact.querySelector('.form-progress-bar');
        const dfDots    = this.dfProgressCompact.querySelectorAll('.form-progress-dot');

        if (dfFill) dfFill.style.width = dfPercent + '%';
        if (dfText) dfText.textContent = `Schritt ${dfIndex + 1} von ${dfTotal}`;
        if (dfLabel && this.dfProgressCompact.dataset.stepLabels) {
            const dfLabels = JSON.parse(this.dfProgressCompact.dataset.stepLabels);
            if (dfLabels[dfIndex]) dfLabel.textContent = dfLabels[dfIndex];
        }
        if (dfBar) dfBar.setAttribute('aria-valuenow', String(dfIndex + 1));
        dfDots.forEach((dfDot, dfI) => {
            dfDot.classList.toggle('is-active', dfI === dfIndex);
            dfDot.classList.toggle('is-done', dfI < dfIndex);
        });
    }

    markBackendErrors(dfErrors) {
        if (!dfErrors || typeof dfErrors !== 'object') return;
        Object.entries(dfErrors).forEach(([dfField, dfMessage]) => {
            if (dfField === 'agb_akzeptiert') {
                const dfBox = this.dfForm.querySelector('.consent-box');
                if (dfBox) {
                    dfBox.classList.add('is-error');
                    this.addError(dfBox, dfMessage);
                }
                return;
            }
            const dfInput = this.dfForm.querySelector(`[name="${dfField}"]`);
            if (dfInput) this.addError(dfInput, dfMessage);
        });
    }
}
