<audio id="notification">
    <source src="{{ asset('assets/audio/tinhih-notification.wav') }}" type="audio/mpeg" />
</audio>
@if (\Illuminate\Support\Facades\Auth::user()->type == 'admin')
    @include('admin.includes.headers.admin')
@elseif(\Illuminate\Support\Facades\Auth::user()->type == 'provider')
    @include('admin.includes.headers.provider')
@elseif(\Illuminate\Support\Facades\Auth::user()->type == 'community_member')
    @include('admin.includes.headers.community_member')
@else
    @include('admin.includes.headers.client')
@endif
