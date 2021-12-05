@extends('layouts.app')

@section('title','فایل های زونکن')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-request">
            <div class="col-12">
                <span class="title-services">
                    فایل های زونکن
                </span>
            </div>

            <div class="col-12 table list-request-table">
                <table>
                    <tr>
                        <th>آیدی فایل</th>
                        <th>متراژ</th>
                        <th>خرید</th>
                        <th>رهن</th>
                        <th>اجاره</th>
                        <th>آدرس</th>
                        <th>توضیحات</th>
                        <th>مشاهده</th>
                    </tr>

                    @foreach($data['zoonkanFiles'] as $file)

                        @if($file->estate[0]->rent_price != 0 && $file->estate[0]->mortgage_price != 0)
                            <tr class="list-request-table-tr-mortgage">
                                <td>{{$file->estate[0]->id}}</td>
                                <td>{{$file->estate[0]->area}}</td>
                                <td>.....</td>
                                <td>{{$file->estate[0]->mortgage_price}}</td>
                                <td>{{$file->estate[0]->rent_price}}</td>
                                <td>{{$file->estate[0]->address}}</td>
                                <td>{{$file->estate[0]->description}}</td>
                                <td>
                                    <a href="{{route('detail',$file->estate[0]->id)}}" target="_blank"
                                       class="bg-primary rounded text-white p-1">مشاهده فایل</a>
                                </td>
                            </tr>
                        @else
                            <tr class="list-request-table-tr-by">
                                <td>{{$file->estate[0]->id}}</td>
                                <td>{{$file->estate[0]->area}}</td>
                                <td>{{$file->estate[0]->buy_price}}</td>
                                <td>.....</td>
                                <td>.....</td>
                                <td>{{$file->estate[0]->address}}</td>
                                <td>{{$file->estate[0]->description}}</td>
                                <td>
                                    <a href="{{route('detail',$file->estate[0]->id)}}" target="_blank"
                                       class="bg-primary rounded text-white p-1">مشاهده فایل</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                </table>
            </div>
        </div>

    </div>
@endsection
