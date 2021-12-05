@extends('layouts.app')

@section('content')
    <div class="p-3">
        <form method="post" action="{{route('panel.estateRequest.deleteEstateRequest',$data['estateRequest']->id)}}">
            @method('delete')
            @csrf
            <p>آیا مطمئن هستید؟</p>
            <input class="btn btn-danger" type="submit" value="حذف">
        </form>
    </div>
@endsection
