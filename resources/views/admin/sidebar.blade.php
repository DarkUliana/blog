<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <ul class="list-group list-group-flush">

            <li class="list-group-item">
                <a class="card-link" href="{{ url('/admin/post') }}">Posts</a>
            </li>

            @can('update-user')
                <li class="list-group-item">
                    <a class="card-link" href="{{ url('/admin/user') }}">Users</a>
                </li>
            @endcan
        </ul>

    </div>
</div>
