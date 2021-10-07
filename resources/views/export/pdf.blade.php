<!DOCTYPE html>
<html>

<head>
    <title>{{$data['tittle']}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h4>{{ $data['tittle'] }}</h4>
        <p>{{ $data['sub_tittle']}}</p>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                @foreach($data['arr_field'] as $key => $val)
                @if(isset($val['table']) && $val['table'])
                <th>{{ $val['label'] }}</th>
                @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php $i = 0 @endphp
            @foreach ($data['datas'] as $b)
            <tr>
                <td>{{ ++$i  }}</td>
                @foreach($data['arr_field'] as $key => $val)
                @if(isset($val['table']) && $val['table'])
                @if($val['form_type'] == 'date')
                <td>{{ \Carbon\Carbon::parse($b[$key])->format('d, M Y h:i') }}</td>
                @elseif($val['form_type'] == 'select')
                <td>{{ $val['keyvaldata'][$b[$key]] }}</td>
                @else
                <td>{{ $b[$key]}}</td>
                @endif
                @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>