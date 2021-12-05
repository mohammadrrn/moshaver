@extends('index')

@section('title','دفاتر مورد اعتماد ')

@section('content')
    <main class="container-fluid trusted-offices">
        <div class="container cover-comment">
            <div class="row cover-comment-row">
                <div class="col-6 cover-comment-row-right">
                    <img class="cover-comment-row-right-back" src="icon/icons8_forward_32px_1.png" alt="">
                    <div class="cover-comment-row-right-top">
                        <span class="cover-comment-row-right-top-dislike">
                            <img class="cover-comment-row-right-top-dislike-defult" src="icon/icons8-like-48.png"
                                 alt="">
                            <img class="cover-comment-row-right-top-dislike-red" src="icon/icons8-like-24 (2).png"
                                 alt="">
                        </span>
                        <span class="cover-comment-row-right-top-like">
                            <img class="cover-comment-row-right-top-like-defult" src="icon/icons8-like-48.png" alt="">
                            <img class="cover-comment-row-right-top-like-blue" src="icon/icons8-like-24 (1).png" alt="">
                        </span>
                        <span class="cover-comment-row-right-top-title">
                            درصورت بروز هرگونه مشکل متن را به صورت مختصر وارد کنید
                        </span>
                    </div>
                    <div class="cover-comment-row-right-center">
                        <form class="cover-comment-row-right-center-form">

                            <div class="form-group">
                                <textarea placeholder="نظرات یا انتقادات  خود را وارد کنید..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </form>
                    </div>
                </div>
                <div class="col-6 cover-comment-row-left">
                    <img src="video/like.gif" alt="like">
                </div>
            </div>
        </div>


        <div class="container main-box-top">
            <div class="row main-box-top-row">

                @foreach($data['trustedOffices'] as $item)
                    <div class="col-12 col-md-6 ">
                        <div class="trusted-offices-box">
                            <div class="row">
                                <div class="col-6 trusted-offices-box-slider">
                                    <img class="d-block w-100 trusted-offices-img"
                                         src="{{asset('img/bg-melk (1).jpg')}}"
                                         alt="First slide">
                                    <form class="form-star">
                                        <fieldset class="fieldset-star">
                                        <span class="star-cb-group">
                                            <input type="radio" id="rating-5" name="rating" value="5"/><label
                                                for="rating-5">5</label>
                                            <input type="radio" id="rating-4" name="rating" value="4"
                                                   checked="checked"/><label for="rating-4">4</label>
                                            <input type="radio" id="rating-3" name="rating" value="3"/><label
                                                for="rating-3">3</label>
                                            <input type="radio" id="rating-2" name="rating" value="2"/><label
                                                for="rating-2">2</label>
                                            <input type="radio" id="rating-1" name="rating" value="1"/><label
                                                for="rating-1">1</label>
                                            <input type="radio" id="rating-0" name="rating" value="0"
                                                   class="star-cb-clear"/><label for="rating-0">0</label>
                                        </span>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="col-6 trusted-offices-box-box-left">
                                    <div class="trusted-offices-box-box-left-first">
                                        <span
                                            class="trusted-offices-box-box-left-first-span">{{$item->real_estate_name}}</span>
                                    </div>
                                    <span>
                                    <img src="icon/male_user.svg">
                                    {{$item->full_name}}
                                </span>
                                    <span>
                                    <img src="icon/phone.svg">
                                    {{$item->mobile_number}}
                                </span>
                                    <span>
                                    <img src="icon/address.svg">
                                    {{$item->address}}
                                </span>

                                    <form class="form-star right">
                                         
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{$data['trustedOffices']->links()}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
