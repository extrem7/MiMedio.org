@php
    /* @var \App\Models\Post $post */

    $author = $post->author;
    $category = $post->category;
@endphp
<tr>
    <td data-order="{{$post->id}}">#{{$post->id}}</td>
    <td>{{$post->title}}</td>
    <td><a href="{{route('admin.users.index')}}/?s={{$author->id}}">{{$post->author->name}}</a></td>
    <td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
    <td>{{$post->status}}</td>
    <td>{{$post->created_at}}</td>
    <td class="d-flex ">
        <!--<a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>-->
        <form action="{{route('admin.posts.destroy',$post->id)}}" method="post" class="ml-2">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger delete">Delete</button>
        </form>
    </td>
</tr>
