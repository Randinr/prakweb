@extends('master') 
@section('title', 'News') 
@section('addCss') 
<!-- DataTables --> 
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> 
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> 
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> 
@endsection 
@section('content') 
<div class="card-body"> 
    @if(session('success')) 
    <div class="alert alert-success"> 
        {{ session('success') }} 
    </div> 
    @endif 
 
    @if(session('failed')) 
    <div class="alert alert-danger"> 
        {{ session('failed') }} 
    </div> 
    @endif 
    <div class="col-sm-2"> 
        <a href="/addNews" class="btn btn-block btn-success"><i class="fas fa-plus"> Add Data News</i></a><br> 
    </div> 
 
    <table id="example1" class="table table-bordered table-striped"> 
        <thead> 
            <tr> 
                <th>No. </th> 
                <th>Title</th> 
    <th>File</th> 
                <th>Content</th> 
                <th>Created At</th> 
                <th>Action</th> 
            </tr> 
        </thead> 
        <tbody> 
            @foreach ( $news as $k ) 
            <tr> 
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $k->title }}</td> 
                <td> 
                    @empty($k->name_file) 
                    <img src="{{url('image/nophoto.jpg')}}" alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;"> 
                    @else 
                    <img src="{{url('image')}}/{{$k->name_file}}" alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;"> 
                    @endempty 
                </td> 
                <td>{{ $k->content }}</td> 
                <td>{{ $k->created_at }}</td> 
                <td> 
                    <a href="{{ route('index.edit', $k->id_news) }}" class="btn btn-sm btnwarning">edit</a> 
                    <a href="#" class="btn btn-danger btn-sm" onclick="getConfirm('{{ route('index.delete', $k->id_news) }}')">hapus</a> 
                    <!-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$k->id}}">                         hapus 
                    </button> --> 
                </td> 
            </tr> 
            @endforeach 
        </tbody> 
    </table> 
</div> 
@endsection 
@section('addJs') 
<!-- DataTables  & Plugins --> 
<script src="plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> 
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> 
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> 
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> 
<script src="plugins/jszip/jszip.min.js"></script> 
<script src="plugins/pdfmake/pdfmake.min.js"></script> 
<script src="plugins/pdfmake/vfs_fonts.js"></script> 
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script> <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script> 
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> 
<!-- Page specific script --> 
<script>     
function getConfirm(url) {         
    asked = confirm('Are you sure you want to delete this data?');         
    if (asked == true)             
    location.href = url;         
    else 
        return false; 
    } 
    $(function() { 
        $("#example1").DataTable({ 
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"] 
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)'); 
    }); 
</script> 
@endsection 
