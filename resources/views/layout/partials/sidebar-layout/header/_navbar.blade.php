<div class="app-navbar flex-shrink-0">
    @can('read dip')
        <div class="app-navbar-item ms-1 ms-md-3">
            <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                data-kt-menu-placement="bottom-end" id="kt_menu_item_wow"><i class="fa fa-bell" aria-hidden="true" style="font-size:16px;color:red"></i></div>
            @include('partials/menus/_notifications-menu')
        </div>
    @endcan
	<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        @if(auth()->user()->designation == '6' || auth()->user()->designation == '5' && auth()->user()->permissions_level == 'province-wide')
            <div class="mx-5">
                <div class="btn-group">
                    <select class="form-select btn btn-sm btn-info btn-outline-info rounded-circle" id="update_province">
                        <option class="rounded-circle" value="4" @if(auth()->user()->province == '4') selected @endif>Sindh</option>
                        <option class="rounded-circle" value="2" @if(auth()->user()->province == '2') selected @endif>KPK</option>
                        <option class="rounded-circle" value="3" @if(auth()->user()->province == '3') selected @endif>Baloshistan</option>
                    </select>
                </div>
            </div>
        @endif
		<div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            @if(Auth::user()?->profile_photo_url)
                <img src="{{ \Auth::user()?->profile_photo_url }}" class="rounded-3" alt="user" />
            @else
                <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', Auth::user()?->name) }}">
                    {{ substr(Auth::user()?->name, 0, 1) }}
                </div>
            @endif
        </div>
        @include('partials/menus/_user-account-menu')
    </div>
</div>
