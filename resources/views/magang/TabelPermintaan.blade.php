{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
    .table{
        margin-top: 4%;
    }
  </style>
</head>
<body> --}}
    {{-- Session Flash Message  --}}

  {{-- Search --}}
    {{-- <div class="d-flex justify-content-end gap-2 ms-auto me-3">
  <form action="{{ route('tabelpermintaan.TabelPermintaanIndex') }}" method="GET" class="input-group" style="max-width: 300px;">
    <input
      class="form-control"
      type="text"
      placeholder="Search"
      aria-label="Search"
      name="search"
      value="{{ $search ?? '' }}">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  </div>


<table class="table table-striped position-fixed-top shadow-lg p-3 mb-5 bg-body-tertiary rounded ">

  <thead class="table-primary text-center">
    <tr>
      <th scope="col" style="background-color: #7762C9">NO</th>
      <th scope="col" style="background-color: #7762C9"> NIK SAP</th>
      <th scope="col" style="background-color: #7762C9">Nama Mentor</th>
        <th scope="col" style="background-color: #7762C9">No WA Mentor</th>
          <th scope="col" style="background-color: #7762C9">Batch</th>
            <th scope="col" style="background-color: #7762C9">UnitKerja</th>
              <th scope="col" style="background-color: #7762C9">Tahun</th>
              <th scope="col" style="background-color: #7762C9">Bagian</th>
                <th scope="col" style="background-color: #7762C9">Jurusan</th>
                <th scope="col"style="background-color: #7762C9">Judul PA</th>
                  <th scope="col" style="background-color: #7762C9">File Excel</th>
    </tr>
  </thead>
 <tbody>
@foreach($tabelpermintaan as $datatabel)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $datatabel->NIK_SAP }}</td>
    <td>{{ $datatabel->Nama_Mentor }}</td>
    <td>{{ $datatabel->NO_WA_Mentor }}</td>
    <td>{{ $datatabel->Batch }}</td>
    <td>{{ $datatabel->UnitKerja }}</td>
    <td>{{ $datatabel->tahun }}</td>
    <td>{{ $datatabel->Bagian }}</td>
    <td>{{ $datatabel->Jurusan }}</td>
    <td>{{ $datatabel->JudulPA }}</td>
     <td>
      {{-- @if ($datatabel->FileExcel)
        <a href="{{ asset('uploads/excel/' . $datatabel->FileExcel) }}" target="_blank" class="btn btn-sm btn-success" download>
          download
        </a>
      @else --}}

         {{-- @if ($datatabel->FileExcel)
  <a href="{{ route('download.downloadExcel', ['filename' => $datatabel->FileExcel]) }}" class="btn btn-sm btn-success">
          download
        </a>
      @else

      @endif
    </td>

  </tr>
@endforeach
</tbody>

</body> --}}
{{-- </html>  --}}
