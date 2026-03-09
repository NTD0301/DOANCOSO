@extends('layouts.public')

@section('title', 'Danh sách sản phẩm')

@section('content')
<section class="section-block">

    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Tìm kiếm</div>
                <div class="card-body">
                    <form method="GET">
                        <input type="text" name="q" class="form-control mb-2" placeholder="Tên sản phẩm..." value="{{ request('q') }}">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <button class="btn btn-primary w-100">Lọc</button>
                    </form>
                </div>
            </div>
            
            <!--danh mục-->
            <div class="card mt-3 shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span class="fw-semibold">
                        <i class="bi bi-list-ul me-1"></i> Danh mục sản phẩm
                    </span>
            
                    {{-- nút xổ ra / thu lại cả cây --}}
                    <button class="btn btn-sm btn-outline-secondary"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#categoryTree"
                            aria-expanded="true"
                            aria-controls="categoryTree">
                        <i class="bi bi-chevron-up"></i>
                    </button>
                </div>
            
                {{-- collapse bọc toàn bộ cây --}}
                <div class="collapse show" id="categoryTree">
                    <div class="card-body p-2">
            
                        @php
                            $renderTree = function($nodes, $level = 0) use (&$renderTree) {
                                $isRoot = $level === 0;
                                $indentClass = $isRoot ? '' : 'ps-3 border-start border-2 border-light';
            
                                echo '<ul class="list-unstyled mb-0 '.$indentClass.'">';
            
                                foreach ($nodes as $node) {
                                    $isActive = request('category') === $node->slug;
                                    $hasChildren = $node->children->isNotEmpty();
            
                                    $url = route('products.index', array_filter(array_merge(
                                        request()->only('q'),
                                        ['category' => $node->slug]
                                    )));
            
                                    echo '<li class="mb-1">';
            
                                    echo '<a href="'.$url.'" class="d-flex align-items-center justify-content-between rounded px-2 py-1 text-decoration-none ';
                                    echo $isActive ? 'bg-primary text-white fw-semibold' : 'text-body';
                                    echo '">';
            
                                        // trái: icon + tên
                                        echo '<span class="d-inline-flex align-items-center gap-2">';
                                            echo '<i class="bi '.($isRoot ? 'bi-folder' : 'bi-folder2-open').' small"></i>';
                                            echo '<span class="small">'.e($node->name).'</span>';
                                        echo '</span>';
            
                                        // phải: badge số con + chevron nếu có children
                                        if ($hasChildren) {
                                            echo '<span class="d-inline-flex align-items-center gap-1 small ';
                                            echo $isActive ? 'text-white-50' : 'text-muted';
                                            echo '">';
                                                echo '<span class="badge bg-light text-muted border">'.$node->children->count().'</span>';
                                                echo '<i class="bi bi-chevron-right small"></i>';
                                            echo '</span>';
                                        }
            
                                    echo '</a>';
            
                                    if ($hasChildren) {
                                        $renderTree($node->children, $level + 1);
                                    }
            
                                    echo '</li>';
                                }
            
                                echo '</ul>';
                            };
                        @endphp
            
                        @if($categories->isEmpty())
                            <p class="text-muted small mb-0">Chưa có danh mục.</p>
                        @else
                            {{-- Mục "Tất cả" luôn ở trên cùng --}}
                            @php
                                $isAllActive = !request()->filled('category');
                                $allUrl = route('products.index', array_filter(request()->only('q')));
                            @endphp
            
                            <ul class="list-unstyled mb-1">
                                <li class="mb-1">
                                    <a href="{{ $allUrl }}"
                                       class="d-block rounded px-2 py-1 text-decoration-none {{ $isAllActive ? 'bg-primary text-white fw-semibold' : 'text-body' }}">
                                        <i class="bi bi-grid-fill small me-1"></i>
                                        <span class="small">Tất cả</span>
                                    </a>
                                </li>
                            </ul>
            
                            {{-- phần cây danh mục còn lại --}}
                            @php $renderTree($categories); @endphp
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-9">
              <div class="row g-2 g-md-3">
                @forelse($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                      <x-public.product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12">
                      <div class="empty-state">Chưa có sản phẩm nổi bật.</div>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</section
@endsection
