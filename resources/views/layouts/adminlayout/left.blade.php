<div class="col-md-3 left_col">

    <div class="left_col scroll-view">



        <div class="navbar nav_title" style="border: 0;">

            <a href="{{url('dashboard')}}" class="site_title header_logo" style="background-color:#2a3f54; margin-bottom:10px; height:75px;">

                <span class="big_logo">Balance App</span>

                <span class="small_logo" style="display:none; padding-left:10px"><img src="{{asset('assets/admin/admin/fav.png')}}" /></span>

            </a>

        </div>

        <div class="clearfix"></div>

        <!-- menu prile quick info -->

        

        <!-- /menu prile quick info -->



        <br />



        <!-- sidebar menu -->

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">

                <h3>&nbsp;</h3>

                <ul class="nav side-menu">

                    <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>

                    <li><a href="{{url('contacts')}}"><i class="fa fa-envelope"></i>Contact Us</a></li>

                    <!-- <li><a href="#"><i class="fa fa-envelope"></i>Solutions</a></li>

 -->

                    <li><a><i class="fa fa-list"></i>Categories<span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{ url('view-categories') }}">Manage Categories</a></li>

                            <li><a href="{{ url('add-category') }} ">Add Categories</a></li>

                        </ul>

                    </li>





                      <li><a><i class="fa fa-newspaper-o"></i>Features<span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{url('view-feature')}}">Manage Features</a></li>

                            <li><a href="{{url('add-feature')}}">Add Feature</a></li>

                        </ul>

                    </li>

                    <li><a><i class="fa fa-language"></i>Languages <span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{ url('view-language') }}">Manage Languages</a></li>

                            <li><a href="{{ url('add-language') }}">Add Language</a></li>

                        </ul>

                    </li>

                   <li><a><i class="fa fa-asterisk"></i> Preferences <span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{url('preferences')}}">Preferences</a></li>

                        </ul>

                    </li>

                    <li><a><i class="fa fa-institution"></i> About Us <span class="fa fa-chevron-down"></span></a>

                         <ul class="nav child_menu" style="display: none">

                             <li><a href="{{url('about')}}">About Us</a></li>

                         </ul>

                     </li>

                     <li><a><i class="fa fa-newspaper-o"></i>App Features <span class="fa fa-chevron-down"></span></a>

                          <ul class="nav child_menu" style="display: none">

                              <li><a href="{{url('feature')}}">App Features</a></li>

                          </ul>

                      </li>

                  

  <!--                   <li><a><i class="fa fa-asterisk"></i> NewsLetters <span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{url('news')}}">NewsLetters</a></li>

                        </ul>

                    </li> -->



                    <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{ url('view-users') }}">Manage Users</a></li>

                            <li><a href="{{ url('adduser') }}">Add User</a></li>

                        </ul>

                    </li>



                      <li><a><i class="fa fa-newspaper-o"></i>Testimonial<span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{ url('view-testimonial') }}">Manage Testimonial</a></li>

                            <li><a href="{{ url('add-testimonial') }}">Add Testimonial</a></li>

                        </ul>

                    </li>

                      <li><a><i class="fa fa-file-powerpoint-o"></i>Pages Sections<span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{ url('view-page') }}">Manage Pages Section</a></li>

                            <li><a href="{{ url('add-page') }}">Add Page Section</a></li>

                        </ul>

                    </li>

                    <li><a><i class="fa fa-question-circle"></i>FAQ <span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{ url('view-faqs') }}">Manage FAQ</a></li>

                            <li><a href="{{ url('add-faq') }}">Add FAQ</a></li>

                        </ul>

                    </li> 

                    <li><a><i class="fa fa-file-image-o"></i>Slider<span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu" style="display: none">

                            <li><a href="{{url('view-slider')}}">Slider</a></li>

                            <li><a href="{{url('add-slider')}}">Add Slider</a></li>

                            <li><a href="{{url('view-app-slider')}}">App Slider</a></li>

                            <li><a href="{{url('add-app-slider')}}">Add App-Slider</a></li>

                        </ul>

                    </li>



                </ul>

            </div>



        </div>

    </div>

</div>