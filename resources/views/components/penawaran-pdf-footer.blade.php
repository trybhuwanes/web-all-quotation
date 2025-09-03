<!-- Footer -->
<div class="footer">
    <div class="text-end pe-6">
        <span>Page | {{ $page }}</span>
    </div>
    <div class="text-center">
        <span>ALL RIGHT RESERVED</span>
    </div>
    <div class="text-center text-uppercase">
        THIS DOCUMENT WAS PREPARED FOR THE EXCLUSIVE USE OF
        <span class="highlight text-uppercase">
            @if ($orderfind->shipping->company_destination)
                @if ($orderfind->shipping->company_destination !== $orderfind->user->company)
                    {{ $orderfind->user->company }}, {{ $orderfind->shipping->company_destination }},
                @else
                    {{ $orderfind->user->company }}
                @endif
            @else
                {{ $orderfind->user->company }}
            @endif
        </span>
        AND<span> PT GUNA HIJAU INOVASI</span>
        PURSUANT TO THE EQUIPMENT MANUFACTURING. THIS DOCUMENT IS THE PROPERTY OF<span> PT GUNA HIJAU INOVASI</span> AND IS STRICTLY CONFIDENTIAL. ANY UNAUTHORIZED USE, REPRODUCTION, OR DISTRIBUTION OF THIS DOCUMENT, IN WHOLE OR IN PART, IS STRICTLY PROHIBITED WITHOUT PRIOR WRITTEN CONSENT FROM<span> PT GUNA HIJAU INOVASI</span>.
    </div>
</div>
<!-- End Footer -->