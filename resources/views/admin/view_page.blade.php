@extends('layouts.adminlayout.admin_design')
@section('content')

<div class="">
    <div class="row top_tiles">
        <div class="row">
            <div class="col-md-12">
                <!-- Errors -->
                <div class="clearfix"></div>
                @if(Session::has('flash_message_error'))
                  <div class="alert alert-error alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{!! session('flash_message_error') !!}</strong>
                  </div>
                @endif   
                @if(Session::has('flash_message_success'))
                  <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{!! session('flash_message_success') !!}</strong>
                  </div>
                @endif
                <!-- End erros and success info -->
                <h3> {{$page_title}}</h3>
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>#</th>
                            <th>Page Type</th>
                            <th>Profile</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                            
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1;
                        @endphp
                        @foreach($pages as $t)
                       
                        <tr class="odd pointer">
                          <td>{{ $i }}</td>
                          <td>{{ $t->type }}</td>
                          <td><img src="{{ asset('/images/sections/'.$t->image) }}" style="width: 150px; height: 150px;"></td>
                          <td>{{ $t->title }}</td>
                          <td>{!!substr($t->body, 0, 20)!!}.....</td>
                          <td>{{ $t->sort_order }}</td>
                          <td>
                            <a href="{{url('edit-page',$t->id)}}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{url('delete-page',$t->id)}}" class="btn btn-danger btn-sm">Delete</a>
                          </td>
                      </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
      
        </div>
    </div> 
</div>
<script>
        ckeditor.replace( 'details' );
</script>
@endsection