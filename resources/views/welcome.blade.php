<h1>Welcome , {{ auth()->user()->name ?? 'User' }}</h1>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@php
    $user = DB::table('users')->get();
    // $images = $user->image;
    // $images = explode(',', $images);
@endphp
@if (session('success'))
    <span style='color: green;'>{{ session('success') }}</span>
@endif
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Hobby</th>
            <th scope="col">City</th>
            <th scope="col">Profile Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->gender }}</td>
                <td>{{ $item->hobby }}</td>
                <td>{{ $item->city }}</td>
                @php
                    $images = explode(',', $item->image);
                @endphp
                <td>
                    @foreach ($images as $image)
                        <img src="{{ asset('storage/profile_image/' . $image) }}" width='100' height='60'
                            alt="">
                    @endforeach
                </td>

                <td><a href="{{ url('edit-user/' . $item->id) }}">Edit</a></td>
                <td><a href="{{ url('delete-user/' . $item->id) }}">Delete</a></td>


            </tr>
        @endforeach

    </tbody>
</table>
