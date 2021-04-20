@extends('layouts.adminlayout.admin_design')

@section('content')

<div class="" role="main">

    <div class="x_content content">

        <div class="page-title">

            <div class="title_left">

               <h3>Preferences</h3>

            </div>

        </div>

        <div class="clearfix"></div>

        <div class="x_content">

            <div class="x_panel">

                <ul class="nav nav-tabs">

                  

                   

                    @foreach ($preference as $key => $value)

                        @php 

                            $lang[$key] = " of ".$value->name;

                        @endphp

                        <li @if($key==0) class="active" @endif ><a data-toggle="tab" href="#<?php echo $value->name; ?>">{{($value->name)}}</a></li>

                    @endforeach

                </ul>

                <br> 

                @php $id=1; @endphp

                <form method="post" action="{{ url('preference-create/'.$id) }}" id="demo-form2" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">

                    @csrf

                    @if($errors->any())

                        <div class="alert alert-danger">

                          @foreach($errors->all() as $error)

                            @php $j = (int) filter_var($error, FILTER_SANITIZE_NUMBER_INT); @endphp

                            {{ str_replace(".".$j, $lang[$j], $error) }} <br>

                          @endforeach

                        </div>

                    @endif

                    @if(Session::has('flash_message_success'))

                      <div class="alert alert-success alert-block">

                          <button type="button" class="close" data-dismiss="alert">×</button> 

                              <strong>{!! session('flash_message_success') !!}</strong>

                      </div>

                    @endif

                    <div class="tab-content">

                        

                        @foreach ($preference as $key => $v)

                            <div id="{{$v->name}}" class="tab-pane fade  @if($key==0) in active @endif">

                                <input name="language_id[]" type="hidden" value="{{$v->language_id}}">

                        @if($key == "")    

                            <!-- Languages -->

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Logo</label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="file" name="logo" class="form-control col-md-7 col-xs-12" value="{{$v->logo}}" >

                                </div>

                            </div>

                            @if(isset($v->logo) && ($v->logo) !="")

                            <div class="form-group">

                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>

                                <div class="col-md-9 col-sm-9 col-xs-12">

                                    <img width="100px" height="100px" src="{{ asset('/images/home/'.$v->logo) }}">

                                </div>

                            </div>

                            @endif

                        @endif

                             <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">

                            <!-- Social Links-->

                            <div class="title_left">

                                <h3>Social Links</h3>

                            </div>

                        @if($key == 0)

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Facebook link <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="facebook_link" name="facebook_link" required="required" class="form-control col-md-7 col-xs-12" value="{{  $v->facebook_link  }}" >

                                </div>

                            </div>

                             <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Instagram link <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="instagram_link" name="instagram_link" required="required" class="form-control col-md-7 col-xs-12" value="{{  $v->instagram_link }}" >

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Twitter link <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="twitter_link" name="twitter_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->twitter_link }}" >

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">LinkedIn link <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="linkedin_link" name="linkedin_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->linkedin_link  }}" >

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Pinterest link <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="pinterest_link" name="pinterest_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->pinterest_link  }}" >

                                </div>

                            </div>

                            

                           

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer link<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="footer_link" name="footer_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->footer_link }}" >

                                </div>

                            </div>

                            



                            

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Phone<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="telephone" name="telephone" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->telephone}}" >

                                </div>

                            </div>

                             <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Email<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->email }}" >

                                </div>

                            </div>

                        @endif

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Address <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="adress" name="address[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->address  }}" >

                                </div>

                            </div>

 

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Copyright <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="footer_copyright" name="footer_copyright[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->footer_copyright }}" />

                                </div>

                            </div>



                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Title <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="footer_title" name="footer_title[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->footer_title ? $v->footer_title :old('footer_title'.$key)}}" >

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Description <span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <textarea name="footer_description[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->footer_description)!!}</textarea>

                                </div>

                            </div>

                            

                             <!--***************************************************************************************  -->

                            <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">

                            <!-- Home Page -->

                            <div class="title_left">

                                <h3>Home Page</h3>

                            </div>

                              <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Feature's Title<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="home_feature_title" name="home_feature_title[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->home_feature_title }}" >

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Feature's Description<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <textarea name="home_feature_description[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->home_feature_description)!!}</textarea>

                                </div>

                            </div>

                             <!--***************************************************************************************  -->





                             <!--***************************************************************************************  -->

                             <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">

                            <!-- Safety and Sacurity Page -->

                            <div class="title_left">

                                <h3>Safety and Sacurity Page</h3>

                            </div>

                                <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Titile<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="safet_title" name="safet_title[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->safet_title  }}" >

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <textarea name="safety_description[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->safety_description)!!}</textarea>

                                </div>

                            </div>

                           

                             <!--***************************************************************************************  -->

                            

                             <!--***************************************************************************************  -->

                             <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">

                            <!-- Services Page  -->

                            <div class="title_left">

                                <h3>Services Page</h3>

                            </div>

                                <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Titile<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="service_title" name="service_title[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->service_title   }}" >

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <textarea name="service_description[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->service_description)!!}</textarea>

                                </div>

                            </div>

                            <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Faq Heading<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="faq_heading" name="faq_heading[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->faq_heading  }}" >

                                </div>

                            </div>





                              

                            

                              <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Success Story Title<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <input type="text" id="story_title" name="story_title[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->story_title  }}" >



                                </div>

                            </div>

                              <div class="item form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Success Story Description<span class="required"></span> </label>

                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <textarea name="story_description[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->story_description)!!}</textarea>

                                </div>



                            </div>

                              <!--***************************************************************************************  -->

                            <!-- Policy Page  -->

  

    





                         </div>

                        @endforeach

                    </div>

                    <div class="form-group">

                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                        <button type="submit" class="btn btn-success">Submit</button>

                    </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="clear"></div>

</div>

<script>

    // initialize the validator function

    validator.message['date'] = 'not a real date';



    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':

    $('form')

        .on('blur', 'input[required], input.optional, select.required', validator.checkField)

        .on('change', 'select.required', validator.checkField)

        .on('keypress', 'input[required][pattern]', validator.keypress);



    $('.multi.required')

        .on('keyup blur', 'input', function () {

            validator.checkField.apply($(this).siblings().last()[0]);

        });



    // bind the validation to the form submit event

    //$('#send').click('submit');//.prop('disabled', true);



    $('form').submit(function (e) {

        e.preventDefault();

        var submit = true;

        // evaluate the form using generic validaing

        if (!validator.checkAll($(this))) {

            submit = false;

        }



        if (submit)

            this.submit();

        return false;

    });

</script>

<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>



@endsection