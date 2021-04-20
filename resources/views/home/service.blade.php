@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body>
   @if(isset($preferences))     
    <header>
    	<div class="container">
    	    <div class="row">
    	        <div class="col-xs-12 text-center py-5" data-aos="fade-up" data-aos-duration="2000">
            		<h2>{{$preferences_descriptions->service_title}}</h2>
            		<p class="px-2">{!!($preferences_descriptions->service_description)!!}</p>
            	</div>
    	    </div>
    	</div>
    </header>

    <section id="customer-service">
    	<div class="cs-wrapper container mt-5 mt-100">
    		<div class="row">
    			<div class="col-xs-12 col-md-8 acc-margin-b-sm">
    				<div class="bs-example">
    					<h3>{{$preferences_descriptions->faq_heading}}</h3>
					    <div class="accordion" id="accordionExample">
                            @if(isset($faqs))
                                @foreach($faqs as $key => $faq)
                                @php
                                   $faq_relation=$faq->faq_description->first(); 
    			                   //  dd($faq_relation);
                                @endphp
							    	<div class="">
							            <div class="cheader" id="headingOne-{{ $key }}">
							                <h2 class="mb-0">
							                    <button type="button" class="btn btn-link @if($key == 0)collapsed @endif" data-toggle="collapse" data-target="#collapseOne-{{ $key }}">{{$faq_relation->question}} <i class="fa fa-plus"  style="color: #000"></i></button>
							                </h2>
							            </div>
							            <div id="collapseOne-{{ $key }}" class="collapse @if($key == 0) @endif" aria-labelledby="headingOne-{{ $key }}" data-parent="#accordionExample">
							                <div class="cbody">
							                    <p>{!!($faq_relation->answer)!!}</p>
							                </div>
							            </div>
							        </div>
							    @endforeach
					        @endif

					    </div>
					</div>
    			</div>
    			<div class="col-md-4 c-form">
                    <h3 class="h32b text-left">@lang('frontend.write_to_us')</h3>
    				@if($errors->any())
    				   <div class="alert alert-danger">
    				     @foreach($errors->all() as $error)
    				       {{ $error }} <br>
    				     @endforeach
    				   </div>
    				 @endif
    				 @if(Session::has('flash_message_success'))
    				   <div class="alert alert-success alert-block">
    				     <button type="button" class="close" data-dismiss="alert">×</button> 
    				     <strong>{!! session('flash_message_success') !!}</strong>
    				   </div>
    				 @endif
					<form  action="{{url('save-contacts')}}" method="POST">
						@csrf
                            <div class="form-group">
                                <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" placeholder="@lang('frontend.name')" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" value="{{old('email')}}" id="email" name="email" placeholder="@lang('frontend.email')" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="ph-phone" value="{{old('phone')}}" name="phone"  placeholder="@lang('frontend.phone_number')" required>
                            </div>
                            <div class="form-group">
                                <textarea id="message" name="message" placeholder="@lang('frontend.message')" style="height:100px;width: 100%">{{old('message')}}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" grecaptcha.render(container,parameters) data-sitekey="{{env('Captcha_Key')}}"></div>
                            </div>       
                            <div class="form-group">        
                                <input type="submit" value="@lang('frontend.send')" class="btn btn-outline-dark">
                            </div>
					</form>
    			</div>
    		</div>
    	</div>
    </section>

    <section id="user-stories">
    	<div class="container">
    		<div data-aos="fade-down" data-aos-duration="1000"><h2>{{$preferences_descriptions->story_title}}</h2></div>
    		<div data-aos="fade-down" data-aos-duration="1000"><p class="mt-2">{!!($preferences_descriptions->story_description)!!}</p></div>
    		<div class="row mt-5" data-aos="fade-up" data-aos-duration="3000" data-aos-duration="500">
    			@if(isset($testimonials))
    			    @foreach($testimonials as $key => $testimonial )
    			    @php
    			       $testimonial_relation=$testimonial->testimonial_description->first(); 
    			       //dd($testimonial_relation->description);
    			    @endphp
		    			<div class="col-md-4 mb-3">
		    				<div class="card">
		    					<div class="card-body">
		    						<img src="{{ url('assets/home/img/comma.png')}}">
		    						<p class="">{!!($testimonial_relation->description)!!}</p>
		    						<h5 class="mt-5 mb-3">{{$testimonial_relation->testimonial_name}}</h5>
		    						<img src="{{ asset('/images/testimonials/'.$testimonial->image) }}">
		    					</div>
		    				</div>
		    			</div>
		    			@endforeach
    				@endif
    			</div>
    		</div>
    	</div>
    </section>

 @endif
@include('layouts.homelayouts.footer')

<script>
    $(function(){
      function rescaleCaptcha(){
        var width = $('.g-recaptcha').parent().width();
        var scale;
        if (width < 302) {
          scale = width / 302;
        } else{
          scale = 1.0; 
        }
    
        $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
        $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
        $('.g-recaptcha').css('transform-origin', '0 0');
        $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
      }

        rescaleCaptcha();
        $( window ).resize(function() { rescaleCaptcha(); });
    });
</script>
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
            $(this).prev(".cheader").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".cheader").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
            $(this).prev(".cheader").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>

<!-- <script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){

        	$(this).prev(".").find(".fa").addClass("fa-minus").removeClass("fa-plus");

        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapsed").on('show.bs.collapse', function(){

        	$(this).prev(".").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script> -->
</html>