@extends('layouts.app')

@section('title','دفترچه تلفن')

@section('content')
    <div class="col-12 col-md-10 main-left">
        <div class="row bottom-box-1">
            <div class="col-md-12 col-lg-6 add-moshaver">
                <form action="{{route('panel.contact.addContact')}}" class="form" method="post">
                    @csrf
                    <div class="form-top">
                        <span>افزودن مخاطب جدید</span>
                    </div>

                    <div class="group">
                        <input type="text" name="full_name" value="{{old('full_name')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>نام و نام خانوادگی</label>
                    </div>
                    <div class="group">
                        <input type="text" maxlength="11" name="mobile_number" value="{{old('mobile_number')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره تماس</label>
                    </div>
                    <div class="group">
                        <select name="contact_category_id" class="form-select form-select">
                            <option selected disabled>انتخاب دسته بندی</option>
                            @foreach($data['categories'] as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="group">
                        <input type="text" name="description" value="{{old('description')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>توضیحات</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block moshaver-insert">افزودن مخاطب</button>
                </form>
            </div>
            <div class="col-md-12 col-lg-6 add-moshaver phone-book-box" style="padding: 10px;">
                <ul class="nav nav-tabs phone-book-box-ul" id="myTab" role="tablist" style="">
                    @foreach($data['categories'] as $key=>$category)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($key == 0) active @endif"
                               aria-selected="@if($key == 0) true @else false @endif" id="cat_{{$category->id}}"
                               data-toggle="tab" href="#control_{{$category->id}}"
                               role="tab"
                               aria-controls="control_{{$category->id}}" aria-selected="true">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    @foreach($data['categories'] as $key=>$category)
                        <div class="tab-pane fade @if($key == 0) show active @endif" id="control_{{$category->id}}"
                             role="tabpanel"
                             aria-labelledby="cat_{{$category->id}}">
                            @foreach($data['myContacts'] as $key=>$contact)
                                @if($category->id == $key)
                                    @if(is_array($contact))
                                        @foreach($contact as $item)
                                            <div style="display: flex;justify-content: space-between;padding: 0 10px">
                                                <span>
                                                    {{$item['full_name']}} . {{$item['mobile_number']}}
                                                </span>
                                                <a href="tel:{{$item['mobile_number']}}">
                                                    <img src="{{asset('icon/phone.svg')}}"
                                                         style="width: 30px;background: rgba(0,178,84,0.34);border-radius: 100%;padding: 5px">
                                                </a>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
