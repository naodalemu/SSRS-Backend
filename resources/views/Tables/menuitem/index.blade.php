@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1><i class="fas fa-clipboard-list"></i>MenuItems</h1>
            <a href="{{ route('menuitem.create') }}" class="btn btn-primary mb-3">Create New Menu Item</a>
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Tags</th>
                            <th>Ingredients</th>
                            <th>Categories</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menuItems as $menuItem)
                        <tr>
                            <td>{{ $menuItem->name }}</td>
                            <td>{{ $menuItem->description }}</td>
                            <td>{{ $menuItem->price }}</td>

                            <td>
                                @foreach ($menuItem->tags as $tag)
                                    <label class="form-check-label" for="tag-{{ $menuItem->id }}-{{ $loop->index }}">{{ $tag->name }}</label>
                                @endforeach
                            </td>

                            <td>
                                @foreach ($menuItem->ingredients as $ingredient)
                                    <label class="form-check-label" for="ingredient-{{ $menuItem->id }}-{{ $loop->index }}">{{ $ingredient->name }}</label>
                                @endforeach
                            </td>
                            <td>{{ $menuItem->categories }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('menuitem.show', $menuItem->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>

                                    <a href="{{ route('menuitem.edit', $menuItem->id) }}" class="btn btn-warning btn-sm mx-2">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('menuitem.destroy', $menuItem->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this menu item?')" class="btn btn-sm btn-danger">
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
@endsection
