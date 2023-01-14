@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Ime</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="product_name" id="name" value="{{ old('product_name', '') }}" required>
                @if($errors->has('product_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shops">Imanje</label>
{{--                <div style="padding-bottom: 4px">--}}
{{--                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>--}}
{{--                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>--}}
{{--                </div>--}}
                <select class="form-control select2 {{ $errors->has('shop') ? 'is-invalid' : '' }}" name="shop" id="shops">
                    @foreach($shops as $id => $shop)
                        <option value="{{ $shop->id }}" {{ in_array($id, old('shop', [])) ? 'selected' : '' }}>{{ $shop->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('shop`'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shop') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.categories_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_description">{{ trans('cruds.shop.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('product_description') ? 'is-invalid' : '' }}" name="product_description" id="description">{{ old('product_description') }}</textarea>
                @if($errors->has('product_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <input type="file"
                       id="image" name="image"
                       accept="image/png, image/jpeg">

            @if($errors->has('photos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.photos_helper') }}</span>
            </div>
            PRICE
            <div class="form-group">
                <label for="price">{{ trans('cruds.shop.fields.address') }}</label>
                <input class="form-control map-input {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="product_price" id="product_price" value="{{ old('product_price') }}">
                @if($errors->has('product_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.address_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>


    </div>
</div>
@endsection
