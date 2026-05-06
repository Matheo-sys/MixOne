@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    @php
        $logoUrl = asset('media/images/logo_droit_black.png');
        if (str_contains($logoUrl, 'localhost')) {
            $logoUrl = 'https://raw.githubusercontent.com/Matheo-sys/MixOne/dev/mixoneDB/public/media/images/logo_droit_black.png';
        }
    @endphp
    <img src="{{ $logoUrl }}" class="logo" alt="MixOne Logo" style="height: 60px; width: auto; max-width: 100%; border: none;">
</a>
</td>
</tr>
