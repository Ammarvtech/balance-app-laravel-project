@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')
<body>
    
    <header>
        @if(isset($sliders))
        @php
            $slider_relation=$sliders->slider_description->first(); 
            //  dd($faq_relation);
        @endphp
                <div class="col-xs-12 text-center pt-5 px-2">        
                    <div data-aos="fade-up" data-aos-duration="2000"><h2>{{$slider_relation->title}}</h2></div>
                    <div data-aos="fade-up" data-aos-duration="2000"><p class="px-2">{!!($slider_relation->description)!!}</p></div>
                    <a href="{{$preferences->footer_link}}" target="_blank"><div class="my-4"><img src="{{ asset('/images/slider/'.$sliders->baner) }}" style="width:150px;"></div></a>
                    <div class="home-header-img"><img src="{{ asset('/images/slider/'.$sliders->image) }}" class="img-responsive-sm"></div>
                </div>
        @endif
        <div class="header-bottom"></div>
    </header>
    @if(isset($preferences))
    <section id="features">
        <div class="container py-5">
            <div data-aos="fade-down" data-aos-duration="1000">
                <h4 class="text-capitalize text-center">{{$preferences_descriptions->home_feature_title}}</h4>
            </div>
            <div data-aos="fade-down" data-aos-duration="1000">
                    <p class="text-center text-faded">{!!($preferences_descriptions->home_feature_description)!!}</p>
            </div>
            <div class="row mt-5" data-aos="fade-up" data-aos-duration="3000" data-aos-duration="500">
                
                @if(isset($features))
                    @foreach($features as $feature)
                    @php
                       $feature_relation=$feature->feature_description->first(); 
                    @endphp
                        <div class="col-md-3 text-center mb-5">
                            <div class="p-4 mx-auto">
                                <img src="{{ asset('/images/Features/'.$feature->image) }}">
                                <h5 class="mt-5">{{ $feature_relation->title }}</h5>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    
     @if(isset($pages))
     @php 
     $i = 1; @endphp
    <section id="plans">
        <div class="container my-5">
            @foreach($pages as $key => $page)
            @php
                $page_relation=$page->pages_description->first(); 
                //dd($page_relation);
            @endphp 
                @if($i%2 == 1)
            <div class="row">
                <div class="col-md-6 my-auto" data-aos="fade-up" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="2000">                  
                    <div id="title" class="mb-5">
                        <h1><a href="">{{$page_relation->title ?? ""}}</a></h1>
                    </div>
                    <div id="desc" class="mb-5 txt-22-reg">
                        <p>{!!($page_relation->body ?? "")!!}</p>
                    </div>
                    <div id="button" class="mb-3">
                        <a href="javascript:;" class="km-btn">@lang('frontend.know_more')</a>
                    </div>                      
                </div>
                <div class="col-md-6">
                    <div class="text-right"><img src="
                    {{ asset('/images/sections/'.$page->image) }}" class="img-responsive"></div>
                </div>
            </div>
             @else
            <div class="row">
                <div class="col-md-6">
                    <div class="text-left"><img src="{{ asset('/images/sections/'.$page->image) }}" class="img-responsive"></div>
                </div>
                <div class="col-md-6 my-auto" data-aos="fade-up" data-aos-offset="200" data-aos-duration="2000" data-aos-easing="ease-in-sine">                   
                    <div id="title" class="mb-5">
                        <h1><a href="">{{$page_relation->title ?? ""}}</a></h1>
                    </div>
                    <div id="desc" class="mb-5">
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".p_animation").parent().find("p").attr("data-aos", "fade-down");
    })
</script>