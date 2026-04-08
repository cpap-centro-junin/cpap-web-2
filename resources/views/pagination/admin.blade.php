{{-- ============================================
     PAGINACIÓN ADMIN - MODERNA Y PROFESIONAL
     Diseño: Línea Única Responsive
     ============================================ --}}

<div class="admin-pagination-wrapper">
    <div class="admin-pagination-container">
        
        {{-- FILA ÚNICA: Info + Selector + Controles --}}
        <div class="pagination-single-row">
            
            {{-- INFORMACIÓN --}}
            <div class="pagination-stats">
                <span class="stat-label">Mostrando</span>
                <span class="stat-value">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span>
                <span class="stat-label">de</span>
                <span class="stat-total">{{ $paginator->total() }}</span>
                <span class="stat-label">resultados</span>
            </div>

            {{-- SELECTOR DE ITEMS POR PÁGINA --}}
            <div class="pagination-perpage-selector-inline">
                <form id="perpage-form" method="GET" class="inline-form">
                    @foreach(request()->query() as $key => $value)
                        @if($key !== 'perpage')
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                    
                    <select name="perpage" class="perpage-select-inline" onchange="document.getElementById('perpage-form').submit();" aria-label="Items por página">
                        @php
                            $currentPerPage = (int) (request('perpage') ?? session('pagination_perpage') ?? $paginator->perPage());
                            $options = [10, 20, 50, 100];
                        @endphp
                        
                        @foreach($options as $option)
                            <option value="{{ $option }}" @selected($currentPerPage == $option)>{{ $option }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            {{-- PÁGINA ACTUAL --}}
            <div class="pagination-page-info-inline">
                Página {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
            </div>

            {{-- CONTROLES DE NAVEGACIÓN --}}
            <div class="pagination-controls-inline">
                
                {{-- ANTERIOR --}}
                @if ($paginator->onFirstPage())
                    <button class="pagination-btn-inline pagination-btn-prev disabled" disabled aria-label="Página anterior deshabilitada">
                        <i class="fas fa-chevron-left"></i><span>Anterior</span>
                    </button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn-inline pagination-btn-prev" aria-label="Página anterior">
                        <i class="fas fa-chevron-left"></i><span>Anterior</span>
                    </a>
                @endif

                {{-- NÚMEROS --}}
                <div class="pagination-numbers-inline" role="navigation" aria-label="Paginación">
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="page-ellipsis-inline">…</span>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="page-number-inline active" aria-current="page">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-number-inline">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

                {{-- SIGUIENTE --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn-inline pagination-btn-next" aria-label="Página siguiente">
                        <span>Siguiente</span><i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <button class="pagination-btn-inline pagination-btn-next disabled" disabled aria-label="Siguiente deshabilitado">
                        <span>Siguiente</span><i class="fas fa-chevron-right"></i>
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>