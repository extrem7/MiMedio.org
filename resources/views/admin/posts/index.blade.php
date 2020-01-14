@extends('admin.layouts.base')
@section('title','Posts')
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
                <div class="form-group">
                    <a href="{{route('admin.posts.create')}}" class="btn btn-success">Create</a>
                </div>
                <table id="posts" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        @include('admin.posts.includes.item')
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created at</th>
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
        $(function () {
            $("#posts").DataTable({
                stateSave: true,
                "columnDefs": [
                    {width: "30%", targets: 1}
                ]
            });
        });
        $('.delete').on('click', function () {
            return confirm('Are you sure?');
        });
    </script>
@endpush
