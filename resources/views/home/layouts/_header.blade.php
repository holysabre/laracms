<nav class="navbar">
    <div class="layui-container">
        <ul class="layui-nav" lay-filter="">
            <li class="layui-nav-item layui-this"><a href="/">网站首页</a></li>

            @foreach($categories as $item)
                <li class="layui-nav-item">
                    <a href="{{ url('home/'.$item['index_template'],['id'=>$item['id']]) }}">{{$item['name']}}</a>
                    @isset($item['son'])
                        <dl class="layui-nav-child"> <!-- 二级菜单 -->
                            @foreach($item['son'] as $son)
                                <dd>
                                    <a href="{{ url('home/'.$son['index_template'],['id'=>$son['id']]) }}">{{$son['name']}}</a>
                                </dd>
                            @endforeach
                        </dl>
                    @endisset
                </li>
            @endforeach


        </ul>
    </div>
</nav>
{{--@php dump($categories) @endphp--}}