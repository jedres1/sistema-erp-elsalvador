@props(['section'])

<div class="nav-section-header">
    <h6 class="text-light text-uppercase fw-bold mb-3 nav-section-toggle" 
        onclick="toggleSection('{{ $section['id'] }}')">
        <i class="{{ $section['icon'] }}"></i> {{ $section['title'] }}
        <i class="fas fa-chevron-down toggle-icon" id="{{ $section['id'] }}-icon"></i>
    </h6>
</div>

<div id="{{ $section['id'] }}-items" class="nav-section-items">
    @foreach ($section['items'] as $item)
        <x-nav-item :item="$item" />
    @endforeach
</div>

@if (!$loop->last)
    <hr class="nav-divider">
@endif