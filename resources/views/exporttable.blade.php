<table class="table-main">
        <thead>
            <tr>
            <th><strong>ID</strong></th>
            <th><strong>Date</strong></th>
            <th><strong>File</strong></th>
            <th><strong>Hash Code</strong></th>
            <th><strong>Original File Id</strong></th>
            <th><strong>Admin</strong></th>
            <th><strong>IP</strong></th>
            <th><strong>Browser</strong></th>
            <th><strong>Remarks</strong></th>
            </tr>
        </thead>
        <tbody>
          @if($datas)
            @foreach($datas as $data)
            <tr>
            <td>{{$log->id}}</td>
            <td>{{$log->created_at}}</td>
            <td>{{$log->FileUploaded}}</td>
            <td>{{$log->FileSHA256value}}</td>
            <td>{{$log->OriginalFileID}}</td>
            <td>{{$log->Admin}}</td>
            <td>{{$log->Ip_add}}</td>
            <td>{{$log->Http_browser}}</td>
            <td>{{$log->Remarks}}</td>
            </tr>
            @endforeach
          @else
          @endif
        </tbody>
        </table>