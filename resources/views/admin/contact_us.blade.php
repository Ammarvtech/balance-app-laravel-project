@extends('layouts.adminlayout.admin_design')

@section('content')

<div class="">

	<div class="row top_tiles">

	 	<div class="row">

			<div class="col-md-12">

				<h3> {{$page_title}}</h3>



				<!-- Errors and success -->

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

				<!-- End of Errors and success -->

				<table id="example" class="table table-striped responsive-utilities jambo_table">

					<thead>

						<tr class="headings">

							<th>Name</th>		

							<th>Email</th>

							<th>Phone</th>

							<th>Message</th>

						<!-- 	<th>Status</th> -->

							<th>Action</th>

							

							</th>

						</tr>

					</thead>

					<tbody>

			          	@foreach($contacts as $c)

			            <tr class="odd pointer">

			              <td>{{ $c->name }}</td>	              

			              <td>{{ $c->email }}</td>

			              <td>{{ $c->phone }}</td>

			              <td>{{ $c->message }}</td>

<!-- 			              @if($c->status == NULL)

			              <td>Response Pending</td>

			              @else

			              <td style="color: blue;"><strong>Response Done!</strong></td>

			              @endif-->

			              <td> 

			              <a id="delCat" href="{{ url('delete-contact/'.$c->id) }}" class="btn btn-danger btn-mini">Delete</a><!--<a id="delCat" href="{{ url('add-mail/'.$c->id) }}" class="btn btn-info btn-mini">Send Message</a>--></td>

			             

			          </tr>



			          	@endforeach

		          	</tbody>

				</table>

			</div>

			<p>{{ $contacts->links() }}</p>

		</div>

	</div> 

</div>

@endsection