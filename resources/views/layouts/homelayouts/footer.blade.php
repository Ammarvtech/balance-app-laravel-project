@if(isset($preferences))

<section class="track-your-money">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 text-center mx-auto px-2" data-aos="zoom-in" data-aos-duration="2000">     

                <h2 style="margin-bottom: 20px"><a href="">{{$preferences_descriptions->footer_title}}</a></h2> 

                <p>{!!($preferences_descriptions->footer_description)!!}</p>

                <a href="{{$preferences->footer_link}}" target="_blank"><img src="{{url('assets/home/img/app-store-logo-final.svg')}}" style="margin-top: 25px"></a>

            </div>

        </div>

    </div>

</section>

  <footer class="py-4">

    <div class="container text-center">

      <div class="row">

             <div class="col-md-12 f-menu mt-4">

                <a href="{{url('aboutUs')}}" >@lang('frontend.about_us')</a>

                <a href="{{url('features')}}" >@lang('frontend.features')</a>

                <a href="{{url('security')}}" >@lang('frontend.Safety')</a>

                <a href="{{url('services')}}" >@lang('frontend.customer')</a>

                <!--<a href="{{url('services')}}" >@lang('frontend.customer')</a>-->

                <a href="{{url('privacy')}}" >@lang('frontend.policy')</a>

           </div>

        <div class="col-md-12 sinm-logo mt-4">

          <a href="{{url('')}}" class="navbar-brand"><img src="{{ url('assets/home/img/footer-logo.svg')}}"></a>

        </div>

      </div>

      <div class="row mt-4">

      	<div class="col-md-12 f-icons mt-4">
      		<!-- facebook -->
      	@if(($preferences->facebook_link) == null)
      	@else
      	  <a href="{{$preferences->facebook_link}}" target="_blank"><i class="fa fa-facebook"></i></a>
      	@endif
      	<!-- instagram -->
      	@if(($preferences->instagram_link) == null)
      	@else
      	 <a href="{{$preferences->instagram_link}}" target="_blank"><i class="fa fa-instagram"></i></a>
      	@endif
      	 <!-- linked in -->
      	@if(($preferences->linkedin_link) == null)
      	@else
      	   <a href="{{$preferences->linkedin_link}}" target="_blank"><i class="fa fa-linkedin"></i></a>
      	@endif
      	<!-- twiter -->
      	@if(($preferences->twitter_link) == null)
      	@else
      	 <a href="{{$preferences->twitter_link}}" target="_blank"><i class="fa fa-twitter"></i></a>
      	@endif
      	</div>

        <div class="col-md-12 c-footer mt-4">

          <p></p>&copy;{!!($preferences_descriptions->footer_copyright)!!}<span class="d-block-sm">Site By:

          <a href="https://www.gcc-marketing.com/" target="_blank" style="color:black;"><strong>GCC-Marketing</strong>

          </a></span>

          </p>

        </div>

      </div>

    </div>

  </footer>



</body>



@endif

<script>

        ckeditor.replace( 'details' );

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



<script>

  AOS.init();

</script>

<script>

$('.menu a').click(function() {

    $('.menu a').removeClass('active');

    $(this).addClass('active');

});

   </script>

</html>