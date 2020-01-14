@php
    /* @var \App\Models\Category $category */
@endphp
@extends('admin.layouts.base')
@section('title','Edit category')
@section('content')
    <section class="content">
        <div class="row align-items-center flex-column">
            <div class="col-4">
                @include('admin.includes.errors')
            </div>
            <div class="col-md-4">
                <form class="card card-primary" action="{{route('admin.categories.update',$category->id)}}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                   value="{{old('name',$category->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                                   value="{{old('slug',$category->slug)}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('admin.categories.index')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
