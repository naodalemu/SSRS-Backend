@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Table Details</h1>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $table->id }}</td>
                        </tr>
                        <tr>
                            <th>Table number</th>
                            <td>{{ $table->table_number }}</td>
                        </tr>

                        <tr>
                            <th>QR</th>
                            <td>{{ $table->qr_code }}</td>
                        </tr>
                        <tr>
                            <th>qrTable Status</th>
                            <td>{{ $table->table_status }}</td>
                        </tr>

                    </tbody>
                </table>
                <a href="{{ route('table.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
