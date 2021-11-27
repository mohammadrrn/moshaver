@extends('layouts.app')

@section('content')
    <form method="post" action="{{route('estateRequest.deleteEstateRequest',$data['estateRequest']->id)}}">
        @method('delete')
        @csrf
        <p>are you sure?</p>
        <input type="submit" value="delete">
    </form>
@endsection
