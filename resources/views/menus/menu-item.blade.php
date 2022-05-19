@if ($menu["submenu"] == [])
    <li class="dd-item dd3-item" data-id="{{$menu['id']}}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content {{$menu['url_menu'] == 'javascript:;' ? 'font-weight-bold' : ''}}">
            <a href="{{ route('menus.edit', $menu['id']) }}">{{$menu["name_menu"] . " | Url -> " . $menu["url_menu"]}} Icono -> <i style="font-size:20px;" class="{{isset($menu['icon_menu']) ? $menu['icon_menu'] : ''}}"></i></a>
        </div>
    </li>
@else
    <li class="dd-item dd3-item" data-id="{{$menu['id']}}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content {{$menu['url_menu'] == 'javascript:;' ? 'font-weight-bold' : ''}}">
            <a href="{{ route('menus.edit', $menu['id']) }}">{{ $menu["name_menu"] . " | Url -> " . $menu["url_menu"]}} Icono -> <i style="font-size:20px;" class="{{isset($menu['icon_menu']) ? $menu['icon_menu'] : ''}}"></i></a>
        </div>
        <ol class="dd-list">
            @foreach ($menu["submenu"] as $submenu)
                @include("menus.menu-item",[ "menu" => $submenu ])
            @endforeach
        </ol>
    </li>
@endif