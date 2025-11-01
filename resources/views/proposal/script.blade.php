<script src="{{ asset('js/jquery.min.js') }} "></script>
<script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script>
    function closeScript() {
        setTimeout(function () {
            window.open(window.location, '_self').close();
        }, 1000);
    }

    $(window).on('load', function () {
        var element = document.getElementById('boxes');
        var opt = {
            margin: [0.5, 0.5, 0.5, 0.5],
            filename: '{{App\Models\Proposal::proposalNumberFormat($proposal->proposal_id,$proposal->created_by)}}',
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

