<!-- Header -->
<div class="header mt-5">
    <table class="header-table" cellspacing="0" cellpadding="6" >
        <tr>
            <td class="align-middle text-center no-border-right" rowspan="2" class="p-5" style="width: 10%;">
                <div class="h-30px mb-4">
                    <img alt="Logo-Guna-Hijau" src="{{ public_path('./template/assets/media/logos/logo-ghi.webp') }}" class="h-30px w-auto theme-light-show" />
                </div>
            </td>

            <td class="align-middle no-border-left" rowspan="2">
                <div class="company-name">
                    PT GUNA HIJAU INOVASI
                </div>
                <div class="sub-title">
                    Water &amp; Wastewater Management
                </div>
            </td>
            <td style="width: 25%;"><strong>Document No.</strong></td>
            <td style="width: 25%;">{{ str_replace('-', '/', $orderfind->trx_code) }}</td>
        </tr>
        <tr>
            <td><strong>Revision No.</strong></td>
            <td>{{ $orderfind->revisiquotation->sortByDesc('revision_number')->first()->revision_number }}</td>
        </tr>
        <tr>
            <td rowspan="2" colspan="2">
            Owner:
            {{$orderfind->user->company}} <br>
            Shipping to: {{$orderfind->shipping->company_destination}}
            </td>
            <td><strong>Page</strong></td>
            <td>{{ $page }} of <span> {{ $countpage }} </span></td>
        </tr>
        <tr>
            <td><strong>Issue Date</strong></td>
            <td>{{  App\Helpers\Helper::dateFormat(now(), 'd F Y') }}</td>
        </tr>
    </table>
</div>
<!-- End Header -->