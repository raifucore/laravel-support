<nav>
    <ul class="pagination pagination-sm">
        @foreach($items as $item)
            @if(!$item['current'])
                <li class="page-item" title="{!! $item['title'] !!}">
                    <a class="page-link" href="{{$item['href']}}">{{$item['name']}}</a>
                </li>
            @else
                <li class="page-item active" title="{!! $item['title'] !!}">
                    <a class="page-link" href="javascript: void(0);">{{$item['name']}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
