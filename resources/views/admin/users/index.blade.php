@extends('admin.layouts.base')
@section('title','Users')
@push('styles')
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content">
        <div class="row align-items-center flex-column">
            <div class="col-6">
                @include('admin.includes.errors')
            </div>
            <div class="col-12">
                <table id="users" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @include('admin.users.includes.item')
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th data-orderable="false"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function (item) {
                    tmp = item.split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }

        $(function () {
            const options = {},
                search = findGetParameter('s');
            if (search) options["oSearch"] = {"sSearch": findGetParameter('s')};

            $("#users").DataTable(options);
        });

        $('.delete,.toggle-admin,.toggle-ban').on('click', function () {
            return confirm('Are you sure?');
        });
    </script>
@endpush
