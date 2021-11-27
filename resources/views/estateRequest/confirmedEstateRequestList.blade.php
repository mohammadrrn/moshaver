@extends('layouts.app')

@section('content')
    <ul>
        @foreach($data['estateRequestList'] as $request)
            <li>
                <a href="{{route('estateRequest.unConfirmEstateRequest',$request->id)}}">{{$request->owner_mobile_number}}</a>
                •
                <a href="{{route('estateRequest.updateEstateRequestForm',$request->id)}}">update</a>
                •
                <a href="{{route('estateRequest.deleteEstateRequestForm',$request->id)}}">delete</a>
            </li>
        @endforeach
    </ul>
@endsection
