@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ฟอร์มใบลา</div>
                @csrf
                @foreach( $data as $key => $value )
                <div class="card-body">
                <form action="{{ action('user\leaveController@update',$value->id) }}" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('PUT') }}
                        <div class="controls">
                            <div class="row" style="margin-top:7px;">
                            <input type="hidden" name="U_id" value="{{ $value->id}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">เขียนที่ *</label>
                                        <input id="address" type="address"
                                            class="form-control {{ $errors->first('address') ? ' is-invalid' : '' }}"
                                            name="address" value="{{ !empty($data->address) ? $data->address: old('address') }}">
                                        @if ($errors->first('address'))
                                        <message class="text-danger">{{ $errors->first('address') }}</massage>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">วันที่ *</label>
                                        <input id="date" type="date"
                                            class="form-control {{ $errors->first('date') ? ' is-invalid' : '' }}"
                                            name="date" value="{{ !empty($data->date) ? $data->date: old('date') }}">
                                        @if ($errors->first('date'))
                                        <message class="text-danger">{{ $errors->first('date') }}</massage>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_email">เรี่องขอลา *</label>
                                        <input type="text" name="Title"
                                            class="form-control {{ !empty( $errors->first('Title')) ? 'is-invalid' : '' }}"
                                           value="{{ !empty($data->Title) ? $data->Title: old('Title') }}">
                                        @if(!empty( $errors->first('Title')))
                                        <message class="text-danger">- {{ $errors->first('Title') }} </message>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_email">เรียน *</label>
                                        <input type="text" name="dear"
                                            class="form-control {{ !empty( $errors->first('dear')) ? 'is-invalid' : '' }}"
                                            value="{{ !empty($data->dear) ? $data->dear: old('dear') }}">
                                        @if(!empty( $errors->first('dear')))
                                        <message class="text-danger">- {{ $errors->first('dear') }} </message>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_need"></label>
                                        <span
                                            style="margin-top:35px; position:absolute;">(ผู้บริหารฝ่ายบุคคลและบัญชี)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">ข้าพเจ้า *</label>
                                        <h5><p>{{ $value->prefix}} {{$value->username}} {{$value->lastname}}</p></h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">พนักงานประจำตำแหน่ง *</label>
                                        <h5><p for="date"> {{ $value->positionname }} </p></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">ฝ่าย/แผนก *</label>
                                        <h5><p for="date"> {{ $value->departmentname }}</p></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                            <div class="col-md-6">
                                    <div class="form-group">
                                       <h5> <label for="date">มีความประสงค์ที่จะ </label> </h5>
                                    </div>
                                </div>
                                </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">การลา*</label>
                                        <select name="vacation_Name" class="form-control {{ !empty( $errors->first('vacation_Name')) ? 'is-invalid' : '' }}">
                                            <option value="">-เลือกหมายเหตุการลา-</option>
                                            <option value="ลาป่วย">ลาป่วย</option>
                                            <option value="ลากิจ">ลากิจ</option>
                                            <option value="อื่นๆ">อื่นๆ</option>
                                        </select>
                                        @if(!empty( $errors->first('vacation_Name')))
                                        <message class="text-danger">- {{ $errors->first('vacation_Name') }} </message>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">อื่นๆ โปรดระบุ *</label>
                                        <input  type="text" class="form-control" name="etc" value="{{ !empty($data->etc) ? $data->etc: old('etc') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_message">เนื่องจาก *</label>
                                        <textarea  name="detail" class="form-control {{ !empty( $errors->first('detail')) ? 'is-invalid' : '' }}"
                                            placeholder="สาเหตุการลา *" rows="4" 
                                            data-error="Please, leave us a message.">
                                            {{ !empty($data->detail) ? $data->detail: old('detail') }}
                                            </textarea>
                                            @if(!empty( $errors->first('detail')))
                                        <message class="text-danger">- {{ $errors->first('detail') }} </message>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="since">ตั้งแต่วันที่ *</label>
                                        <input id="since" type="date"
                                            class="form-control {{ $errors->first('since') ? ' is-invalid' : '' }}"
                                            name="since" value="{{ !empty($data->since) ? $data->since: old('since') }}">
                                        @if ($errors->first('since'))
                                        <message class="text-danger">{{ $errors->first('since') }}</massage>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">ถึงวันที่ *</label>
                                        <input id="todate" type="date"
                                            class="form-control {{ $errors->first('todate') ? ' is-invalid' : '' }}"
                                            name="todate" value="{{ !empty($data->todate) ? $data->todate: old('todate') }}">
                                        @if ($errors->first('todate'))
                                        <message class="text-danger">{{ $errors->first('todate') }}</massage>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="since">เป็นเวลาทั่งสิ้น *</label>
                                        <input id="since" type="text"
                                            class="form-control {{ $errors->first('alltime') ? ' is-invalid' : '' }}"
                                            name="alltime" value="{{ !empty($data->alltime) ? $data->alltime: old('alltime') }}">
                                        @if ($errors->first('alltime'))
                                        <message class="text-danger">{{ $errors->first('alltime') }}</massage>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="since">โดยการลาครั้งลาสุดของข้าพเจ้าคือ วันที่ *</label>
                                        <input id="since" type="date"
                                            class="form-control {{ $errors->first('#') ? ' is-invalid' : '' }}"
                                            name="#" value="">
                                        @if ($errors->first('#'))
                                        <message class="text-danger">{{ $errors->first('#') }}</massage>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">ถึงวันที่ *</label>
                                        <input id="todate" type="date"
                                            class="form-control {{ $errors->first('#') ? ' is-invalid' : '' }}"
                                            name="#">
                                        @if ($errors->first('#'))
                                        <message class="text-danger">{{ $errors->first('#') }}</massage>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="since">เป็นเวลาทั่งสิ้น *</label>
                                        <input  type="text"
                                            class="form-control {{ $errors->first('#') ? ' is-invalid' : '' }}"
                                            name="#" value="">
                                        @if ($errors->first('#'))
                                        <message class="text-danger">{{ $errors->first('#') }}</massage>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:7px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="contacted">ในระหว่างลาหากมีธุระเรงด่วนสําคัญ
                                            สามารถติดตอข้าพเจ้าไดที่ *</label>
                                        <input id="contacted" type="text"
                                            class="form-control {{ $errors->first('contacted') ? ' is-invalid' : '' }}"
                                            name="contacted" value="{{ !empty($data->contacted) ? $data->contacted: old('contacted') }}">
                                        @if ($errors->first('contacted'))
                                        <message class="text-danger">{{ $errors->first('contacted') }}</massage>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">รูปหลักฐาน</label>
                                <div class="col-sm-8">
                                    <input type="file" name="image" accept="image/*">
                                </div>

                            </div>
@endforeach
                            <div class="col-md-12" style="margin-top:30px; text-align:center;">
                                <button type="submit" class="btn btn-primary"
                                    class="btn btn-success btn-send">บันทึก</button>
                            </div>
                            <div class="form-group col-md-12" style="margin-left:270px;">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
