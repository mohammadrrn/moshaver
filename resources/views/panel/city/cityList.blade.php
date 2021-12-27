@extends('layouts.app')

@section('title','لیست شهرها')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-factor">
            <div class="col-12">
                <span class="title-services">
                    لیست شهرها
                </span>
            </div>

            <div class="col-12 table">
                <table>
                    <tr>
                        <th>آیدی شهر</th>
                        <th>نام شهر</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($data['cities'] as $city)
                        <tr>
                            <td>{{$city->id}}</td>
                            <td>{{$city->text}}</td>
                            <td>
                                <a href="{{route('panel.city.editCityForm',$city->id)}}" class="btn btn-sm btn-primary">ویرایش
                                    شهر</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
