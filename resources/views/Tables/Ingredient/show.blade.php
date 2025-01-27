@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Ingredients Details</h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $ingredient->name }}</td>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <td>{{ $ingredient->description }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('ingredient.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
