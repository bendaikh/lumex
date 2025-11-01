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
            margin: 0.4,
            filename: '{{ \App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id,$invoice->created_by)}}',
            image: {type: 'jpeg', quality: 0.98},
            html2canvas: {
                scale: 2,
                useCORS: true,
                letterRendering: true
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            },
            pagebreak: {
                mode: ['avoid-all', 'css', 'legacy']
            }
        };
        
        // Generate PDF with page numbers
        var worker = html2pdf().set(opt).from(element);
        
        worker.toPdf().get('pdf').then(function (pdf) {
            var totalPages = pdf.internal.getNumberOfPages();
            
            // Add page numbers to each page
            for (var i = 1; i <= totalPages; i++) {
                pdf.setPage(i);
                pdf.setFontSize(9);
                pdf.setTextColor(100);
                var pageText = 'Page ' + i + ' of ' + totalPages;
                var textWidth = pdf.getStringUnitWidth(pageText) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
                var textX = (pdf.internal.pageSize.getWidth() - textWidth) / 2;
                pdf.text(pageText, textX, pdf.internal.pageSize.getHeight() - 0.3);
            }
        }).save().then(closeScript);
    });

</script>
