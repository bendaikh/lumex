<!DOCTYPE html>
<html lang="en"
    dir="{{ company_setting('site_rtl', $proposal->created_by, $proposal->workspace) == 'on' ? 'rtl' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ \App\Models\Proposal::proposalNumberFormat($proposal->proposal_id, $proposal->created_by, $proposal->workspace) }}
        |
        {{ !empty(company_setting('title_text', $proposal->created_by, $proposal->workspace)) ? company_setting('title_text', $proposal->created_by, $proposal->workspace) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') : 'WorkDo') }}
    </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">


    <style type="text/css">
        :root {
            --theme-color: {{ $color }};
            --white: #ffffff;
            --black: #000000;
        }

        body {
            font-family: 'Lato', sans-serif;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }

        table tr td {
            padding: 0.75rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 12px;
        }

        .invoice-preview-main {
            max-width: 750px;
            width: 750px;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
        }
        
        @media print {
            .invoice-preview-main {
                max-width: 100%;
                width: 100%;
            }
        }

        .invoice-logo {
            max-width: 200px;
            width: 100%;
        }

        .invoice-header table td {
            padding: 15px 30px;
        }
        
        .invoice-header table td.text-right {
            padding: 15px 50px 15px 30px;
        }
        
        /* Fix PROPOSAL header positioning to prevent right-side cropping */
        .invoice-header .text-right {
            text-align: right;
            padding-right: 60px !important;
        }
        
        .invoice-header h3 {
            font-size: 36px;
            line-height: 1.3;
            padding: 5px 15px 5px 0;
            margin: 0 15px 0 0;
            letter-spacing: -0.5px;
            max-width: 100%;
            overflow: visible;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
            white-space: nowrap;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 114px;
            height: 114px;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
        }

        .view-qrcode img {
            width: 100%;
            height: 100%;
        }

        .invoice-body {
            padding: 20px 25px 0;
        }

        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 15px;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .invoice-summary td,
        .invoice-summary th {
            font-size: 13px;
            font-weight: 600;
        }

        .total-table td:first-of-type {
            white-space: nowrap;
            padding-right: 40px;
            min-width: 120px;
        }
        
        /* Fix footer currency to prevent MAD from being cut off */
        .total-table td:last-of-type {
            width: 180px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: right;
            white-space: nowrap;
        }
        
        .total-table tr {
            line-height: 2;
        }

        .invoice-footer {
            padding: 15px 0;
        }

        .itm-description td {
            padding-top: 0;
        }

        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th {
            text-align: right;
        }

        html[dir="rtl"] .text-right {
            text-align: left;
        }

        html[dir="rtl"] .view-qrcode {
            margin-left: 0;
            margin-right: auto;
        }

        p:not(:last-of-type) {
            margin-bottom: 15px;
        }

        .invoice-summary p {
            margin-bottom: 0;
        }
        .wid-75 {
            width: 75px;
        }

        /* Pagination and Print Styles */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            @page {
                size: A4;
                margin: 10mm 15mm;
            }

            .invoice-preview-main {
                max-width: 100%;
                width: 100%;
                box-shadow: none;
            }

            .invoice-header {
                page-break-after: avoid;
            }

            .invoice-body {
                page-break-inside: auto;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                page-break-inside: avoid;
            }

            .page-break-before {
                page-break-before: always;
            }

            .page-break-after {
                page-break-after: always;
            }

            .no-page-break {
                page-break-inside: avoid;
            }

            .no-print {
                display: none;
            }
        }

        /* Ensure content fits within page width */
        .invoice-preview-main {
            overflow-x: visible;
        }

        table {
            table-layout: fixed;
            word-wrap: break-word;
        }

        /* Adjust column widths for better fit */
        .items-table th:nth-child(1),
        .items-table td:nth-child(1) {
            width: auto; /* Item column - takes remaining space */
        }

        .items-table th:nth-child(2),
        .items-table td:nth-child(2) {
            width: 60px; /* Quantity column */
        }

        .items-table th:nth-child(3),
        .items-table td:nth-child(3) {
            width: 90px; /* Price column */
        }

        .items-table th:nth-child(4),
        .items-table td:nth-child(4) {
            width: 90px; /* Discount column */
        }

        .items-table th:nth-child(5),
        .items-table td:nth-child(5) {
            width: 90px; /* Tax column */
        }

        .items-table th:nth-child(6),
        .items-table td:nth-child(6) {
            width: 100px; /* Total column */
        }

        /* Prevent product rows from splitting across pages */
        .items-table tbody tr {
            page-break-inside: avoid !important;
            page-break-after: auto;
        }

        .items-table tbody tr.itm-description {
            page-break-inside: avoid !important;
            page-break-before: avoid !important;
        }

        /* Keep product row and its description together */
        .product-row-wrapper {
            page-break-inside: avoid !important;
        }
        
        /* Enhanced page break controls */
        .no-page-break {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
        
        .items-table tfoot {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
        
        /* Ensure rows stay together */
        .items-table tbody tr.no-page-break,
        .items-table tbody tr.no-page-break + tr.itm-description {
            page-break-inside: avoid !important;
            page-break-before: avoid !important;
        }
    </style>
</head>

<body>
    <div class="invoice-preview-main" id="boxes">
        <div class="invoice-header" style="border-top: 15px solid var(--theme-color); background: #f8f8f8;">
            <table>
                <tbody>
                    <tr>
                        <td>
                            @if(!empty($img))
                                <img class="invoice-logo" src="{{ $img }}" alt="Company Logo" style="max-width: 200px; height: auto;">
                            @else
                                <div style="width: 200px; height: 60px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border: 1px solid #ddd;">
                                    <span style="font-size: 12px; color: #999;">{{ !empty($settings['company_name']) ? $settings['company_name'] : 'Company Logo' }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="text-right">
                            <h3
                                style="text-transform: uppercase; font-weight: bold; color: {{ $color }};">
                                @if(isset($is_bon_de_livraison) && $is_bon_de_livraison)
                                    {{ __('DELIVERY NOTE') }}
                                @else
                                    {{ __('PROPOSAL') }}
                                @endif
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="vertical-align-top">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <p style="font-size: 11px; line-height: 1.4;">
                                <strong style="font-size: 13px;">
                                    @if (!empty($settings['company_name']))
                                        {{ $settings['company_name'] }}
                                    @endif
                                </strong>
                                <br>
                                @if (!empty($settings['company_address']))
                                    {{ $settings['company_address'] }}
                                @endif
                                @if (!empty($settings['company_city']))
                                    <br>{{ $settings['company_city'] }}
                                @endif
                                @if (!empty($settings['company_state']))
                                    , {{ $settings['company_state'] }}
                                @endif
                                @if (!empty($settings['company_zipcode']))
                                    {{ $settings['company_zipcode'] }}
                                @endif
                                @if (!empty($settings['company_country']))
                                    <br>{{ $settings['company_country'] }}
                                @endif
                            </p>
                            <table class="no-space" style="margin-top: 15px;">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Référence') }}:</strong></td>
                                        <td>{{ \App\Models\Proposal::proposalNumberFormat($proposal->proposal_id, $proposal->created_by, $proposal->workspace) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Date') }}:</strong></td>
                                        <td>{{ company_date_formate($proposal->issue_date, $proposal->created_by, $proposal->workspace) }}</td>
                                    </tr>
                                    @if (!empty($customFields) && count($proposal->customField) > 0)
                                        @foreach ($customFields as $field)
                                            <tr>
                                                <td><strong>{{ $field->name }}:</strong></td>
                                                <td style="white-space: normal;">
                                                    @if ($field->type == 'attachment')
                                                        <a href="{{ get_file($proposal->customField[$field->id]) }}" target="_blank">
                                                            <img src=" {{ get_file($proposal->customField[$field->id]) }} " class="wid-75 rounded me-3">
                                                        </a>
                                                    @else
                                                        {{ !empty($proposal->customField[$field->id]) ? $proposal->customField[$field->id] : '-' }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </td>
                        <td style="width: 50%; vertical-align: top; padding-left: 20px;">
                            <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; font-size: 11px; line-height: 1.6;">
                                <p style="margin: 0;">
                                    <strong style="font-size: 14px;">{{ !empty($customer->name) ? $customer->name : '' }}</strong><br>
                                    @if(!empty($customer->billing_name) && $customer->billing_name != $customer->name)
                                        {{ $customer->billing_name }}<br>
                                    @endif
                                    @if(!empty($customer->tax_number))
                                        <strong>{{ __('Référence client') }}:</strong> {{ $customer->tax_number }}<br>
                                    @endif
                                    @if(!empty($customer->ice))
                                        <strong>ICE:</strong> {{ $customer->ice }}<br>
                                    @endif
                                    @if(!empty($customer->billing_address))
                                        {{ $customer->billing_address }}<br>
                                    @endif
                                    @if(!empty($customer->billing_city))
                                        {{ $customer->billing_city }}
                                    @endif
                                    @if(!empty($customer->billing_state))
                                        , {{ $customer->billing_state }}
                                    @endif
                                    @if(!empty($customer->billing_zip))
                                        {{ $customer->billing_zip }}
                                    @endif
                                    @if(!empty($customer->billing_country))
                                        <br>{{ $customer->billing_country }}
                                    @endif
                                </p>
                            </div>
                            @php
                                $qr_display_setting = (isset($is_bon_de_livraison) && $is_bon_de_livraison) 
                                    ? (isset($settings['bon_de_livraison_qr_display']) ? $settings['bon_de_livraison_qr_display'] : 'off')
                                    : (isset($settings['proposal_qr_display']) ? $settings['proposal_qr_display'] : 'off');
                            @endphp
                            @if ($qr_display_setting == 'on')
                                <div class="view-qrcode" style="margin-top: 10px;">
                                    {!! DNS2D::getBarcodeHTML(route('pay.proposalpay', Crypt::encrypt($proposal->proposal_id)), 'QRCODE', 2, 2) !!}
                                </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="invoice-body" style="border-bottom: 15px solid var(--theme-color);">

            <table class="add-border invoice-summary items-table" style="margin-top: 15px;">
                <thead style="background-color: var(--theme-color);color: {{ $font_color }};">
                    <tr>
                        <th>{{ __('Item') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Rate') }}</th>
                        <th>{{ __('Discount') }}</th>
                        <th>{{ __('Tax') }} (%)</th>
                        <th>{{ __('Total Price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($proposal->itemData) && count($proposal->itemData) > 0)
                        @foreach ($proposal->itemData as $key => $item)
                            <tr class="no-page-break" style="page-break-inside: avoid;">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ currency_format_with_sym($item->price, $proposal->created_by, $proposal->workspace) }}
                                </td>
                                <td>{{ $item->discount != 0 ? number_format($item->discount, 2) . '%' : '-' }}
                                </td>
                                <td>
                                    @if (!empty($item->itemTax))
                                        @foreach ($item->itemTax as $taxes)
                                            <span>{{ $taxes['name'] }} </span><span> ({{ $taxes['rate'] }}) </span>
                                            <span>{{ $taxes['price'] }}</span>
                                        @endforeach
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td>{{ currency_format_with_sym((($item->price * $item->quantity) * (1 - ($item->discount / 100))) + (isset($item->tax_price) ? $item->tax_price : 0), $proposal->created_by, $proposal->workspace) }}
                                </td>
                            </tr>
                            @if ($item->description != null)
                            <tr class="border-0 itm-description no-page-break" style="page-break-inside: avoid; page-break-before: avoid;">
                                <td colspan="6">{{ $item->description }} </td>
                            </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <p>-</p>
                                <p>-</p>
                            </td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr class="border-0 itm-description">
                            <td colspan="6">-</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot class="no-page-break">
                    <tr>
                        <td>{{ __('Total') }}</td>
                        <td>{{ $proposal->totalQuantity }}</td>
                        <td>{{ currency_format_with_sym($proposal->totalRate, $proposal->created_by, $proposal->workspace) }}
                        </td>
                        <td>{{ currency_format_with_sym($proposal->getTotalDiscount(), $proposal->created_by, $proposal->workspace) }}
                        </td>
                        <td>{{ currency_format_with_sym($proposal->totalTaxPrice, $proposal->created_by, $proposal->workspace) }}
                        </td>
                        <td>{{ currency_format_with_sym($proposal->getSubTotal(), $proposal->created_by, $proposal->workspace) }}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $colspan = 4;
                        @endphp
                        <td colspan="{{$colspan}}"></td>
                        <td colspan="2" class="sub-total">
                            <table class="total-table">
                                @if ($proposal->getTotalDiscount())
                                    <tr>
                                        <td>{{ __('Discount') }}:</td>
                                        <td>{{ currency_format_with_sym($proposal->getTotalDiscount(), $proposal->created_by, $proposal->workspace) }}
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($proposal->taxesData))
                                    @foreach ($proposal->taxesData as $taxName => $taxPrice)
                                        <tr>
                                            <td>{{ $taxName }} :</td>
                                            <td>{{ currency_format_with_sym($taxPrice, $proposal->created_by, $proposal->workspace) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td><strong>{{ __('Total') }}:</strong></td>
                                    <td><strong>{{ currency_format_with_sym($proposal->getSubTotal() - $proposal->getTotalDiscount() + $proposal->getTotalTax(), $proposal->created_by, $proposal->workspace) }}</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="invoice-footer no-page-break" style="margin-top: 20px;">
                @if(!empty($settings['proposal_footer_title']) || !empty($settings['proposal_footer_notes']))
                    <p> 
                        @if(!empty($settings['proposal_footer_title']))
                            {{ $settings['proposal_footer_title'] }} <br>
                        @endif
                        @if(!empty($settings['proposal_footer_notes']))
                            {{ $settings['proposal_footer_notes'] }}
                        @endif
                    </p>
                @endif
            </div>
        </div>
        @if(!empty($settings['proposal_footer_text']))
        <div class="footer-legal-text no-page-break" style="background: #f8f8f8; padding: 15px 20px; text-align: center; font-size: 10px; line-height: 1.6; color: #333; border-top: 2px solid #ddd; margin-top: 0; page-break-inside: avoid;">
            {!! nl2br(e($settings['proposal_footer_text'])) !!}
        </div>
        @endif
    </div>

    @if (!isset($preview))
        @include('proposal.script')
    @endif
</body>

</html>

