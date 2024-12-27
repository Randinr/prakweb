@extends('master') 
@section('title', 'Edit News') 
@section('addCss') 
<!--Summer note--> 
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"> 
@endsection 
 
@section('content') 
<div class="card-body"> 
    @if (count($errors) > 0) 
    <div class="alert alert-danger"> 
        <ul> 
            @foreach ($errors->all() as $error) 
            <li>{{ $error }}</li> 
            @endforeach 
        </ul> 
    </div> 
    @endif 
 
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
    <!-- general form elements --> 
    <div class="card card-primary"> 
        <form method="post" enctype="multipart/form-data" action="{{ route('index.update', $id_news->id_news) }}"> 
            @csrf 
           @method('put') 
            <div class="card-body"> 
                <div class="form-group col-sm-6"> 
                    <label for="exampleInputEmail1">Title</label> 
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="title" value="{{ $id_news->title }}"> 
                </div> 
                <div class="form-group col-sm-6"> 
                    <label for="exampleInputPassword1">File</label> 
                    <input type="file" class="form-control" id="exampleInputPassword1" name="file"> 
                    {{-- @if(!empty($id_news->name_file)) 
                        <img src="{{url('image')}}/{{$id_news->name_file}}" alt=""class="rounded" style="width: 100%; max-width: 100px; height: auto;"> 
                    @endif --}} 
                    @if(isset($id_news->name_file) && !empty($id_news->name_file)) 
                    <img src="{{ url('image/' . $id_news->name_file) }}" alt="Foto Produk" class="rounded" style="width: 100%; max-width: 100px; height: auto;"> 
                    @else 
                    <img src="{{ url('image/nophoto.jpg') }}" alt="No Foto" class="rounded" style="width: 100%; max-width: 100px; height: auto;"> 
                    @endif 
                </div> 
                <div class="form-group col-sm-6"> 
                    <label for="exampleInputPassword1">Content</label> 
                    <textarea id="summernote" name="content"> 
                    {{ $id_news->content }} 
                    </textarea> 
                </div> 
 
            </div> 
            <!-- /.card-body --> 
 
            <div class="card-footer"> 
                <button type="submit" class="btn btn-primary">Submit</button><br><a href="/news"> &lt;&lt; Back page news</a> 
            </div> 
        </form> 
    </div> 
   <!-- /.card --> 
</div> 
@endsection 
 
@section('addJs') 
<!--Summer note--> 
<script src="plugins/summernote/summernote-bs4.min.js"></script> 
 
<script> 
    $(function() { 
        // Summernote 
        $('#summernote').summernote() 
    }) 
</script> 
@endsection 
 
