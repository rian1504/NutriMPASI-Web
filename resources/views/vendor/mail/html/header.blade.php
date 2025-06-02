@props(['url'])
<tr>
<td class="header">
{{-- <a href="{{ $url }}" style="display: inline-block;"> --}}
@if (trim($slot) === 'NutriMPASI')
{{-- <img src="https://nutrimpasi.site/image/logo.png" class="logo" alt="NutriMPASI Logo"> --}}
<img src="{{ asset('image/logo.png') }}" class="logo" alt="NutriMPASI Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
