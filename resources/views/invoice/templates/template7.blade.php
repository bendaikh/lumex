<!DOCTYPE html>
<html lang="en" dir="{{ $settings['site_rtl'] == 'on' ? 'rtl' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ \App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id, $invoice->created_by, $invoice->workspace) }}
        |
        {{ !empty(company_setting('title_text', $invoice->created_by, $invoice->workspace)) ? company_setting('title_text', $invoice->created_by, $invoice->workspace) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') : 'WorkDo') }}
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
        font-size: 12px; /* Reduced font size */
    }

    p, li, ul, ol {
        margin: 0;
        padding: 0;
        list-style: none;
        line-height: 1.2; /* Reduced line-height */
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

    table tr th, table tr td {
        padding: 0.5rem; /* Reduced padding */
        text-align: left;
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
        max-width: 80px; /* Reduced logo size */
    }

    .invoice-header table td {
        padding: 10px 20px; /* Reduced padding */
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
        max-width: 100px; /* Reduced QR code size */
        height: 100px;
        width: 100%;
        margin-left: auto;
        margin-top: 10px;
        background: var(--white);
        padding: 8px; /* Reduced padding */
        border-radius: 10px;
    }

    .view-qrcode img {
        width: 100%;
        height: 100%;
    }

    .invoice-body {
        padding: 20px 15px 0; /* Reduced padding */
    }

    table.add-border tr {
        border-top: 1px solid var(--theme-color);
    }

    .total-table tr:first-of-type td {
        padding-top: 0;
    }

    .total-table tr:first-of-type {
        border-top: 0;
    }

    .sub-total {
        padding-right: 6px; /* small inner right padding to avoid edge clipping */
        padding-left: 0;
    }

    .border-0 {
        border: none !important;
    }

    .invoice-summary td, .invoice-summary th {
        font-size: 11px; /* Reduced font size */
        font-weight: 600;
    }

    .total-table td:last-of-type {
        width: 130px; /* Adjusted width */
    }

    .invoice-footer {
        padding: 10px 15px; /* Reduced padding */
    }

    .itm-description td {
        padding-top: 0;
    }

    html[dir="rtl"] table tr td, html[dir="rtl"] table tr th {
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
        margin-bottom: 10px; /* Reduced margin */
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
            counter-reset: page;
        }

        @page {
            size: A4;
            margin: 10mm 15mm;
            @bottom-center {
                content: "Page " counter(page) " of " counter(pages);
            }
        }

        .invoice-preview-main {
            max-width: 100%;
            width: 100%;
            box-shadow: none;
            page-break-after: auto;
        }

        .invoice-header {
            page-break-inside: avoid;
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
            display: table-footer-group;
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
        width: 50px; /* Image column */
    }

    .items-table th:nth-child(2),
    .items-table td:nth-child(2) {
        width: auto; /* Description column - takes remaining space */
    }

    .items-table th:nth-child(3),
    .items-table td:nth-child(3) {
        width: 60px; /* Quantity column */
    }

    .items-table th:nth-child(4),
    .items-table td:nth-child(4) {
        width: 90px; /* Price column */
    }

    .items-table th:nth-child(5),
    .items-table td:nth-child(5) {
        width: 90px; /* Tax column */
    }

    .items-table th:nth-child(6),
    .items-table td:nth-child(6) {
        width: 100px; /* Total column */
    }

    /* Proposal-style totals summary */
    .totals-section {
        border-top: 1px solid #d1d5db;
        padding-top: 14px;
        margin-top: 6px;
    }

    /* Wrapper for summary section outside the items table */
    .totals-section-wrapper {
        margin-top: 20px;
        padding: 0;
        display: flex;
        justify-content: center; /* center the summary */
    }

    .totals-summary {
        width: auto; /* dynamic width - only uses what's needed */
        max-width: 100%;
        border-collapse: collapse;
        table-layout: auto; /* auto layout for flexibility */
    }

    .totals-summary td {
        padding: 8px 12px;
        font-size: 13px;
    }

    .totals-summary tr + tr td {
        padding-top: 8px;
    }

    .totals-summary td:first-of-type {
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #374151;
        font-weight: 600;
        text-align: left;
        white-space: nowrap;
        padding-right: 20px; /* gap before values */
        width: auto; /* auto width for labels */
    }

    .totals-summary td:last-of-type {
        text-align: right;
        color: #111827;
        font-weight: 600;
        white-space: nowrap; /* keep on one line */
        padding-left: 0;
        padding-right: 0; /* no right padding needed */
        width: auto; /* auto width for values */
        overflow: visible; /* ensure nothing is hidden */
    }

    .totals-summary__accent td {
        background: #f3f4f6;
        font-weight: 700;
    }
</style>
</head>

<body>
    <div class="invoice-preview-main" id="boxes">
        <div class="invoice-header" style="border-top: 15px solid var(--theme-color); background: #f8f8f8;">
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 20%;">
                            <img class="invoice-logo" src="{{ $img }}" alt="">
                        </td>
                        <td style="width: 80%; padding: 10px 20px; text-align: right; overflow: visible; padding-right: 60px;">
                            <h3
                                style="text-transform: uppercase; font-size: 40px; font-weight: bold; color: {{ $color }}; margin: 0; word-wrap: break-word; overflow: visible;">
                                {{ __('INVOICE') }}</h3>
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
                                        <td>{{ \App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id, $invoice->created_by, $invoice->workspace) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Date') }}:</strong></td>
                                        <td>{{ company_date_formate($invoice->issue_date, $invoice->created_by, $invoice->workspace) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Échéance') }}:</strong></td>
                                        <td>{{ company_date_formate($invoice->due_date, $invoice->created_by, $invoice->workspace) }}</td>
                                    </tr>
                                    @if (!empty($customFields) && count($invoice->customField) > 0)
                                        @foreach ($customFields as $field)
                                            <tr>
                                                <td><strong>{{ $field->name }}:</strong></td>
                                                <td style="white-space: normal;">
                                                    @if ($field->type == 'attachment')
                                                        <a href="{{ get_file($invoice->customField[$field->id]) }}" target="_blank">
                                                            <img src=" {{ get_file($invoice->customField[$field->id]) }} " class="wid-75 rounded me-3">
                                                        </a>
                                                    @else
                                                        {{ !empty($invoice->customField[$field->id]) ? $invoice->customField[$field->id] : '-' }}
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
                                @if($invoice->invoice_module != 'Fleet')
                                    <p style="margin: 0;">
                                        <strong style="font-size: 14px;">{{ !empty($customer->billing_name) ? $customer->billing_name : (!empty($customer->name) ? $customer->name : '') }}</strong><br>
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
                                @else
                                    <p style="margin: 0;">
                                        <strong style="font-size: 14px;">{{ $commonCustomer['name'] }}</strong><br>
                                        <strong>{{ __('Email') }}:</strong> {{ $commonCustomer['email'] }}
                                    </p>
                                @endif
                            </div>
                            @if (isset($settings['invoice_qr_display']) && $settings['invoice_qr_display'] == 'on')
                                @if (module_is_active('Zatca',$invoice->created_by))
                                    <div class="view-qrcode" style="margin-top: 10px;">
                                        @include('zatca::zatca_qr_code', [
                                            'invoice_id' => $invoice->invoice_id,
                                        ])
                                    </div>
                                @else
                                    <div class="view-qrcode" style="margin-top: 10px;">
                                        {!! DNS2D::getBarcodeHTML(
                                            route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice->id)),
                                            'QRCODE',
                                            2,
                                            2,
                                        ) !!}
                                    </div>
                                @endif
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="invoice-body" style="border-bottom: 15px solid var(--theme-color);">
            <table class="add-border invoice-summary items-table" style="margin-top: 30px;">
                <thead style="background-color: var(--theme-color);color: {{ $font_color }};">
                    <tr>
                        @if($invoice->invoice_module != "Fleet")
                            <th>{{ __('Image') }}</th>
                        @endif
                        @if($invoice->invoice_module == "account")
                            <th>{{__('Item Type')}}</th>
                        @endif
                        @if($invoice->invoice_module == "Fleet")
                            <th>{{ __('Distance') }}</th>
                        @endif
                        @if($invoice->invoice_module != "Fleet")
                            <th>{{ __('Item') }}</th>
                            <th>{{ __('Quantity') }}</th>
                        @endif
                        <th>{{ __('Rate') }}</th>
                        @if($invoice->invoice_module == "Fleet")
                            <th>{{ __('Discription') }}</th>
                        @endif
                        @if($invoice->invoice_module != "Fleet")
                            <th>{{ __('Discount') }}</th>
                            <th>{{ __('Tax') }} (%)</th>
                        @endif
                        <th>{{ __('Price') }}<small>{{ __('After discount & tax') }}</small></th>

                    </tr>
                </thead>
                <tbody>
                    @if (isset($invoice->itemData) && count($invoice->itemData) > 0)
                    @foreach ($invoice->itemData as $key => $item)
                    <tr>
                        @if ($invoice->invoice_module != 'Fleet')
                            <td>
                                @php
                                    $product_image = null;
                                    if (!empty($item->product_id)) {
                                        $product = \Workdo\ProductService\Entities\ProductService::find($item->product_id);
                                        if ($product && !empty($product->image)) {
                                            $product_image = get_file($product->image);
                                        }
                                    }
                                @endphp
                                @if($product_image)
                                    <img src="{{ $product_image }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;" alt="Product">
                                @else
                                    <div style="width: 50px; height: 50px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 5px; font-size: 10px;">N/A</div>
                                @endif
                            </td>
                        @endif
                        @if ($invoice->invoice_module == 'account')
                            <td>{{ !empty($item->product_type) ? Str::ucfirst($item->product_type) : '--' }}
                            </td>
                        @endif
                        <td>{{ $item->name }}</td>
                        @if ($invoice->invoice_module != 'Fleet')
                            <td>{{ $item->quantity }}</td>
                        @endif
                        <td>{{ currency_format_with_sym($item->price, $invoice->created_by, $invoice->workspace) }}
                        </td>
                        @if ($invoice->invoice_module == 'Fleet')
                            <th>{{ $item->description }}</th>
                        @endif
                        @if ($invoice->invoice_module != 'Fleet')
                            <td>{{ $item->discount != 0 ? number_format($item->discount, 2) . '%' : '-' }}
                            </td>
                            <td>
                                @if (!empty($item->itemTax))
                                    @foreach ($item->itemTax as $taxes)
                                        <span>{{ $taxes['name'] }} </span><span> ({{ $taxes['rate'] }})
                                        </span>
                                        <span>{{ $taxes['price'] }}</span>
                                    @endforeach
                                @else
                                    <p>-</p>
                                @endif
                            </td>
                        @endif

                        @if ($invoice->invoice_module == 'Fleet')
                            @php
                                $distance = !empty($item->name) ? $item->name : 0;
                                $price = $item->price * $item->name;
                            @endphp
                            <td>{{ currency_format_with_sym($price, $invoice->created_by, $invoice->workspace) }}</td>
                        @else
                            <td>{{ currency_format_with_sym((($item->price * $item->quantity) * (1 - ($item->discount / 100))) + (isset($item->tax_price) ? $item->tax_price : 0), $invoice->created_by, $invoice->workspace) }}
                            </td>
                        @endif
                        @if ($invoice->invoice_module != 'Fleet')
                            @if ($item->description != null)
                                <tr class="border-0 itm-description ">
                                    <td colspan="6">{{ $item->description }} </td>
                                </tr>
                            @endif
                        @endif
                @endforeach
                @else
                    <tr>
                        @if($invoice->invoice_module != "Fleet")
                            <td>-</td>
                        @endif
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <p>-</p>
                            <p>-</p>
                        </td>
                        <td>-</td>
                        <td>-</td>
                    <tr class="border-0 itm-description ">
                        <td colspan="7">-</td>
                    </tr>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        @if($invoice->invoice_module != "Fleet")
                            <td></td>
                        @endif
                        @if($invoice->invoice_module == "account")
                            <td></td>
                        @endif
                        <td>{{ __('Total') }}</td>
                        @if ($invoice->invoice_module == 'Fleet')
                            <td><b>{{ currency_format_with_sym($invoice->totalRate, $invoice->created_by, $invoice->workspace) }}</b>
                            </td>
                            <td></td>
                        @else
                            <td>{{ $invoice->totalQuantity }}</td>

                            <td>{{ currency_format_with_sym($invoice->totalRate, $invoice->created_by, $invoice->workspace) }}
                            </td>
                            <td>{{ currency_format_with_sym($invoice->getTotalDiscount(), $invoice->created_by, $invoice->workspace) }}
                            </td>
                            <td>{{ currency_format_with_sym($invoice->totalTaxPrice, $invoice->created_by, $invoice->workspace) }}
                            </td>
                            <td>{{ currency_format_with_sym($invoice->getSubTotal(), $invoice->created_by, $invoice->workspace) }}
                            </td>
                        @endif
                    </tr>
                </tfoot>
            </table>

            <!-- Summary Section - Outside items table for full width -->
            @php
                // Compute totals similar to proposal summary
                $subtotal = $invoice->getSubTotal();
                $discount = $invoice->getTotalDiscount();
                $netHT = $subtotal - $discount;
                $taxTotal = $invoice->getTotalTax();
                $netTTC = $netHT + $taxTotal;
                $dueAmount = $invoice->getDue();
            @endphp
            <div class="totals-section-wrapper">
                <table class="totals-summary">
                    <tr>
                        <td>{{ __('TOTAL HT') }} :</td>
                        <td>{{ currency_format_with_sym($subtotal, $invoice->created_by, $invoice->workspace) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Remise') }} :</td>
                        <td>{{ currency_format_with_sym($discount, $invoice->created_by, $invoice->workspace) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Total NET HT') }} :</td>
                        <td>{{ currency_format_with_sym($netHT, $invoice->created_by, $invoice->workspace) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('TVA') }} :</td>
                        <td>{{ currency_format_with_sym($taxTotal, $invoice->created_by, $invoice->workspace) }}</td>
                    </tr>
                    <tr class="totals-summary__accent">
                        <td>{{ __('Montant NET TTC') }} :</td>
                        <td>{{ currency_format_with_sym($netTTC, $invoice->created_by, $invoice->workspace) }}</td>
                    </tr>
                </table>
            </div>
            <!--<table class="add-border bank-details" style="margin-top: 30px;">-->
            <!--    <thead style="background-color: var(--theme-color);color: {{ $font_color }};">-->
            <!--        <tr>-->
            <!--            <th>{{__('Name')}}</th>-->
            <!--            <th>{{ __('Bank') }}</th>-->
            <!--            <th>{{ __('Account Number') }}</th>-->
            <!--            <th>{{ __('Current Balance') }}</th>-->
            <!--            <th>{{ __('Contact Number') }}</th>-->
            <!--            <th>{{ __('Bank Address') }}</th>-->
            <!--        </tr>-->
            <!--    </thead>-->
            <!--    <tbody>-->
            <!--        @if (isset($bank_details_list) && count($bank_details_list) > 0)-->
            <!--            @foreach ($bank_details_list as $key => $bank)-->
            <!--                <tr>-->
            <!--                    <td>{{ $bank->holder_name }}</td>-->
            <!--                    <td>{{ $bank->bank_name }}</td>-->
            <!--                    <td>{{ $bank->account_number }}</td>-->
            <!--                    <td>{{ !empty($bank->opening_balance) ? currency_format_with_sym($bank->opening_balance, $invoice->created_by, $invoice->workspace) : '' }}</td>-->
            <!--                    <td>{{ $bank->contact_number }}</td>-->
            <!--                    <td>{{ $bank->bank_address }}</td>-->
            <!--                </tr>-->
            <!--            @endforeach-->
            <!--        @else-->
            <!--            <tr>-->
            <!--                <td>-</td>-->
            <!--                <td>-</td>-->
            <!--                <td>-</td>-->
            <!--                <td>-</td>-->
            <!--                <td>-</td>-->
            <!--                <td>-</td>-->
            <!--            </tr>-->
            <!--        @endif-->
            <!--    </tbody>-->
            <!--</table>-->
            <div class="invoice-footer">
                @if(!empty($settings['footer_title']) || !empty($settings['footer_notes']))
                    <p> 
                        @if(!empty($settings['footer_title']))
                            {{ $settings['footer_title'] }} <br>
                        @endif
                        @if(!empty($settings['footer_notes']))
                            {{ $settings['footer_notes'] }}
                        @endif
                    </p>
                @endif
            </div>
        </div>
    </div>
    @if(!empty($settings['footer_text']))
    <!-- Fixed footer outside main wrapper; actual repeating is handled in invoice.script -->
    <div class="footer-legal-text" style="background: #f8f8f8; padding: 15px 20px; text-align: center; font-size: 10px; line-height: 1.6; color: #333; border-top: 2px solid #ddd;">
        {!! nl2br(e($settings['footer_text'])) !!}
    </div>
    @endif
    @if (!isset($preview))
        @include('invoice.script')
    @endif
</body>

</html>

