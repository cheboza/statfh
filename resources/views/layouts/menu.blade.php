<nav class="nav flex-column nav-pills">
    @foreach($menu as $node)
        <a class="nav-item nav-link @if(request()->path() === $node["link"]) active @endif" href="{{$node["link"]}}">{{$node["name"]}}</a>
    @endforeach
</nav>