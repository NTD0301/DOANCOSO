@props(['links' => []])

<div class="breadcrumb-wrapper mt-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                @foreach ($links as $link)
                    @if (!$loop->last && isset($link['url']))
                        <li class="breadcrumb-item">
                            <a href="{{ $link['url'] }}" class="text-decoration-none">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $link['label'] }}
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</div>
