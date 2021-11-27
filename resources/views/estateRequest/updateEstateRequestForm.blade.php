@extends('layouts.app')

@section('content')
    <form method="post" action="{{route('estateRequest.updateEstateRequest',$data['estateRequest']->id)}}">
        @method('patch')
        @csrf
        <input type="text" name="owner_name" value="{{$data['estateRequest']->owner_name}}" placeholder="owner name">
        <br>
        <input type="text" name="owner_mobile_number" value="{{$data['estateRequest']->owner_mobile_number}}"
               placeholder="owner_mobile_number">
        <br>
        <select name="area_id">
            <option disabled selected>area</option>
            @foreach($data['area'] as $area)
                @if($area->id == $data['estateRequest']->area_id)
                    <option selected value="{{$area->id}}">{{$area->text}}</option>
                @else
                    <option value="{{$area->id}}">{{$area->text}}</option>
                @endif
            @endforeach
        </select>
        <br>
        <select name="transfer_id">
            <option disabled selected>type of transfer</option>
            @foreach($data['transfer'] as $transfer)
                @if($transfer->id == $data['estateRequest']->transfer_id)
                    <option selected value="{{$transfer->id}}">{{$transfer->text}}</option>
                @else
                    <option value="{{$transfer->id}}">{{$transfer->text}}</option>
                @endif
            @endforeach
        </select>
        <br>
        <select name="estate_id">
            <option disabled selected>type of estate</option>
            @foreach($data['estate'] as $estate)
                @if($estate->id == $data['estateRequest']->estate_id)
                    <option selected value="{{$estate->id}}">{{$estate->text}}</option>
                @else
                    <option value="{{$estate->id}}">{{$estate->text}}</option>
                @endif
            @endforeach
        </select>
        <br>
        <input type="text" name="address" value="{{$data['estateRequest']->address}}" placeholder="address">
        <br>
        <input type="text" name="area" value="{{$data['estateRequest']->area}}" placeholder="area">
        <br>
        <input type="text" name="street_name" value="{{$data['estateRequest']->street_name}}" placeholder="street_name">
        <br>
        <input type="text" name="plaque" value="{{$data['estateRequest']->plaque}}" placeholder="plaque">
        <br>
        <input type="text" name="floor" value="{{$data['estateRequest']->floor}}" placeholder="floor">
        <br>
        <input type="text" name="number_of_floor" value="{{$data['estateRequest']->number_of_floor}}"
               placeholder="number_of_floor">
        <br>
        <input type="text" name="apartment_unit" value="{{$data['estateRequest']->apartment_unit}}"
               placeholder="apartment_unit">
        <br>
        <input type="text" name="year_of_construction" value="{{$data['estateRequest']->year_of_construction}}"
               placeholder="year_of_construction">
        <br>
        <select name="direction_id">
            <option disabled selected>direction of estate</option>
            @foreach($data['direction'] as $direction)
                @if($direction->id == $data['estateRequest']->direction_id)
                    <option selected value="{{$direction->id}}">{{$direction->text}}</option>
                @else
                    <option value="{{$direction->id}}">{{$direction->text}}</option>
                @endif
            @endforeach
        </select>
        <br>
        <input type="text" name="mortgage_price" value="{{$data['estateRequest']->mortgage_price}}"
               placeholder="mortgage_price">
        <br>
        <input type="text" name="rent_price" value="{{$data['estateRequest']->rent_price}}" placeholder="rent_price">
        <br>
        <input type="text" name="description" value="{{$data['estateRequest']->description}}" placeholder="description">
        <br>
        <input type="checkbox" name="options[empty]"
               value="1" {{ $data['estateRequest']->empty === 1 ? 'checked' : false }}>
        <input type="checkbox" name="options[presell]"
               value="1" {{ $data['estateRequest']->presell === 1 ? 'checked' : false }}>
        <input type="checkbox" name="options[exchange]"
               value="1" {{ $data['estateRequest']->exchange === 1 ? 'checked' : false }}>
        <input type="checkbox" name="options[cctv]"
               value="1" {{ $data['estateRequest']->cctv === 1 ? 'checked' : false }}>
        <br>
        <input type="submit" value="submit">
    </form>
@endsection
