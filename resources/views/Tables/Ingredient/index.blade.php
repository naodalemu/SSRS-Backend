@extends('layouts.auth')

@section('content')
    <div class="container py-4 px-3">
        <div class="row jxustify-content-center" style="width: 100%;">
            <div class="col-md-8" style="width: 100%;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="d-flex flex-row justify-content-between border-bottom pb-1">
                                    <h3 class="text-secondary">
                                        <i class="fa fa-th-list"></i>
                                        Ingredients
                                    </h3>
                                    <a href="{{ route('ingredient.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <table id="datatablesSimple" class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ingredients as $ingredient)
                                            <tr>
                                                <td class="font-weight-bold">{{ $ingredient->id }}</td>
                                                <td class="font-weight-bold">{{ $ingredient->name }}</td>
                                                <td class="font-weight-bold">{{ $ingredient->description }}</td>
                                                <td class="font-weight-bold">
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('ingredient.show', $ingredient->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>

                                                        <a href="{{ route('ingredient.edit', $ingredient->id) }}"
                                                            class="btn btn-warning btn-sm mx-2">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>

                                                        <form action="{{ route('ingredient.destroy', $ingredient->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
