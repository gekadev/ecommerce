@extends('layouts.login')
@section("title",trans('لوحه التحكم')  )
@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form action="{{route('admin.authinticate')}}" method="post">
        <h3 class="form-title font-green">تسجيل الدخول</h3>
        @include('dashboard.includes.alerts.errors')
        @include('dashboard.includes.alerts.success')

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        @csrf
        @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>

            <input class="form-control form-control-solid placeholder-no-fix" name="email" value="{{old('email')}}" type="email"
                   autocomplete="off" placeholder="برجاء ادخال البريد الاليكتروني " />
        </div>
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">كلمه المرور</label>
            <input class="form-control form-control-solid placeholder-no-fix" name="password" type="password"
                   autocomplete="off" placeholder="برجاء ادخال كلمه المرور "  />
        </div>

        <div class="form-actions">
            <button type="submit" class="btn green uppercase"> دخول</button>

            <label class="rememberme check">
                <input type="checkbox" name="remember"  />تدكرني  </label>
        </div>
        <div class="create-account">
            <p>
                <a href="javascript:;" id="register-btn" class="uppercase"></a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->





@stop



