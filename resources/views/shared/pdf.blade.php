<style>
    .pdf {
        line-height: 1.4;
        color: #1d1e1c;
        font-family: Helvetica Neue, Helvetica, Arial, Verdana, Nimbus Sans L, sans-serif;
        font-size: .75em;
    }

    .pdf strong {
        color: #1d1e1c;
    }

    .pdf h1, .pdf h2, .pdf h3, .pdf h4, .pdf h5, .pdf h6 {
        margin: 0;
        line-height: 1.2;
    }

    .pdf h1 {
        font-size: 3em;
        font-weight: 700;
        line-height: 1.1;
    }

    .pdf h2 {
        font-size: 1.2em;
        font-weight: 550;
    }

    .pdf p {
        margin: 0;
    }

    .invoice-header td {
        width: 30px;
    }

    .invoice-header th {
        white-space: nowrap;
        color: #616261;
        font-weight: normal;
        text-align: right;
        padding: 4px 8px;
        border-right: 1px solid #bbb;
    }

    .invoice-header th + td {
        padding-left: 8px;
    }

    .invoice-info td {
        padding: 4px 8px;
    }

    .invoice-info th {
        color: #616261;
        font-weight: normal;
        text-align: right;
        padding: 4px 8px;
    }

    .invoice-info td {
        border-left: 1px solid #bbb;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-table td, .invoice-table th {
        text-align: right;
        border: 1px solid #bbb;
        padding: 8px;
    }

    .invoice-table th {
        font-weight: 700;
        padding: 4px 8px;
        border-top: none;
    }

    .invoice-table th:first-child, .invoice-table td:first-child {
        text-align: left;
        border-left: none;
    }

    .invoice-table th:last-child, .invoice-table td:last-child {
        border-right: none;
    }

    .invoice-table tr:nth-child(2n) {
        background: #f6f6f6;
    }

    .invoice-table tfoot td {
        border: none;
        padding: 4px 0;
    }

    .invoice-table tfoot td:first-child {
        text-align: right;
        color: #616261;
    }

    .invoice-table tfoot tr {
        background: transparent !important;
    }

    .invoice-table tfoot tr:first-child td {
        padding-top: 10px;
    }

    .invoice-table tfoot tr:last-child {
        font-size: 1.3em;
    }

    .invoice-table tfoot tr:last-child td {
        padding-top: 13px;
    }

    .spacer {
        height: 30px;
    }
</style>
<table style="width: 100%; height: 100px; border-collapse: collapse" class="invoice-header">
    <tr>
        <td colspan="2" style="vertical-align: top;">
            <h1>{{ __('pdf.estimate') }} {{ $estimate->estimate_id }}</h1>
        </td>
        <th style=" vertical-align: top;">{{ __('pdf.from') }}</th>
        <td style="white-space: nowrap;">
            <h2>EURL Boyer Jonathan</h2>
            <p style="margin-top: 5px;">
                Lorem ipsum dolor sit<br/>
                amet, consectetur adipisicing elit<br/>
                A cumque delectus, deleniti<br/>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="spacer"></td>
    </tr>
    <tr>
        <th rowspan="2" style="width: 30px; vertical-align: top;">{{ __('pdf.to') }}</th>
        <td rowspan="2" style="width: 200px;">
            <h2>{{ $estimate->client->name }}</h2>
            <p style="margin-top: 5px;">
                {!! nl2br($estimate->client->address) !!}
            </p></td>
        <th>{{ __('pdf.estimate_id') }}</th>
        <td style="width: 200px;">
            <strong>{{ $estimate->estimate_id }}</strong>
        </td>
    </tr>
    <tr>
        <th>{{ __('pdf.created_at') }}</th>
        <td>
            <strong>{{ $estimate->created_at->format(config('i18n.date_format')) }}</strong>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="spacer"></td>
    </tr>
    <tr>
        <th style=" vertical-align: top;">{{ __('pdf.label') }}</th>
        <td colspan="3">{{ $estimate->label }}</td>
    </tr>
</table>

<div class="spacer"></div>

<table class="invoice-table">
    <thead>
    <tr>
        <th>{{ __('pdf.label') }}</th>
        <th style="width: 50px;">{{ __('pdf.quantity') }}</th>
        <th style="width: 75px;">{{ __('pdf.unit_price') }}</th>
        <th style="width: 75px;">{{ __('pdf.total') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($estimate->rows as $row)
        <tr>
            <td>{{ $row->label }}</td>
            <td>{{ $row->quantity }}</td>
            <td>@money($row->price, $estimate->currency)</td>
            <td>
                <strong>@money($row->total, $estimate->currency)</strong>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3">{{ __('pdf.subtotal') }}</td>
        <td><strong>@money($estimate->total_price, $estimate->currency)</strong></td>
    </tr>
    <tr>
        <td colspan="3">{{ __('pdf.subtotal') }}</td>
        <td>
            <strong>@money($estimate->total_tax, $estimate->currency)</strong>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <strong>{{ __('pdf.total') }}</strong>
        </td>
        <td>
            <strong>@money($estimate->total)</strong>
        </td>
    </tr>
    </tfoot>
</table>

<div class="spacer"></div>

<footer>
    <p style="font-size: .8em;">
        {{ $estimate->footer }}
    </p>
</footer>
