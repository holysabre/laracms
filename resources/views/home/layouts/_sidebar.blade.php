@php $top_id = getTopId($category_list,$current);@endphp
<nav class="sidebar">
    <span class="sidebar-theme">{!! $category_list[$current]['name'] !!}</span>
    @isset($category_tree[$top_id])
    <ul>
        @foreach($category_tree[$top_id]['son'] as $item)
        <li {!! isset($item['son']) ? ' class="sub-menu"' : '' !!}>
            <a href="">{{ $item['name'] }}</a>
            @isset($item['son'])
            <ul>
                @foreach($item['son'] as $son)
                <li {!! isset($son['son']) ? ' class="sub-menu"' : '' !!}>
                    <a href="">{{ $son['name'] }}</a>
                    @isset($son['son'])
                    <ul>
                        @foreach($son['son'] as $grand_son)
                        <li>
                            <a href="">{{ $grand_son['name'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endisset
                </li>
                @endforeach
            </ul>
            @endisset
        </li>
        @endforeach
    </ul>
    @endisset
</nav>