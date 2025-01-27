@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Menu Item Details</h1>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $menuItem->name }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $menuItem->description }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ $menuItem->price }}</td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>
                                    @foreach ($menuItem->tags as $tag)
                                        {{ $tag->name }},
                                    @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Ingredients</th>
                            <td>
                                @foreach ($menuItem->ingredients as $ingredient)
                                    {{ $ingredient->name }},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Categories</th>
                            <td>
                                @if ($menuItem->categories == 'Drink')
                                    Drink
                                @elseif($menuItem->categories == 'Food')
                                    Food
                                @else
                                    {{ $menuItem->categories }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                @if ($menuItem->image)
                                    <img src="{{ asset('images/' . $menuItem->image) }}" alt="{{ $menuItem->name }}"
                                        class="img-fluid rounded" style="max-width: 150px; max-height: 150px;">
                                @else
                                    No image available
                                @endif
                            </td>
                        </tr>

                        <!-- Add more rows for any other relevant information -->
                    </tbody>
                </table>
                <a href="{{ route('menuitem.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
