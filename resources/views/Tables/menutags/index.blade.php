@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Menu Tags</h1>
            <a href="{{ route('menutags.create') }}" class="btn btn-primary mb-3">Create New Menu Tag</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuTags as $menuTag)
                    <tr>
                        <td>{{ $menuTag->name }}</td>
                        <td>
                            <a href="{{ route('menutags.show', $menuTag->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('menutags.edit', $menuTag->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('menutags.destroy', $menuTag->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu tag?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
