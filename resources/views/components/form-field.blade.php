@props(['field', 'prefix' => ''])

<div class="row mb-3">
    @foreach ($field['columns'] as $column)
        <div class="col-{{ $column['size'] }}">
            <label for="{{ $prefix }}_{{ $column['name'] }}" class="form-label">
                {{ $column['label'] }}
                @if ($column['required'] ?? false) * @endif
            </label>
            
            @if ($column['type'] === 'select')
                <select class="form-select" 
                        id="{{ $prefix }}_{{ $column['name'] }}" 
                        name="{{ $column['name'] }}"
                        {{ ($column['required'] ?? false) ? 'required' : '' }}>
                    <option value="">{{ $column['placeholder'] ?? 'Seleccione...' }}</option>
                    @foreach ($column['options'] as $value => $text)
                        <option value="{{ $value }}">{{ $text }}</option>
                    @endforeach
                </select>
            @elseif ($column['type'] === 'textarea')
                <textarea class="form-control" 
                          id="{{ $prefix }}_{{ $column['name'] }}" 
                          name="{{ $column['name'] }}"
                          rows="{{ $column['rows'] ?? 3 }}"
                          placeholder="{{ $column['placeholder'] ?? '' }}"></textarea>
            @elseif ($column['type'] === 'number')
                <div class="input-group">
                    @if (isset($column['prefix']))
                        <span class="input-group-text">{{ $column['prefix'] }}</span>
                    @endif
                    <input type="number" 
                           class="form-control" 
                           id="{{ $prefix }}_{{ $column['name'] }}" 
                           name="{{ $column['name'] }}"
                           step="{{ $column['step'] ?? '0.01' }}"
                           min="{{ $column['min'] ?? '0' }}"
                           value="{{ $column['default'] ?? '' }}"
                           placeholder="{{ $column['placeholder'] ?? '' }}"
                           {{ ($column['required'] ?? false) ? 'required' : '' }}>
                </div>
            @else
                <input type="{{ $column['type'] }}" 
                       class="form-control" 
                       id="{{ $prefix }}_{{ $column['name'] }}" 
                       name="{{ $column['name'] }}"
                       placeholder="{{ $column['placeholder'] ?? '' }}"
                       {{ ($column['required'] ?? false) ? 'required' : '' }}>
            @endif
        </div>
    @endforeach
</div>