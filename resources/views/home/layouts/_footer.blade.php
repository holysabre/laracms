<footer class="footer">
    <div class="layui-container">
        <p><a href="mailto:{{ config('website.email') }}">联系我们 E-mail:{{ config('website.email') }}</a></p>
    </div>
</footer>

@section('script')

    <script>
        //注意：导航 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
            var element = layui.element;

            //…
        });
    </script>

@endsection