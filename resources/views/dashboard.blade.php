<!DOCTYPE html>
<html lang="en">
<head>
  <title>SHA256-Hashing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="/css/css1.css" rel="stylesheet">
  @include('bootstrap.main')
</head>
<body>

<div class="row">

  <div class="col-sm-2 sidebarcol" style="background-color:#54389E">
      @include('sidebar')
  </div>

  <div class="col-sm-10">
    @include('popups')
    <div class="main-container">
    <br>
        <p class="pagetitle">Reports</p>
        <p class="inputlabel">Generated reports from checked file</p>
        <br>
        <form method="get"> 
        <div class="input-group teamgroupdiv">
          <div>
          <a href="/Dashboard">
          <button type="button" class="table-button"> <i class="fa fa-history" aria-hidden="true"></i> Refresh </button>
          </a>
          <button type="submit" formaction="{{ route('direct.export') }}" class="table-button"> <i class="fa fa-download" aria-hidden="true"></i> Download to Excel </button>
          </div>
          <div>
            @if(!empty($dateform) && !empty($dateto))
            <input type="datetime-local" class="searchinput" name="datefrom" value="{{$dateform}}">
            <label>To</label>
            <input type="datetime-local" class="searchinput" name="dateto" value="{{$dateto}}">
            @else
            <input type="datetime-local" class="searchinput" name="datefrom">
            <label>To</label>
            <input type="datetime-local" class="searchinput" name="dateto">
            @endif
            <button type="submit" formaction="{{ route('sort.export') }}" class="table-button"> Sort List </button>
          </div>
        </div></form>

     
        <table class="table-main">
        <thead>
            <tr>
            <th>ID</th>
            <th style="width:200px">File</th>
            <th>File SHA256</th>
            <th>Original File</th>
            <th>Remarks</th>
            <th style="width:100px">Date</th>
            <th> </th>
            </tr>
        </thead>
        <tbody>
          @if($reports)
            @foreach($reports as $report)
            <?php $maskvalue = substr_replace($report->FileSHA256value, str_repeat('*', strlen($report->FileSHA256value)-7), 1, -6); ?>
            <tr>
            <td>{{$report->id}}</td>
            <td>{{$report->FileUploaded}}</td>
            <td>{{$maskvalue}}</td>
            <td>{{$report->OriginalFileID}}</td>
            <td>{{$report->Remarks}}</td>
            <td>{{$report->created_at}}</td>
            <td><button type="button" id="{{$report->id}}" class="view-report-button"> view </button></td>
            </tr>
            @endforeach
          @else
          @endif
        </tbody>
        </table>
        <br><br>
    </div>

  </div>

</div>

@include('modals.report')
<script src="/js/modal.js"></script>

</body>
</html>