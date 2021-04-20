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

                            <th>Profile</th>

                            <th>Name</th>

                            <th>Designation</th>

                            <th>Description</th>

                            <th>Sort Order</th>

                            <th>Action</th>

                            

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php $i=1;

                        @endphp

                        @foreach($testimonials as $t)

                       

                        <tr class="odd pointer">

                          <td>{{ $i }}</td>

                          <td><img src="{{ asset('/images/testimonials/'.$t->image) }}" style="width: 50px; height: 50px;"></td>

                          <td>{{ $t->testimonial_name }}</td>

                          <td>{{ $t->designation }}</td>

                          <td>{!!substr($t->description, 0, 60)!!}.....</td>

                          <td>{{ $t->sort_order }}</td>

                          <td>

                            <a href="{{url('edit-testimonial',$t->id)}}" class="btn btn-success btn-sm">Edit</a>

                            <a href="{{url('delete-testimonial',$t->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Remove?')">Delete</a>



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