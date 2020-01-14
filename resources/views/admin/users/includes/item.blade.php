@php
    /* @var \App\Models\User $user */
$banned = $user->is_banned?'style=text-decoration:line-through;':'';
@endphp
<tr {{$banned}}>
    <td data-order="{{$user->id}}">#{{$user->id}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->name}}</td>
    <td>
        <div class="d-flex align-items-center">
            <span>{{$user->is_admin?'Admin':'User'}}</span>
            @if(!$user->isSuperAdmin() && !$user->is_banned)
                <form action="{{route('admin.users.toggle-admin',$user->id)}}" method="post" class="ml-2">
                    @method('PATCH')
                    @csrf
                    <button class="text-info toggle-admin btn btn-link p-0">(Make {{!$user->is_admin?'admin':'user'}})
                    </button>
                </form>
            @endif
        </div>
    </td>
    <td class="d-flex ">
        <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
        @if(!$user->isSuperAdmin())
            <form action="{{route('admin.users.toggle-ban',$user->id)}}" method="post" class="ml-2">
                @method('PATCH')
                @csrf
                <button
                    class="btn toggle-ban bg-{{$user->is_banned?'green':'black'}}">{{$user->is_banned?'UnBan':'Ban'}}</button>
            </form>
        @endif
        <form action="{{route('admin.users.destroy',$user->id)}}" method="post" class="ml-2">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger delete">Delete</button>
        </form>
    </td>
</tr>
