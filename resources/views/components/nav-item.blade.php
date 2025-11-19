@props(['item'])

@if ($item['type'] === 'link')
    <a class="nav-link {{ request()->routeIs($item['route_pattern']) ? 'active' : '' }}" 
       href="{{ route($item['route']) }}">
        <i class="{{ $item['icon'] }}"></i>
        {{ $item['title'] }}
    </a>
@elseif ($item['type'] === 'modal')
    <a class="nav-link" href="#" onclick="{{ $item['onclick'] }}" 
       data-bs-toggle="tooltip" title="{{ $item['tooltip'] ?? '' }}">
        <i class="{{ $item['icon'] }}"></i>
        {{ $item['title'] }}
    </a>
@endif