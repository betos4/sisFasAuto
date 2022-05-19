@if ($item["submenu"] == [])
    <a class="collapse-item" href="{{url($item['url_menu'])}}">{{$item["name_menu"]}}</a>
@else
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{$item['id']}}" aria-expanded="true" aria-controls="collapse{{$item['id']}}">
            <i class="{{$item['icon_menu']}}"></i>
            <span>{{$item["name_menu"]}}</span>
        </a>

        <div id="collapse{{$item['id']}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                @foreach ($item["submenu"] as $submenu)
                    @include("layouts.menu-item", ["item" => $submenu])
                @endforeach
            </div>
        </div>
    </li>
@endif
