@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')


<body>
    @if(isset($preferences))
    <header>
    	<div class="container">
    	    <div class="row">
    	        <div class="col-sm-12 col-md-12 text-center py-5" data-aos="fade-up" data-aos-duration="2000">
            		<h2>{{$preferences_descriptions->safet_title}}</h2>
            		<p class="px-2">{!!($preferences_descriptions->safety_description)!!}</p>
            	</div>
    	    </div>
    	</div>
    </header>


	@if(isset($pages))
	@php 
	$i = 1; @endphp
	<section id="plans" class="padd-0 security">
		<div class="container my-5">
			@foreach($pages as $key => $page)
			@php
			    $page_relation=$page->pages_description->first(); 
			    //dd($page_relation);
			@endphp 
			    @if($i%2 == 1)
				<div class="row">
				<div class="col-md-6 content-bg">
				    <div class="triangle-right"></div>					
					<div id="desc" class="mb-4 content-padd" data-aos="fade-up" data-aos-offset="150" data-aos-duration="2000">
                        <h1>{{$page_relation->title ?? ""}}</h1>
						<p>{!!($page_relation->body ?? "")!!}</p>
					</div>			
				</div>
				<div class="col-md-6">
					<div class="text-right"><img src="{{ asset('/images/services/'.$preferences->safety_image1) }}" class="img-responsive"></div>
				</div>
			</div>
		
			@else
			<div class="row my-5">
				<div class="col-md-6">
					<div class="text-left"><img src="{{ asset('/images/services/'.$preferences->safety_image2) }}" class="img-responsive"></div>
				</div>
				<div class="col-md-6 center-content">
				    <div class="triangle-left"></div>					
					<div id="desc" class="mb-4 content-padd fc-padd" data-aos="fade-up" data-aos-offset="150" data-aos-duration="2000">
                        <h1>{{$page_relation->title ?? ""}}</h1>
						<p>{!!($page_relation->body ?? "")!!}</p>
					</div>							
				</div>
			</div>
			
	         @endif
            @php $i++; @endphp
        @endforeach
		</div>
	</section>
    @endif


	@endif

@include('layouts.homelayouts.footer')
