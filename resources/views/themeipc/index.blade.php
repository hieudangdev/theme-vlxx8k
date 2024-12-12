@extends('themes::themeipc.layout')

@php
    use Kho8k\Core\Models\Movie;

    $recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('is_recommended', true)
            ->limit(get_theme_option('recommendations_limit', 10))
            ->orderBy('updated_at', 'desc')
            ->get();
    });

    $data = Cache::remember('site.movies.latest' . request('page', 1), setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $limit, $link] = array_merge($list, [
                    'Phim mới cập nhật',
                    '',
                    'type',
                    'series',
                    8,
                    '/',
                ]);
                try {
                    $data[] = [
                        'label' => $label,
                        'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })

                            ->orderBy('updated_at', 'desc')
                            ->paginate($limit),
                        'link' => $link ?: '#',
                    ];
                } catch (\Exception $e) {
                }
            }
        }
        return $data;
    });
@endphp

@section('content')
    <div class="content right normal">
        {{-- @include('themes::themeipc.inc.slider_recommended') --}}
        @foreach ($data as $item)
            <header>
                <h1>{{ $item['label'] }}</h1>
            </header>
            <div class="video-list normal">
                @foreach ($item['data'] as $movie)
                    @include('themes::themeipc.inc.movie_card')
                @endforeach
            </div>
            {{ $item['data']->appends(request()->all())->links('themes::themeipc.inc.pagination') }}
        @endforeach
    </div>
@endsection
