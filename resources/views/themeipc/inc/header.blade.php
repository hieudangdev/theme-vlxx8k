@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<header id="header-main" class="main-header">
    <div class="hbox">
        <div class="fix-hidden">
            <div class="logo">
                <a href="/" title="{{ $title }}">
                    @if ($logo)
                        {!! $logo !!}
                    @else
                        {!! $brand !!}
                    @endif
                </a>

            </div>
            <div class="headitems-search ">
                <div id="advc-menu" class="search-menu">
                    <form method="get" id="searchform" action="/">
                        <input type="text" placeholder="Tìm kiếm phim..." name="search" value="" autocomplete="off">
                        <button class="search-button" form="searchform" type="submit"><span class="fas fa-search"></span></button>
                    </form>
                </div>
            </div>
        <div class="headitems">
            <div id="advc-menu" class="advc-menu">
                <form method="get" id="searchform" class="search" action="/">
                    <span class="icon-search"></span>
                    <input type="text" placeholder="Tìm kiếm phim..." name="search"
                        value="{{ request('search') }}" class="searchTxt"autocomplete="off">
                    <button class="searchBtn" form="searchform" type="submit">Tìm kiếm</button>
                </form>

            </div>
        </div>

    </div>
    <div class="head-main-nav">
        <div class="menu-xem-phim-online-container">
            <div id="primary-nav">
            <ul  class="menu">
                @foreach ($menu as $item)
                    @if (count($item['children']))
                                @foreach ($item['children'] as $children)
                                <li><a title="{{ $children['name'] }}" href="{{ $children['link'] }}"><span class="icon icon-views">{{ $children['name'] }}</span></a></li>
                                @endforeach

                    @else
                    <li><a title="{{ $item['name'] }}" href="{{ $item['link'] }}"><span class="icon icon-views">{{ $item['name'] }}</span></a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        </div>
    </div>

    </div>
</header>

<div class="fixheadresp">
    <header class="responsive">
        <div class="nav"><a class="aresp nav-resp"></a></div>

        <div class="logo">
            <a href="/" title="{{ $title }}">
                @if ($logo)
                    {!! $logo !!}
                @else
                    {!! $brand !!}
                @endif
            </a>
        </div>
    </header>
    <div id="arch-menu" class="menuresp">
        <div class="menu">
            <div class="menu-xem-phim-online-container">
                <ul id="main_header" class="resp">
                    @foreach ($menu as $item)
                        @if (count($item['children']))
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                <a>{{ $item['name'] }}</a>
                                <ul class="sub-menu">
                                    @foreach ($item['children'] as $children)
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="{{ $children['link'] }}"
                                                title="{{ $children['name'] }}">{{ $children['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                <a href="{{ $item['link'] }}" title="{{ $item['name'] }}">{{ $item['name'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
