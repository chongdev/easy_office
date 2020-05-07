@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">สมัครสมาชิก</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('adduser') }}" aria-label="{{ __('adduser') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">คำนำหน้าชื่อ</label>

                            <div class="col-md-6">
                            <select class="form-control {{ !empty( $errors->first('prefix')) ? 'is-invalid' : '' }}" name="prefix" id="prefix">
                                <option value="" class="form-control">-เลือกคำนำหน้า-</option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                                </select>
                                @if (!empty($errors->first('prefix')))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                @endif
                            </div>
                       
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">ชื่อ</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->first('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">

                                @if (!empty($errors->first('name')))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">นามสกุล</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->first('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}">

                                @if ($errors->first('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">ตำแหน่งงาน</label>

                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control{{ $errors->first('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}">

                                @if ($errors->first('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">ฝ่าย/แผนก</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control{{ $errors->first('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}">
                                
                                @if ($errors->first('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->first('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

                                @if ($errors->first('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->first('password') ? ' is-invalid' : '' }}" name="password" >
                                @if ($errors->first('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('รูป') }}</label>
                            <div class="col-md-6">
                            <input type="file" name="image" class="form-control" accept="image/*" />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    บันทึกข้อมูล
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
