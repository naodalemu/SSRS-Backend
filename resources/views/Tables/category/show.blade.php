@extends('layouts.auth')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Category Details</h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $category->description }}</td>
                    </tr>

                </tbody>
            </table>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
