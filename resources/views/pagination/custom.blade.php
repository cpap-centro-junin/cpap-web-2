{{-- ============================================
     PAGINACIÓN ULTRA PROFESIONAL - BIBLIOTECA CPAP
     Diseño: Enterprise Level | Clean & Modern
     ============================================ --}}
<div class="ultra-pagination-wrapper">
    @if ($paginator->hasPages())
        {{-- Barra Superior - Info Stats --}}
        <div class="pagination-top-bar">
            <div class="pagination-info-card">
                <div class="info-icon">
                    <i class="fas fa-books"></i>
                </div>
                <div class="info-text">
                    <span class="info-label">Mostrando</span>
                    <span class="info-numbers">
                        {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}
                        <span class="of-text">de</span>
                        {{ $paginator->total() }}
                    </span>
                </div>
            </div>
            <div class="pagination-page-indicator">
                <span class="page-badge">Página {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}</span>
            </div>
        </div>

        {{-- Navegación Principal --}}
        <div class="pagination-navigation">
            {{-- ========== BOTÓN ANTERIOR ========== --}}
            @if ($paginator->onFirstPage())
                <button class="nav-btn nav-btn-prev disabled" disabled aria-label="Primera página">
                    <div class="btn-inner">
                        <div class="btn-icon">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="btn-text">
                            <span class="btn-main">Anterior</span>
                            <span class="btn-sub">Primera página</span>
                        </div>
                    </div>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="nav-btn nav-btn-prev"
                   aria-label="Ir a página {{ $paginator->currentPage() - 1 }}">
                    <div class="btn-inner">
                        <div class="btn-icon">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="btn-text">
                            <span class="btn-main">Anterior</span>
                            <span class="btn-sub">Página {{ $paginator->currentPage() - 1 }}</span>
                        </div>
                    </div>
                </a>
            @endif

            {{-- ========== NÚMEROS DE PÁGINA ========== --}}
            <div class="page-numbers" role="navigation" aria-label="Paginación">
                @foreach ($elements as $element)
                    {{-- Puntos suspensivos --}}
                    @if (is_string($element))
                        <span class="page-dots" aria-hidden="true">
                            <i class="fas fa-ellipsis-h"></i>
                        </span>
                    @endif

                    {{-- Números de página --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-num active" aria-current="page" aria-label="Página actual, página {{ $page }}">
                                    <span class="num-inner">{{ $page }}</span>
                                    <span class="active-glow" aria-hidden="true"></span>
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="page-num"
                                   aria-label="Ir a página {{ $page }}">
                                    <span class="num-inner">{{ $page }}</span>
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- ========== BOTÓN SIGUIENTE ========== --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="nav-btn nav-btn-next"
                   aria-label="Ir a página {{ $paginator->currentPage() + 1 }}">
                    <div class="btn-inner">
                        <div class="btn-text">
                            <span class="btn-main">Siguiente</span>
                            <span class="btn-sub">Página {{ $paginator->currentPage() + 1 }}</span>
                        </div>
                        <div class="btn-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </a>
            @else
                <button class="nav-btn nav-btn-next disabled" disabled aria-label="Última página">
                    <div class="btn-inner">
                        <div class="btn-text">
                            <span class="btn-main">Siguiente</span>
                            <span class="btn-sub">Última página</span>
                        </div>
                        <div class="btn-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </button>
            @endif
        </div>
    @endif
</div>
