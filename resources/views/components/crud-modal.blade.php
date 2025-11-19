@props(['modalId', 'title', 'action', 'fields', 'geografia' => []])

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="{{ $modalId }}Label">
                    <i class="fas fa-truck me-2"></i>
                    {{ $title }}
                </h5>
                <div class="d-flex gap-2">
                    @if (isset($listRoute))
                        <a href="{{ route($listRoute) }}" class="btn btn-outline-light btn-sm" title="Ver lista completa">
                            <i class="fas fa-list"></i>
                        </a>
                    @endif
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form id="{{ $modalId }}Form">
                    @csrf
                    
                    @foreach ($fields as $section => $sectionFields)
                        @if ($section !== 'hidden')
                            <h6 class="text-primary mb-3">
                                <i class="{{ $sectionFields['icon'] }}"></i> {{ $sectionFields['title'] }}
                            </h6>
                        @endif
                        
                        @foreach ($sectionFields['fields'] as $field)
                            <x-form-field :field="$field" :prefix="$modalId" />
                        @endforeach
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="{{ $action }}">
                    <i class="fas fa-save me-1"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>