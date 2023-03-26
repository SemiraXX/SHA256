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
        <div class="input-group teamgroupdiv">
        <button type="submit" class="add-team-button checkfile"> Check new file </button>
        <input type="text" class="searchinput" placeholder="Type Here" name="search">
        </div>

     
        <table class="table-main">
        <thead>
            <tr>
            <th>ID</th>
            <th>File</th>
            <th>File SHA256</th>
            <th>Original File</th>
            <th>Remarks</th>
            <th style="width:100px">Date</th>
            <th> </th>
            </tr>
        </thead>
        <tbody>
        <?php $reports = DB::table('tbl_reports')->orderby('id', 'Desc')->get(); ?>
          @if($reports)
            @foreach($reports as $report)
            <tr>
            <td>{{$report->id}}</td>
            <td>{{$report->FileUploaded}}</td>
            <td>{{$report->FileSHA256value}}</td>
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