@extends('layouts.app')

@section('title','لیست گزارش های واگذاری')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-factor">
            <div class="col-12">
                <span class="title-services">
                   لیست گزارشات واگذاری
                </span>
            </div>

            <div class="col-12 table">
                <table>
                    <tr>
                        <th>آیدی آگهی</th>
                        <th>لینک آگهی</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($data['cessionReports'] as $report)
                        <tr>
                            <td>{{$report->id}}</td>
                            <td>
                                <a class="btn bg-success rounded btn-sm text-white" target="_blank"
                                   href="{{route('detail',$report->estate_request_id)}}">مشاهده
                                    آگهی</a>
                            </td>
                            <td>
                                <form method="post"
                                      action="{{route('panel.cession.confirmCession',$report->estate_request_id)}}">
                                    @csrf
                                    <input type="hidden" name="estate_request_id"
                                           value="{{$report->estate_request_id}}">
                                    <input class="btn btn-danger btn-sm" type="submit" value="تایید واگذاری">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
