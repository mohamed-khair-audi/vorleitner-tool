class SignaturePadIntegration {
    constructor(dfCanvasSelector, dfHiddenInputSelector) {
        this.dfCanvas      = document.querySelector(dfCanvasSelector);
        this.dfHiddenInput = document.querySelector(dfHiddenInputSelector);
        this.dfWrapper     = this.dfCanvas?.closest('.signature-pad-wrapper') ?? null;
        this.dfSignaturePad = null;
        this.dfResizeTimer  = null;
    }

    init() {
        if (!this.dfCanvas || typeof SignaturePad === 'undefined') return;

        const dfClearButton = document.querySelector('[data-action="clear-signature"]');
        if (dfClearButton) {
            dfClearButton.addEventListener('click', () => this.clear());
        }

        window.addEventListener('resize', () => {
            clearTimeout(this.dfResizeTimer);
            this.dfResizeTimer = setTimeout(() => this.fitCanvas(true), 150);
        });

        document.addEventListener('vorleitner:step-shown', (dfEvent) => {
            if (!dfEvent.detail?.step?.contains(this.dfCanvas)) return;
            requestAnimationFrame(() => this.ensureReady());
        });

        if (this.dfCanvas.offsetParent !== null) {
            this.ensureReady();
        }
    }

    ensureReady(dfAttempt = 0) {
        if (!this.dfCanvas) return;

        const dfWidth  = this.dfCanvas.parentElement?.clientWidth || this.dfCanvas.offsetWidth;
        const dfHeight = parseInt(getComputedStyle(this.dfCanvas).height, 10) || 200;

        if (dfWidth < 10) {
            if (dfAttempt < 40) {
                requestAnimationFrame(() => this.ensureReady(dfAttempt + 1));
            }
            return;
        }

        if (!this.dfSignaturePad) {
            this.applyCanvasSize(dfWidth, dfHeight);
            this.dfSignaturePad = new SignaturePad(this.dfCanvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor:        'rgb(17, 24, 39)',
                minWidth:        1.2,
                maxWidth:        3.2,
                throttle:        8,
                velocityFilterWeight: 0.65,
            });
            this.dfSignaturePad.addEventListener('beginStroke', () => this.setState('drawing'));
            this.dfSignaturePad.addEventListener('endStroke', () => {
                this.updateHiddenInput();
                this.setState(this.dfSignaturePad.isEmpty() ? 'empty' : 'signed');
            });
        } else {
            this.fitCanvas(true);
        }

        this.setState(this.dfSignaturePad?.isEmpty() ? 'empty' : 'signed');
    }

    applyCanvasSize(dfWidth, dfHeight) {
        const dfRatio = Math.max(window.devicePixelRatio || 1, 1);
        this.dfCanvas.width  = Math.floor(dfWidth * dfRatio);
        this.dfCanvas.height = Math.floor(dfHeight * dfRatio);
        this.dfCanvas.style.width  = dfWidth + 'px';
        this.dfCanvas.style.height = dfHeight + 'px';
        const dfCtx = this.dfCanvas.getContext('2d');
        dfCtx.setTransform(1, 0, 0, 1, 0, 0);
        dfCtx.scale(dfRatio, dfRatio);
    }

    fitCanvas(dfPreserve = false) {
        if (!this.dfCanvas) return;

        const dfWidth  = this.dfCanvas.parentElement?.clientWidth || this.dfCanvas.offsetWidth;
        const dfHeight = parseInt(getComputedStyle(this.dfCanvas).height, 10) || 200;
        if (dfWidth < 10) return;

        const dfData = dfPreserve && this.dfSignaturePad && !this.dfSignaturePad.isEmpty()
            ? this.dfSignaturePad.toData()
            : null;

        this.applyCanvasSize(dfWidth, dfHeight);

        if (this.dfSignaturePad) {
            this.dfSignaturePad.clear();
            if (dfData?.length) {
                this.dfSignaturePad.fromData(dfData);
            }
            this.updateHiddenInput();
        }
    }

    clear() {
        if (this.dfSignaturePad) this.dfSignaturePad.clear();
        if (this.dfHiddenInput) this.dfHiddenInput.value = '';
        this.setState('empty');
    }

    setState(dfState) {
        if (!this.dfWrapper) return;
        this.dfWrapper.classList.remove('is-empty', 'is-drawing', 'is-signed');
        this.dfWrapper.classList.add(
            dfState === 'signed' ? 'is-signed' : (dfState === 'drawing' ? 'is-drawing' : 'is-empty')
        );
        const dfStatus = this.dfWrapper.querySelector('.signature-pad-status');
        if (dfStatus) {
            dfStatus.textContent = dfState === 'signed'
                ? 'Unterschrift erfasst'
                : (dfState === 'drawing' ? 'Wird unterschrieben…' : 'Noch keine Unterschrift');
        }
    }

    getBase64DataUrl() {
        if (!this.dfSignaturePad || this.dfSignaturePad.isEmpty()) return '';
        return this.dfSignaturePad.toDataURL('image/png');
    }

    updateHiddenInput() {
        if (this.dfHiddenInput) {
            this.dfHiddenInput.value = this.getBase64DataUrl();
        }
    }

    isEmpty() {
        return !this.dfSignaturePad || this.dfSignaturePad.isEmpty();
    }
}
