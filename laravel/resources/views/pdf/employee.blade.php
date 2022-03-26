<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Employees {{ $title }}</title>
</head>

<body style='font-family:Tahoma; color: #333333; background-color:#FFFFFF;'>
  <div style="display: flex; justify-content: center;">
    <table cellpadding='0' cellspacing='0' style='height:842px; width:595px;'>
      <tr>
        <td valign='top'>
          <table width='100%' cellspacing='0' cellpadding='0'>
            <tr>
              <td width='85%'>
                <div>
                  <h1>{{ $title }}</h1>
                </div>
              </td>

              <td style="float: right; margin-top: 25px;">
                <a><strong style="font-size: 14px;">INVOICE</strong> <br>
                  <a style="font-size: 12px; font-weight:0"> Date {{ date('d/m/Y') }}</a>
                </a>
              </td>
            </tr>
          </table>
          <hr>
          <table width='100%' cellspacing='0' cellpadding='0' style="margin: 20px 0 20px 0;">
            <tr>
              <td>
                <div style='font-size: 18px; font-weight: bold;'>List Employees </div>
              </td>
            </tr>
          </table>

          <table width='100%' cellspacing='0' cellpadding='2' style="border: 1px;" bordercolor='#CCCCCC'>
            <tr height='40' style="font-size:14px; background-color:#f2f2f2">
              <td bordercolor='#ccc' style='text-align:center;'><strong>No. </strong></td>
              <td bordercolor='#ccc'><strong>Name</strong></td>
              <td bordercolor='#ccc'><strong>Email</strong></td>
              <td bordercolor='#ccc'><strong>Added</strong></td>
            </tr>

            <tr style="display: none;">
              <td colspan="*">
                @if (count($employees) > 0)
                @foreach ($employees as $employee)
            <tr height='30' style='font-size:12px;'>
              <td style='text-align:center'>{{ $loop->iteration }}.</td>
              <td style=>{{ $employee->name }}</td>
              <td style=>{{ $employee->email }}</td>
              <td style=>{{ $employee->created_at }}</td>
            </tr>
            @endforeach
            @else
            <tr>
              <td style="text-align: center;" colspan="4">Tidak ada data</td>
            </tr>
            @endif
        </td>
      </tr>
    </table>
    </td>
    </tr>
    </table>
  </div>
</body>

</html>