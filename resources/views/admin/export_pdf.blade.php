@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-7" align="right">
            <h4>ข้อมูลการลาทั้งหมด</h4>
        </div>
        <div class="col-md-5" align="right">
            <a href="{{ url('admin\export_pdf/pdf') }}" class="btn btn-danger">Convert into PDF</a>
            <a href="{{ url('admin\export') }}" class="btn btn-primary">Convert into Excel</a>
        </div>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>รหัสมาชิก</th>
                    <th>ชื่อสมาชิก</th>
                    <th>ตำแหน่ง</th>
                    <th>ฝ่าย/แผนก</th>
                    <th>หมายเหตุการลา</th>
                    <th>วันที่ลา</th>
                    <th>ถึงวันที่</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer_data as $customer)
                <tr>
                    <th>{{$loop->iteration }}</th>
                    <td>{{ $customer->userid }}</td>
                    <td>{{ $customer->prefix }} {{ $customer->username }} {{ $customer->lastname }}</td>
                    <td>{{ $customer->position }}</td>
                    <td>{{ $customer->department }}</td>
                    <td>{{ $customer->vacation_Name }}</td>
                    <td>{{ date('d-M-Y', strtotime($customer->since)) }}</td>
                    <td>{{ date('d-M-Y', strtotime($customer->todate)) }}</td>
                    <td>{{ $customer->alltime }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
