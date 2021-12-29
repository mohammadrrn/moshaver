@extends('layouts.app')

@section('title','لیست مناطق')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-factor">
            <div class="col-12">
                <span class="title-services">
                    لیست مناطق
                </span>
            </div>

            <div class="col-12 table">
                <table>
                    <tr>
                        <th>آیدی منطقه</th>
                        <th>نام منطقه</th>
                        <th>عملیات</th>
                        <th>وضعیت</th>
                    </tr>
                    @foreach($data['areas'] as $area)
                        <tr>
                            <td>{{$area->id}}</td>
                            <td>{{$area->text}}</td>
                            <td>
                                <a href="{{route('panel.area.editAreaForm',$area->id)}}" class="btn btn-sm btn-primary">ویرایش
                                    منطقه</a>
                            </td>
                            <td>
                                @if($area->status == 0)
                                    <a href="{{route('panel.area.enableArea',$area->id)}}"
                                       class="btn btn-sm btn-success">نمایش منطقه</a>
                                @elseif($area->status == 1)
                                    <a href="{{route('panel.area.disableArea',$area->id)}}"
                                       class="btn btn-sm btn-danger">مخفی کردن منطقه</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
