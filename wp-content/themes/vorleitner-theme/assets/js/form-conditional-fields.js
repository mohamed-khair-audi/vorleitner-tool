class FormConditionalFields {
    constructor(dfFormSelector) {
        this.dfForm         = document.querySelector(dfFormSelector);
        this.dfScrollOffset = 96;
    }

    init() {
        if (!this.dfForm) return;

        this.dfForm.querySelectorAll('.conditional-block[data-show-if]').forEach((dfBlock) => {
            const dfFieldName  = dfBlock.dataset.showIf;
            const dfShowValue = dfBlock.dataset.showValue;

            this.dfForm.querySelectorAll(`[name="${dfFieldName}"]`).forEach((dfInput) => {
                dfInput.addEventListener('change', () => {
                    this.updateBlock(dfBlock, dfFieldName, dfShowValue, true);
                });
            });

            this.updateBlock(dfBlock, dfFieldName, dfShowValue, false);
        });

        window.dfUpdateConditionals = () => {
            this.dfForm.querySelectorAll('.conditional-block[data-show-if]').forEach((dfBlock) => {
                this.updateBlock(dfBlock, dfBlock.dataset.showIf, dfBlock.dataset.showValue, false);
            });
        };
        window.dfUpdateConditionals();
    }

    updateBlock(dfBlock, dfFieldName, dfShowValue, dfShouldScroll) {
        const dfWasHidden = dfBlock.hidden;
        // Supports both radios and checkboxes: looks for the exact [value] being checked
        const dfChecked   = this.dfForm.querySelector(`[name="${dfFieldName}"][value="${dfShowValue}"]:checked`);
        const dfVisible   = !!dfChecked;

        dfBlock.hidden = !dfVisible;

        dfBlock.querySelectorAll('[data-required-when-visible]').forEach((dfInput) => {
            if (dfInput.type === 'radio') return;
            dfInput.required = dfVisible;
        });

        if (dfShouldScroll && dfVisible && dfWasHidden) {
            this.scrollToBlock(dfBlock);
        }
    }

    scrollToBlock(dfBlock) {
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                const dfRect     = dfBlock.getBoundingClientRect();
                const dfTargetY  = window.scrollY + dfRect.top - this.dfScrollOffset;
                const dfBehavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches
                    ? 'auto'
                    : 'smooth';

                window.scrollTo({
                    top:      Math.max(0, dfTargetY),
                    behavior: dfBehavior,
                });

                const dfFirstField = dfBlock.querySelector(
                    'input:not([type="hidden"]):not([type="radio"]), textarea, select'
                );
                if (dfFirstField && typeof dfFirstField.focus === 'function') {
                    setTimeout(() => {
                        try {
                            dfFirstField.focus({ preventScroll: true });
                        } catch (_) {
                            dfFirstField.focus();
                        }
                    }, dfBehavior === 'smooth' ? 400 : 0);
                }
            });
        });
    }

    isVisible(dfElement) {
        const dfBlock = dfElement.closest('.conditional-block');
        return !dfBlock || !dfBlock.hidden;
    }
}
