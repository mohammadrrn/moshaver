@extends('layouts.app')

@section('title','ایجاد زونکن جدید')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1 list-moshaver">
            <div class="col-12">
                        <span class="title-services">
                            ایجاد زونکن جدید
                        </span>
            </div>
            <div class="col-12">
                <form method="post" action="{{route('panel.zoonkan.createZoonkan')}}">
                    @csrf
                    <div class="row list-moshaver-top">
                        <div class="col-6">
                            <div class="list-request-box-group">
                                <input type="text" placeholder="نام زونکن" name="zoonkan_name"
                                       value="{{old('zoonkan_name')}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="list-request-box-group">
                                <select name="zoonkan_color">
                                    <option selected disabled>انتخاب رنگ زونکن</option>
                                    <option value="#e53935">قرمز</option>
                                    <option value="#21B6A8">سبز</option>
                                    <option value="#007bff">آبی</option>
                                    <option value="#323232">مشکی</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 zoonkan-top-box">
                            <div class="zoonkan-top-box-btn">
                                <button type="submit" class="btn btn-block top-button-add">ایجاد زونکن</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 table zoonkan">


                <section id="list" class="row zoonkan-list">
                    @foreach($data['myZoonkan'] as $zoonkan)
                        <div id='a' class="zoonkan-list-box">
                            <div class='inside' style="background: {{$zoonkan->zoonkan_color}} !important;">
                                {{$zoonkan->zoonkan_name}} ({{count($zoonkan->files)}})
                            </div>
                            <a href="{{route('panel.zoonkan.zoonkanFiles',$zoonkan->id)}}" id='a' class="download">
                                <svg class="folder-back" viewBox="0 0 48 48">
                                    <path d="
                                                            M  3.50  7.50
                                                            C  3.50  5.29   5.28  3.50   7.49  3.50
                                                            C 13.17  3.50  23.18  3.50  26.00  3.50
                                                            C 30.00  3.50  28.00  6.00  32.00  6.00
                                                            C 34.21  6.00  37.87  6.00  40.71  6.00
                                                            C 42.93  6.00  44.73  7.82  44.71 10.04
                                                            L 44.54 25.04
                                                            C 44.52 27.24  42.74 29.00  40.54 29.00
                                                            H  7.50
                                                            C  5.29 29.00   3.50 27.21   3.50 25.00
                                                            V  7.50
                                                            Z
                                                          " fill="#32AF75"/>
                                </svg>
                                <div class="page-1"></div>
                                <div class="page-2"></div>
                                <svg class="folder-front" viewBox="0 0 48 48">
                                    <defs>
                                        <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" style="stop-color:#47DB99;stop-opacity:1"/>
                                            <stop offset="100%" style="stop-color:#2EA16D;stop-opacity:1"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="
                                                            M  2.36 24.31
                                                            C  2.17 23.09   3.11 22.00   4.34 22.00
                                                            H 40.90
                                                            C 41.80 22.00  42.33 23.00  41.83 23.75
                                                            L 41.40 24.40
                                                            C 41.16 24.76  41.16 25.24  41.40 25.60
                                                            V 25.60
                                                            C 41.73 26.10  42.40 26.23  42.90 25.90
                                                            L 43.50 25.50
                                                            V 25.50
                                                            C 44.75 24.88  46.17 25.93  45.94 27.31
                                                            L 43.57 41.17
                                                            C 43.24 43.09  41.57 44.50  39.63 44.50
                                                            H  8.93
                                                            C  6.95 44.50   5.28 43.06   4.97 41.11
                                                            L  2.36 24.31
                                                            Z
                                                          " fill="url(#gradient)"/>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </div>
@endsection
