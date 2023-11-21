@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-12 px-4 pt-2">
                <h4 class="d-inline">Edycja produktu</h4>
                <form method="post" action="/products/{{$product['id']}}" class="float-end align-items-center">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger border px-3 p-1">
                        <i class="fa fa-minus"></i>&nbsp;Usuń produkt
                    </button>
                </form>
            </div>

            <div class="col-3 px-4 pt-2 text-center">
                <img class="rounded-circle my-4" width="150px"
                     @if(!empty($product['photo']))
                         src="{{ asset('storage/'.$product['photo']) }}"
                     @else
                         src="{{ asset('images/unknown-product.png') }}"
                    @endif
                >
                @if(!empty($product['photo']))
                    <form method="post" action="/products/{{$product['id']}}/delete-product-photo" class="text-center my-2">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger border px-3 p-0">
                            <i class="fa fa-minus"></i>&nbsp;Usuń zdjęcie
                        </button>
                    </form>
                @endif
            </div>

            <form method="post" action="/products/{{$product['id']}}" class="col-md-12" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12 p-3 py-2">
                    <input type="file" class="form-control" name="photo" style="width: 18rem">
                    @error('photo')
                    <span class="flash-message__alert" role="alert">
                                {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="p-3 py-2">
                    <div class="row">
                        <div class="col-12 col-md-6 mt-2">
                            <span class="labels">Nazwa produktu</span>
                            <input name="name" value="{{ $product['name'] }}" type="text" class="form-control">
                            @error('name')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-6 col-md-3 mt-2">
                            <span class="labels">Marka produktu</span>
                            <select name="brand_id" id="brandSelect" class="form-control" style="width: 100%;">
                                @if (!empty($product['brand_id']) || !empty($product->brand->name))
                                    <option value="{{ $product['brand_id'] }}" selected>{{ $product->brand->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-6 col-md-3 mt-2">
                            <span class="labels">Kategoria produktu</span>
                            <select name="category_id" id="prodCatSelect" class="form-control" style="width: 100%;">
                                @if (!empty($product['category_id']) || !empty($product->productCategory->name))
                                    <option value="{{ $product['category_id'] }}" selected>{{ $product->productCategory->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-6 col-md-3 mt-2">
                            <span class="labels">Stan magazynowy</span>
                            <input value="{{ $product['quantity'] }}" name="quantity" type="text" class="form-control">
                            @error('quantity')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-6 col-md-3 mt-2">
                            <span class="labels">Cena</span>
                            <input value="{{ $product['price'] }}" name="price" type="text" class="form-control">
                            @error('price')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-6 col-md-3 mt-2">
                            <span class="labels">Jednostka</span>
                            <select name="unit" class="form-control">
                                @foreach(app('ProductUnitEnum')->getAllUnits() as $id => $name)
                                    <option value="{{ $id }}" {{ $id == $product['unit'] ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-3 mt-2">
                            <span class="labels">Status</span>
                            <select name="status" class="form-control">
                                @foreach(app('ProductStatusEnum')->getAllStatuses() as $id => $name)
                                    <option value="{{ $id }}" {{ $id == $product['status'] ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="labels">Opis produktu</span>
                            <textarea name="description" class="form-control" rows="5" style="resize: none;">{{ $product['description'] }}</textarea>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
                        <a href="/products" class="btn btn-primary profile-button" type="button">Powrót do listy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        var ajaxSearchBrandLink = @json(route('ajax.searchBrands'));
        var ajaxSearchProductCategoriesLink = @json(route('ajax.searchProductCategories'));
    </script>
    <script src="{{ asset('/js/products/ajax_search_brands.js') }}"></script>
    <script src="{{ asset('/js/products/ajax_search_product_categories.js') }}"></script>
@endsection
