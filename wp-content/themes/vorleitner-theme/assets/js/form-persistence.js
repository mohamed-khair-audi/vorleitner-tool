class FormPersistence {
    constructor(dfFormSelector, dfStorageKey) {
        this.dfForm        = document.querySelector(dfFormSelector);
        this.dfStorageKey  = dfStorageKey;
        this.dfSkipFields  = new Set(['unterschrift_base64', 'agb_akzeptiert']);
        this.dfSaveTimeout = null;
    }

    init() {
        if (!this.dfForm) return;
        this.restore();
        this.dfUpdateResetButton();
        this.dfForm.addEventListener('input',  () => { this.scheduleSave(); this.dfUpdateResetButton(); });
        this.dfForm.addEventListener('change', () => { this.scheduleSave(); this.dfUpdateResetButton(); });
    }

    dfUpdateResetButton() {
        const dfHasData = !!sessionStorage.getItem(this.dfStorageKey);
        let dfBtn = document.getElementById('form-reset-btn');

        if (dfHasData && !dfBtn) {
            dfBtn = document.createElement('button');
            dfBtn.id          = 'form-reset-btn';
            dfBtn.type        = 'button';
            dfBtn.className   = 'btn-form-reset';
            dfBtn.textContent = '↺ Formular zurücksetzen';
            dfBtn.addEventListener('click', () => {
                if (!confirm('Alle eingegebenen Daten löschen und Formular zurücksetzen?')) return;
                this.clear();
                window.location.reload();
            });
            this.dfForm.closest('.auftrag-form-container')?.insertBefore(dfBtn, this.dfForm);
        } else if (!dfHasData && dfBtn) {
            dfBtn.remove();
        }
    }

    scheduleSave() {
        clearTimeout(this.dfSaveTimeout);
        this.dfSaveTimeout = setTimeout(() => this.save(), 400);
    }

    save() {
        const dfData = {};
        this.dfForm.querySelectorAll('input, textarea, select').forEach((dfInput) => {
            if (!dfInput.name || this.dfSkipFields.has(dfInput.name)) return;
            if (dfInput.type === 'checkbox') {
                if (dfInput.name.endsWith('[]')) {
                    if (!Array.isArray(dfData[dfInput.name])) dfData[dfInput.name] = [];
                    if (dfInput.checked) dfData[dfInput.name].push(dfInput.value);
                } else if (dfInput.checked) {
                    dfData[dfInput.name] = dfInput.value;
                }
            } else if (dfInput.type === 'radio') {
                if (dfInput.checked) dfData[dfInput.name] = dfInput.value;
            } else {
                dfData[dfInput.name] = dfInput.value;
            }
        });
        try {
            sessionStorage.setItem(this.dfStorageKey, JSON.stringify(dfData));
        } catch (_) {}
    }

    restore() {
        const dfRaw = sessionStorage.getItem(this.dfStorageKey);
        if (!dfRaw) return;
        try {
            const dfData = JSON.parse(dfRaw);
            Object.entries(dfData).forEach(([dfName, dfValue]) => {
                if (Array.isArray(dfValue)) {
                    this.dfForm.querySelectorAll(`[name="${CSS.escape(dfName)}"]`).forEach((dfEl) => {
                        dfEl.checked = dfValue.includes(dfEl.value);
                    });
                } else {
                    const dfRadio = this.dfForm.querySelector(`[name="${CSS.escape(dfName)}"][value="${CSS.escape(String(dfValue))}"]`);
                    if (dfRadio && dfRadio.type === 'radio') {
                        dfRadio.checked = true;
                        return;
                    }
                    const dfInput = this.dfForm.querySelector(`[name="${CSS.escape(dfName)}"]`);
                    if (dfInput && dfInput.type !== 'radio') dfInput.value = dfValue;
                }
            });
        } catch (_) {
            this.clear();
        }
    }

    clear() {
        sessionStorage.removeItem(this.dfStorageKey);
    }
}
