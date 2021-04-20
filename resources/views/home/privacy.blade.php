@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')
<body>
	
  @if(isset($preferences))
    <header>
    	<div class="col-xs-12 text-center py-5">
    		<h2>{{$preferences_descriptions->policy_title}}</h2>
    		<p class="px-2">{!!($sliders->description)!!}</p>

    	</div>
    </header>
    @if(isset($pages))
    <section>
      @foreach($pages as $key => $page)
        @php
          $page_relation=$page->pages_description->first(); 
          //dd($page_relation);
        @endphp 
      		<div class="container privacy-content">
      			<div class="row">
      				<div class="col-xs-12" style="margin-top: 104px; margin-bottom: 125px">
      					<p class="px-3">{!!($page_relation->body ?? "")!!}</p>
      				</div>
      			</div>
      		</div>
      @endforeach
    </section>
    @endif
  @endif
      <script>
              ckeditor.replace( 'details' );
      </script>
@include('layouts.homelayouts.footer')
