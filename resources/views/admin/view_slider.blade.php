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

                            <th>Image</th>

                            <th>Title</th>

                            <th>Description</th>

                            <th>Action</th>

                            

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php $i=1;

                        @endphp

                        @foreach($sliders as $slider)

                       

                        <tr class="odd pointer">

                          <td>{{ $i }}</td>

                          <td><img src="{{ asset('/images/slider/'.$slider->image) }}" style="width: 150px; height: 150px;"></td>

                          <td>{{ $slider->title }}</td>

                          <td>{!!substr($slider->description, 0, 60)!!}.....</td>

                          <td>

                            <a href="{{url('edit-slider',$slider->id)}}" class="btn btn-success btn-sm">Edit</a>

                            <a href="{{url('delete-slider',$slider->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Remove?')">Delete</a>



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