@php
    /* @var \App\Models\Category $category */
@endphp
<tr>
    <td data-order="{{$category->id}}">#{{$category->id}}</td>
    <td>{{$category->name}}</td>
    <td>{{$category->slug}}</td>
    <td class="d-flex ">
        <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
        <form action="{{route('admin.categories.destroy',$category->id)}}" method="post" class="ml-2">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger delete">Delete</button>
        </form>
    </td>
</tr>
