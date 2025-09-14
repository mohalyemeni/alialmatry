@php
    $current_page = Route::currentRouteName();
@endphp

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.index') }}" class="sidebar-brand">
            {{ __('panel.dashboard') }}

        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <h3 class="h3_mine">{{ __('panel.web_detail') }}</h3>
        <ul class="nav">
            @role(['admin'])
                @foreach ($admin_side_menu as $menu)
                    @if (count($menu->appearedChildren) == 0)
                        <li class="nav-item nav-category {{ $menu->id == getParentShowOf($current_page) ? 'active' : '' }}">
                            <a href="{{ route('admin.' . $menu->as) }}" class="nav-link">
                                <i class="link-icon {{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                                <span class="link-title">{{ __('panel.' . $menu->name) }} </span>
                            </a>
                            {{-- <hr class="sidebar-divider-custom"> --}}
                        </li>
                    @else
                        <li
                            class="nav-item nav-category {{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'active' : '' }}">
                            <a class="nav-link {{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? '' : 'collapsed' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse_{{ $menu->route }}"
                                href="#collapse_{{ $menu->route }}" role="button"
                                aria-expanded="{{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'true' : 'false' }}"
                                aria-controls="collapse_{{ $menu->route }}">
                                <i class="link-icon {{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                                <span class="link-title">{{ $menu->display_name }}</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            @if (count($menu->appearedChildren) > 0)
                                <div class="collapse {{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'show' : '' }}"
                                    id="collapse_{{ $menu->route }}">
                                    <ul class="nav sub-menu">
                                        @foreach ($menu->appearedChildren as $sub_menu)
                                            <li class="nav-item">
                                                <a href="{{ route('admin.' . $sub_menu->as) }}"
                                                    class="nav-link {{ (int) getParentShowOf($current_page) + 1 == $sub_menu->id ? 'active' : '' }}">
                                                    {{ $sub_menu->display_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- <hr class="sidebar-divider-custom"> --}}

                        </li>
                    @endif
                @endforeach
            @endrole

            @role(['supervisor'])
                @foreach ($admin_side_menu as $menu)
                    @permission($menu->name)
                        @if (count($menu->appearedChildren) == 0)
                            <li
                                class="nav-item nav-category {{ $menu->id == getParentShowOf($current_page) ? 'active' : '' }}">
                                <a href="{{ route('admin.' . $menu->as) }}" class="nav-link">
                                    <i class="link-icon {{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                                    <span class="link-title">{{ $menu->display_name }}</span>
                                </a>
                                {{-- <hr class="sidebar-divider-custom"> --}}
                            </li>
                        @else
                            <li
                                class="nav-item nav-category {{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'active' : '' }}">
                                <a class="nav-link {{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? '' : 'collapsed' }}"
                                    data-bs-toggle="collapse" data-bs-target="#collapse_{{ $menu->route }}"
                                    href="#collapse_{{ $menu->route }}" role="button"
                                    aria-expanded="{{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'true' : 'false' }}"
                                    aria-controls="collapse_{{ $menu->route }}">
                                    <i class="link-icon {{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                                    <span class="link-title">{{ $menu->display_name }}</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                @if (count($menu->appearedChildren) > 0)
                                    <div class="collapse {{ in_array($menu->parent_show, [getParentShowOf($current_page)]) ? 'show' : '' }}"
                                        id="collapse_{{ $menu->route }}">
                                        <ul class="nav sub-menu">
                                            @foreach ($menu->appearedChildren as $sub_menu)
                                                @permission($sub_menu->name)
                                                    <li class="nav-item">
                                                        <a href="{{ route('admin.' . $sub_menu->as) }}"
                                                            class="nav-link {{ (int) getParentShowOf($current_page) + 1 == $sub_menu->id ? 'active' : '' }}">
                                                            {{ $sub_menu->display_name }}
                                                        </a>
                                                    </li>
                                                @endpermission
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endpermission
                @endforeach
            @endrole

        </ul>

    </div>
</nav>
