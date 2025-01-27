@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Tag Details</h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $tag->name }}</td>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <td>{{ $tag->description }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('tag.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
