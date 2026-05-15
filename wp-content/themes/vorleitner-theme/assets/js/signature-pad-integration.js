class SignaturePadIntegration {
    constructor(dfCanvasSelector, dfHiddenInputSelector) {
        this.dfCanvas       = document.querySelector(dfCanvasSelector);
        this.dfHiddenInput  = document.querySelector(dfHiddenInputSelector);
        this.dfSignaturePad = null;
        this.dfInitialized  = false;
    }

    init() {
        if (!this.dfCanvas || typeof SignaturePad === 'undefined') return;

        this.dfSignaturePad = new SignaturePad(this.dfCanvas, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)',
        });

        const dfClearButton = document.querySelector('[data-action="clear-signature"]');
        if (dfClearButton) {
            dfClearButton.addEventListener('click', () => this.dfSignaturePad.clear());
        }

        window.addEventListener('resize', () => {
            if (this.dfCanvas.offsetWidth > 0) this.resizeCanvas();
        });

        // Canvas is inside a hidden step — resize when it first becomes visible
        const dfObserver = new ResizeObserver(() => {
            if (this.dfCanvas.offsetWidth > 0 && !this.dfInitialized) {
                this.dfInitialized = true;
                this.resizeCanvas();
            }
        });
        dfObserver.observe(this.dfCanvas);
    }

    resizeCanvas() {
        const dfPixelRatio   = Math.max(window.devicePixelRatio || 1, 1);
        const dfCurrentWidth = this.dfCanvas.offsetWidth;
        const dfCurrentHeight= this.dfCanvas.offsetHeight;
        if (dfCurrentWidth === 0 || dfCurrentHeight === 0) return;
        this.dfCanvas.width  = dfCurrentWidth  * dfPixelRatio;
        this.dfCanvas.height = dfCurrentHeight * dfPixelRatio;
        this.dfCanvas.getContext('2d').scale(dfPixelRatio, dfPixelRatio);
        if (this.dfSignaturePad) this.dfSignaturePad.clear();
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
}
