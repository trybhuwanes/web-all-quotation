<!-- Header -->
<div class="header mt-5">
    <table class="table table-bordered">
        <tr>
            <td class="align-middle text-center no-border-right" rowspan="2" class="p-5">
                <x-app-logo alt="Logo" class="h-30px mb-4"></x-app-logo>
            </td>
            <td class="align-middle no-border-left" rowspan="2">
                <div class="company-name">
                    PT GUNA HIJAU INOVASI
                </div>
                <div class="sub-title">
                    Water &amp; Wastewater Management
                </div>
            </td>

            <td class="text-end">
                Document No.
            </td>
            <td>
                {{ str_replace('-', '/', $orderfind->trx_code) }}
            </td>
        </tr>

        <tr>
            <td class="text-end">
                Revision No.
            </td>
            <td>
                {{$orderfind->revisiquotation->sortByDesc('revision_number')->first()->revision_number}}
            </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="2" class="p-5">
                Owner: </br> {{$orderfind->user->company}}
            </td>
            <td class="text-end">
                Page
            </td>
            <td>
                {{ $page }} of <span> {{ $countpage }} </span>
            </td>
        </tr>
        <tr>
            <td class="text-end">
                Issue Date
            </td>
            <td>
                {{  App\Helpers\Helper::dateFormat(now(), 'd F Y') }}
            </td>
        </tr>
    </table>
</div>
<!-- End Header -->