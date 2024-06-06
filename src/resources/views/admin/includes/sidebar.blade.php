@if (\Illuminate\Support\Facades\Auth::user()->type == 'admin')
    @include('admin.includes.sidebars.admin')
@elseif(\Illuminate\Support\Facades\Auth::user()->type == 'provider')
    @include('admin.includes.sidebars.provider')
@elseif(\Illuminate\Support\Facades\Auth::user()->type == 'community_member')
    @include('admin.includes.sidebars.community_member')
@else
    @include('admin.includes.sidebars.client')
@endif
