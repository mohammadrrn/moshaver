@extends('layouts.app')

@section('title','نوتیفیکیشن ها')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-factor">
            <div class="col-12">
                <span class="title-services">
                    نوتیفیکیشن ها
                </span>
            </div>
            <div class="col-12 table">
                <table>
                    <tr>
                        <th>عنوان</th>
                        <th>لینک</th>
                    </tr>
                    @foreach(auth()->user()->unreadNotifications as $notification)
                        <tr>
                            <td>{{$notification->data[0]}}</td>
                            <td><a href="{{route('panel.redirectTo',$notification)}}">مشاهده</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
