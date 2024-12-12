@php
    $watch_url = '';
    if (!$movie->is_copyright && count($movie->episodes) && $movie->episodes[0]['link'] != '') {
        $watch_url = $movie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
@endphp
<div id="post-{{ $movie->id }}" class="video-item">
    <a title="{{ $movie->name }}"  href="{{ $watch_url }}">
        <img class="video-image lazyload" src="{{ $movie->getThumbUrl() }}" data-original="{{ $movie->getThumbUrl() }}" width="240px" height="180px" alt="{{ $movie->name }}" style="">
        <div class="ribbon">{{ $movie->language ??'HD' }}</div>
    </a>
    <div class="video-name">
        <a title="{{ $movie->name }}" href="{{ $watch_url }}">{{ $movie->name }}</a>
    </div>
</div>
