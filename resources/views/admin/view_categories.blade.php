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

                <div class="title_right">

                  <form name="Searchfrm" action="{{ url('searchCategories')}}" method="post" role="search">

                    @csrf

                    <input type="hidden" name="per_page" value="" />

                    <div class="col-md-10 col-sm-5 col-xs-12 pull-right top_search">

                      <div class="col-md-10 col-sm-5 col-xs-12 pull-right top_search">



                        <div class="input-group">

                          <select name="user_id" id="user_id" class="form-control" >

                            <option value="">Select User</option>

                             @foreach($users as $c)

                              <option value="{{ $c->id }}">{{ $c->name  }}</option>

                            @endforeach

                          </select>

                          <span class="input-group-btn" style="width: 40%;">

                        

                          <input type="text" class="form-control" name="title" placeholder="Search Category..." value="{{ $title  ? $title : "" }}">

                        </span>

                          <span class="input-group-btn">

                              <button class="btn btn-default" type="submit">Go!</button>

                          </span>

                        </div>

                      </div>

                    </div>

                  </form>

                </div>

                <table id="example" class="table table-striped responsive-utilities jambo_table">

                    <thead>

                        <tr class="headings">

                            <th>#</th>

                            <th>User name</th>

                            <th>Title</th>

                            <th>Description</th>

                            <th>Sort Order</th>

                            <th>Action</th>

                            

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php 

                        $i=1;

                        $user_name="";

                        @endphp

                        @if(isset($categories))

                        @foreach($categories as $c)

                        @php 
                        if($c->user_id == "0"){
                          $user_name ="Admin";
                        }else{
                        $user_name = App\User::where('id', $c->user_id)->pluck('name')->first();
                        }
                         @endphp

                        <tr class="odd pointer">

                          <td>{{ $i }}</td>

                          <td>{{ $user_name }}</td>

                          <td>{{ $c->title }}</td>

                          <td>{!!substr($c->description, 0, 60)!!}.....</td>

                          <td>{{ $c->sort_order }}</td>

                          <td>

                            <a href="{{url('edit-category',$c->id)}}" class="btn btn-success btn-sm">Edit</a>

                            <a href="{{url('delete-category',$c->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Remove?')">Delete</a>



                          </td>

                         

                      </tr>

                        @php $i++; @endphp

                        @endforeach

                        @endif

                        @if(!isset($categories))

                        <tr class="odd pointer">

                          <td colspan="6" style="color: red" align="center">Data are not available!</td>

                         



                          </td>

                        @endif

                    </tbody>

                </table>
            </div>

        <p>{{ $categories->links() }}</p>    

    </div>

    <div class="clear"></div>

  </div>


<script>

    $(document).ready(function(){

        $("#user_id").val('{{ $user_id }}');

    });

    

</script>

@endsection