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
                        <input type="text" name="mobile_number" value="{{old('mobile_number')}}"/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>شماره تماس</label>
                    </div>
                    <div class="group">
                        <select name="contact_category_id">
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
            <div class="col-md-12 col-lg-6 add-moshaver">
                <div class="form-top">
                    <span>دفترچه من</span>
                </div>
                <ul>
                    @foreach($data['categories'] as $category)
                        <li>{{$category->name}}</li>
                        <ul>
                            @foreach($data['myContacts'] as $key=>$contact)
                                @if($category->id == $key)
                                    @if(is_array($contact))
                                        @foreach($contact as $item)
                                            {{$item['full_name']}} . {{$item['mobile_number']}} <br>
                                        @endforeach
                                    @endif
                                    <hr>
                                @endif
                            @endforeach
                        </ul>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-12  list-moshaver">

            </div>
        </div>
    </div>
@endsection
