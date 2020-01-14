@extends('admin.layouts.base')
@section('title','Create new category')
@section('content')
    <section class="content">
        <div class="row align-items-center flex-column">
            <div class="col-4">
                @include('admin.includes.errors')
            </div>
            <div class="col-md-4">
                <form class="card card-primary" action="{{route('admin.categories.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                   value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                                   value="{{old('slug')}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('admin.categories.index')}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success float-right">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
