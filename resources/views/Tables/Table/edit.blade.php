@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Table</h1>
                <form action="{{ route('table.update', $table) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    @endif


                    <div class="form-group">
                        <label for="table_number">Table number</label>
                        <input type="number" class="form-control" id="number" name="table_number"
                            value="{{ $table->table_number }}" required>
                    </div>


                    <div class="form-group">
                        <label for="description">qr</label>
                        <textarea class="form-control" id="name" name="qr_code" required>{{ $table->qr_code }}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="status">Table Status</label>
                        <select class="form-control" id="status" name="table_status" required>
                            <option value="free">Free</option>
                            <option value="occupied">Occupied</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Table</button>
                </form>
            </div>
        </div>
    </div>
@endsection
