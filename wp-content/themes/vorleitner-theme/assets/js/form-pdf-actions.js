class FormPdfActions {
    constructor() {
        this.dfPostId  = null;
        this.dfToken   = null;
        this.dfBaseUrl = (window.vorleitnerFormConfig?.restUrl ?? '') + 'pdf/';
    }

    activate(dfPostId, dfToken) {
        this.dfPostId = dfPostId;
        this.dfToken  = dfToken;

        const dfBlock = document.querySelector('.pdf-actions-block');
        if (dfBlock) dfBlock.style.display = 'block';

        const dfBtn = document.querySelector('#pdf-download-btn');
        if (dfBtn) {
            dfBtn.href = this.dfBaseUrl + 'download?post_id=' + dfPostId
                + '&token=' + encodeURIComponent(dfToken) + '&mode=view';
        }
    }
}
