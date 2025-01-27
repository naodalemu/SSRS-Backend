@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tables</h1>
                <a href="{{ route('table.create') }}" class="btn btn-primary mb-3">Create Tables</a>
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Table_Number</th>
                            <th>qr</th>
                            <th>Table Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tables as $table)
                            <tr>
                                <td>{{ $table->id }}</td>
                                <td>{{ $table->table_number }}</td>
                                <td>{{ $table->qr_code }}</td>
                                <td>{{ $table->table_status }}</td>
                                <td>
                                    <a href="{{ route('table.show', $table->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>

                                      <a href="{{ route('table.edit', $table->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                      <form action="{{ route('table.destroy', $table->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                          <i class="fas fa-trash"></i> Delete
                                        </button>
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
