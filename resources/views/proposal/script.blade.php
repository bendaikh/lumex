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
            margin: [0.5, 0.5, 0.8, 0.5], // extra bottom space for footer
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
        
        // Hide the original HTML footer block to avoid duplicate on last page
        var footerBlock = document.querySelector('.footer-legal-text');
        var originalFooterDisplay = null;
        var footerText = '';
        
        if (footerBlock) {
            originalFooterDisplay = footerBlock.style.display;
            // Extract the text content directly from the DOM to preserve encoding
            footerText = footerBlock.innerText || footerBlock.textContent || '';
            footerBlock.style.display = 'none';
        }
        
        footerText = (footerText || '').trim();
        
        // Generate PDF with page numbers and a repeated footer on each page
        var worker = html2pdf().set(opt).from(element);
        
        worker.toPdf().get('pdf').then(function (pdf) {
            var totalPages = pdf.internal.getNumberOfPages();
            var pageWidth = pdf.internal.pageSize.getWidth();
            var pageHeight = pdf.internal.pageSize.getHeight();
            var sideMargin = 0.5; // must match opt.margin left/right
            var bottomMargin = 0.5; // visual gap from bottom edge
            
            // Footer style: filled background (#CEDAE1) with centered black text, no border
            var footerFontSize = 10;
            var lineHeight = 0.16; // inches per line
            var maxFooterWidth = pageWidth - sideMargin * 2;

            function normalizeFooterText(rawText) {
                if (!rawText) {
                    return '';
                }

                var cleaned = rawText
                    .replace(/\uFEFF/g, '') // remove BOM
                    .replace(/\u00A0/g, ' ') // replace non-breaking spaces
                    .replace(/\u2022/g, ' - ')
                    .replace(/\u2023/g, ' - ')
                    .replace(/\u2024/g, ' - ')
                    .replace(/\u2219/g, ' - ')
                    .replace(/\u00B7/g, ' - ')
                    .replace(/\r\n/g, '\n')
                    .replace(/\r/g, '\n');

                var lines = cleaned.split('\n').map(function (line) {
                    return line.trim();
                }).filter(function (line) {
                    return line.length;
                });

                return lines.join('\n');
            }

            var sanitizedFooterText = normalizeFooterText(footerText);
            var footerLines = [];

            if (sanitizedFooterText) {
                sanitizedFooterText.split('\n').forEach(function (line) {
                    var wrapped = pdf.splitTextToSize(line, maxFooterWidth - 0.2);
                    if (Array.isArray(wrapped)) {
                        footerLines = footerLines.concat(wrapped);
                    } else if (wrapped) {
                        footerLines.push(wrapped);
                    }
                });
            }

            var paddingY = 0.12; // vertical padding inside the background bar
            var pageNumberY = pageHeight - 0.3; // existing page number position
            var gapAbovePageNumber = 0.12;

            // Compute background bar height based on content
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
                    pdf.setFont('helvetica', 'normal');
                    pdf.setFontSize(footerFontSize);
                    pdf.setTextColor(0, 0, 0);
                    var currentY = barTopY + paddingY + lineHeight; // draw downward from inside bar
                    footerLines.forEach(function(line) {
                        pdf.text(line, pageWidth / 2, currentY, { align: 'center', maxWidth: maxFooterWidth - 0.2 });
                        currentY += lineHeight;
                    });
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
            // Restore footer block (optional, window will close anyway)
            if (footerBlock) {
                footerBlock.style.display = originalFooterDisplay;
            }
            closeScript();
        });
    });
</script>

