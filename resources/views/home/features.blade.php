@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')
<body>
	@if(isset($preferences))
    <header>
        <div class="container">
            <div class="row">
            	<div class="col-xs-12 text-center px-3 py-5"  data-aos="fade-up" data-aos-duration="2000">
            		<h2>{{$preferences_descriptions->feature_title}}</h2>
            		<p >{!!($preferences_descriptions->feature_description)!!}</p>
            	</div>
    	  </div>
        </div>
    </header>
  <section class="my-5 features">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-offset="150" data-aos-duration="2000">
                <div class="text-right my-5">
                    <h3>{{$preferences_descriptions->sub_heading1}}</h3>
                    <p>{!!($preferences_descriptions->sub_description1)!!}</p>
                </div>
                <div class="text-right my-5">
                    <h3>{{$preferences_descriptions->sub_heading2}}</h3>
                    <p>{!!($preferences_descriptions->sub_description2)!!}</p>
                </div>
                <div class="text-right">
                    <h3>{{$preferences_descriptions->sub_heading3}}</h3>
                    <p>{!!($preferences_descriptions->sub_description3)!!}</p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('/images/Features/'.$preferences->feature_image1) }}" class="img-responsive">
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-offset="150" data-aos-duration="2000">
                <div class="text-left my-5">
                    <h3>{{$preferences_descriptions->sub_heading4}}</h3>
                    <p>{!!($preferences_descriptions->sub_description4)!!}</p>
                </div>
                <div class="text-left my-5">
                    <h3>{{$preferences_descriptions->sub_heading5}}</h3>
                    <p>{!!($preferences_descriptions->sub_description5)!!}</p>
                </div>
                <div class="text-left">
                    <h3>{{$preferences_descriptions->sub_heading6}}</h3>
                    <p>{!!($preferences_descriptions->sub_description6)!!}</p>
                </div>
            </div>
        </div>
    </div>
  </section>

    @if(isset($pages))
        @php 
           $i = 1;
        @endphp
    <section id="plans" class="padd-0 features">
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
					<div id="desc" class="mb-4 content-padd fc-padd" data-aos="fade-up" data-aos-offset="150" data-aos-duration="2000">
                        <h1>{{$page_relation->title ?? ""}}</h1>
                        <p>{!!($page_relation->body ?? "")!!}</p>
					</div>			
				</div>
				<div class="col-md-6">
					<div class="text-right"><img src="{{ asset('/images/sections/'.$page->image) }}" class="img-responsive"></div>
				</div>
			</div>
            @else
			<div class="row my-5">
				<div class="col-md-6">
					<div class="text-left"><img src="{{ asset('/images/sections/'.$page->image) }}" class="img-responsive"></div>
				</div>
				<div class="col-md-6 center-content" style="border-radius: 0px 40px 0px 0px;">
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
