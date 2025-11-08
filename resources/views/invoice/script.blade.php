<script src="{{ asset('js/jquery.min.js') }} "></script>
<script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>

<script>
    function closeScript() {
        setTimeout(function () {
            window.open(window.location, '_self').close();
        }, 1000);
    }

    $(document).ready(function() {
        var element = document.getElementById('boxes');
        var opt = {
            margin: [0.5, 0.5, 0.8, 0.5], // extra bottom space for footer
            filename: '{{ \App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id,$invoice->created_by) }}',
            image: {type: 'jpeg', quality: 0.98},
            html2canvas: {
                scale: 2,
                useCORS: true,
                letterRendering: true,
                logging: false,
                scrollY: 0,
                scrollX: 0,
                windowWidth: 1200
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            },
            pagebreak: {
                mode: ['css', 'legacy'],
                before: '.page-break-before',
                after: '.page-break-after',
                avoid: ['.no-page-break', 'tr', '.items-table tbody tr', '.items-table tfoot', '.itm-description']
            }
        };

        // Hide the original HTML footer block to avoid duplicate on last page
        var footerBlock = document.querySelector('.footer-legal-text');
        var originalFooterDisplay = null;
        if (footerBlock) {
            originalFooterDisplay = footerBlock.style.display;
            footerBlock.style.display = 'none';
        }

        // Prepare footer text from settings to draw on every page
        var footerText = {!! json_encode(strip_tags($settings['footer_text'] ?? '')) !!};
        footerText = (footerText || '').trim();

        // Generate PDF with repeated footer and page numbers
        var worker = html2pdf().set(opt).from(element);

        worker.toPdf().get('pdf').then(function (pdf) {
            var totalPages = pdf.internal.getNumberOfPages();
            var pageWidth = pdf.internal.pageSize.getWidth();
            var pageHeight = pdf.internal.pageSize.getHeight();
            var sideMargin = 0.5; // must match opt.margin left/right
            var bottomMargin = 0.5; // visual gap from bottom edge

            // Footer style: filled background (#CEDAE1) with centered black text, no border
            var footerFontSize = 10;
            var lineHeight = 0.14; // inches per line
            var maxFooterWidth = pageWidth - sideMargin * 2;
            var footerLines = footerText ? pdf.splitTextToSize(footerText, maxFooterWidth - 0.2) : [];
            var paddingY = 0.12; // vertical padding inside the background bar
            var pageNumberY = pageHeight - 0.3; // page number position
            var gapAbovePageNumber = 0.12;

            // Compute background bar height
            var footerContentHeight = Math.max(footerLines.length * lineHeight, 0.14);
            var barHeight = footerContentHeight + paddingY * 2;
            var barBottomY = pageNumberY - gapAbovePageNumber;
            var barTopY = barBottomY - barHeight;

            for (var i = 1; i <= totalPages; i++) {
                pdf.setPage(i);

                // Background bar across full page width
                pdf.setFillColor(206, 218, 225); // #CEDAE1
                pdf.rect(0, barTopY, pageWidth, barHeight, 'F');

                // Footer text (centered, black)
                if (footerLines.length > 0) {
                    pdf.setFontSize(footerFontSize);
                    pdf.setTextColor(0, 0, 0);
                    var startY = barTopY + paddingY + lineHeight;
                    pdf.text(footerLines, pageWidth / 2, startY, { align: 'center' });
                }

                // Add centered page number
                pdf.setFontSize(9);
                pdf.setTextColor(100);
                var pageText = 'Page ' + i + ' of ' + totalPages;
                var textWidth = pdf.getStringUnitWidth(pageText) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
                var textX = (pageWidth - textWidth) / 2;
                pdf.text(pageText, textX, pageHeight - 0.3);
            }
        }).save().then(function () {
            if (footerBlock) {
                footerBlock.style.display = originalFooterDisplay;
            }
            closeScript();
        });
    });
</script>
