@if (session('alert'))
    @if (session('alert')['type'] == "success")
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('alert')['message'] }}
        </div>
    @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('alert')['message'] }}
        </div>
    @endif

@endif

