
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
 
        body {
            font-family: "THSarabunNew";
        }
    </style>
   </head>
   <body>
   <table>
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

   </body>
   </html>
       

