@extends('layouts.app')

@section('title','لیست صورتحساب ها')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver list-factor">
            <div class="col-12">
                <span class="title-services">
                    لیست تراکنش ها
                </span>
            </div>
            <div class="col-12 table">
                <table>
                    <tr>
                        <th>آیدی صورتحساب</th>
                        <th>مبلغ</th>
                        <th>کد پیگیری</th>
                        <th>توضیحات</th>
                        <th>تاریخ و ساعت</th>
                        <th>وضعیت</th>
                    </tr>
                    @foreach($data['invoicesList'] as $invoice)
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>{{number_format($invoice->amount)}} تومان</td>
                            <td>{{$invoice->ref_id}}</td>
                            <td>{{$invoice->description}}</td>
                            <td>
                                <span class="bg-dark text-white p-1 mr-1 rounded">
                                    {{Morilog\Jalali\Jalalian::fromDateTime($invoice->created_at)->format('%Y/%m/%d')}}
                                </span>
                                <span>
                                    {{Morilog\Jalali\Jalalian::fromDateTime($invoice->created_at)->format('H:i:s')}}
                                </span>
                            </td>
                            <td>
                                @if($invoice->status == 1)
                                    <span class="bg-success text-white p-1 rounded">پرداخت شده</span>
                                @elseif($invoice->status == 0)
                                    <span class="bg-danger text-white p-1 rounded">عدم پرداخت</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
