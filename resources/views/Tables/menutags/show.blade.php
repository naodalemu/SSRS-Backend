@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Menu Tag Details</h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $menuTag->name }}</td>
                    </tr>
                    <!-- Add more rows for any other relevant information -->
                </tbody>
            </table>
            <a href="{{ route('menutags.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
