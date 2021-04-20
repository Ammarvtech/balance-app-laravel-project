@extends('layouts.adminlayout.admin_design')
@section('content')
<!-- page content -->
<div role="main">
    <div class="x_content content">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ $page_title }}</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_content">
            <div class="x_panel">
                <form method="post" action="{{ url('preferences') }}" id="demo-form2" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">{{ csrf_field() }}
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Logo</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="logo" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['logo']) && $data['logo'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['logo']) }}">
                        </div>
                    </div>
                    @endif
                     <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">
                    <!-- Social Links-->
                    <div class="title_left">
                        <h3>Social Links</h3>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Facebook link <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="facebook_link" name="facebook_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['facebook_link'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Instagram link <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="instagram_link" name="instagram_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['instagram_link'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Twitter link <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="twitter_link" name="twitter_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['twitter_link'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">LinkedIn link <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="linkedin_link" name="linkedin_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['linkedin_link'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Pinterest link <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="pinterest_link" name="pinterest_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['pinterest_link'] }}" />
                        </div>
                    </div>
                  
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Title <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="footer_title" name="footer_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['footer_title'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Description <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="footer_description" name="footer_description" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['footer_description'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer link<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="footer_link" name="footer_link" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['footer_link'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Copyright<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="footer_copyright" name="footer_copyright" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['footer_copyright'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_description1" name="feature_description1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_description1'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Address <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="adress" name="adress" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['adress'] }}" />
                        </div>
                    </div>
                    
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Phone<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="telephone" name="telephone" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['telephone'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Email<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['email'] }}" />
                        </div>
                    </div>
                
                     <!--***************************************************************************************  -->
                    <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">
                    <!-- Home Page -->
                    <div class="title_left">
                        <h3>Home Page</h3>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Feature's Title<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="home_feature_title" name="home_feature_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['home_feature_title'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Feature's Description<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="home_feature_description" name="home_feature_description" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['home_feature_description'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="home_heading1" name="home_heading1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['home_heading1'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="home_description1" name="home_description1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['home_description1'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture1</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="home_image1" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['home_image1']) && $data['home_image1'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['home_image1']) }}">
                        </div>
                    </div>
                    @endif
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading2<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="home_heading2" name="home_heading2" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['home_heading2'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description2<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="home_description2" name="home_description2" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['home_description2'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture2</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="home_image2" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['home_image2']) && $data['home_image2'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['home_image2']) }}">
                        </div>
                    </div>
                    @endif
                     <!--***************************************************************************************  -->
                     <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">
                          <!-- Features Page -->
                    <div class="title_left">
                        <h3>Features Page</h3>
                    </div>
                        <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Titile<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_title" name="feature_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_title'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_description" name="feature_description" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_description'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_heading1" name="feature_heading1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_heading1'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_description1" name="feature_description1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_description1'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture1</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="feature_image1" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['feature_image1']) && $data['feature_image1'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['feature_image1']) }}">
                        </div>
                    </div>
                    @endif
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading2<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_heading2" name="feature_heading2" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_heading2'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description2<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_description2" name="feature_description2" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_description2'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture2</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="feature_image2" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['feature_image2']) && $data['feature_image2'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['feature_image2']) }}">
                        </div>
                    </div>
                    @endif
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading3<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_heading3" name="feature_heading3" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_heading3'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description3<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="feature_description3" name="feature_description3" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['feature_description3'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture3</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="feature_image3" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['feature_image3']) && $data['feature_image3'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['feature_image3']) }}">
                        </div>
                    </div>
                    @endif
                     <!--***************************************************************************************  -->
                     <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">
                    <!-- Safety and Sacurity Page -->
                    <div class="title_left">
                        <h3>Safety and Sacurity Page</h3>
                    </div>
                        <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Titile<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safet_title" name="safet_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safet_title'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safety_description" name="safety_description" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safety_description'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safety_heading1" name="safety_heading1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safety_heading1'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safety_description1" name="safety_description1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safety_description1'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture1</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="safety_image1" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['safety_image1']) && $data['safety_image1'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['safety_image1']) }}">
                        </div>
                    </div>
                    @endif
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading2<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safety_heading2" name="safety_heading2" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safety_heading2'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description2<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safety_description2" name="safety_description2" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safety_description2'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture2</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="safety_image2" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['safety_image2']) && $data['safety_image2'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['safety_image2']) }}">
                        </div>
                    </div>
                    @endif
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading3<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safety_heading3" name="safety_heading3" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safety_heading3'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description3<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="safety_description3" name="safety_description3" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['safety_description3'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture3</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="safety_image3" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['safety_image3']) && $data['safety_image3'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['safety_image3']) }}">
                        </div>
                    </div>
                    @endif
                     <!--***************************************************************************************  -->
                     <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">
                    <!-- About Us -->
                    <div class="title_left">
                        <h3>About Us</h3>
                    </div>
                        <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Titile<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="about_title" name="about_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['about_title'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="about_description" name="about_description" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['about_description'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="about_heading1" name="about_heading1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['about_heading1'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description1<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="about_description1" name="about_description1" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['about_description1'] }}" />
                        </div>
                    </div>
                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Baner Image</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="file" name="about_image1" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    @if(isset($data['about_image1']) && $data['about_image1'] !="")
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img width="100px" height="100px" src="{{ asset('/images/'.$data['about_image1']) }}">
                        </div>
                    </div>
                    @endif
                     <hr style="color: black; size: 2px; margin-top: 20px; width: 100%;">
                    <!-- Services Page  -->
                    <div class="title_left">
                        <h3>Services Page</h3>
                    </div>
                        <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Titile<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="service_title" name="service_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['service_title'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="service_description" name="service_description" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['service_description'] }}" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Faq Heading<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="faq_heading" name="faq_heading" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['faq_heading'] }}" />
                        </div>
                    </div>
                      
                   
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Success Story Title<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="story_title" name="story_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['story_title'] }}" />
                        </div>
                    </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Success Story Description<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="story_description" name="story_description" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['story_description'] }}" />
                        </div>
                    </div>
                      <!--***************************************************************************************  -->
                    
                    <!-- Policy Page  -->
                    <div class="title_left">
                        <h3>Policy Page</h3>
                    </div>
                        <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Titile<span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="policy_title" name="policy_title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data['policy_title'] }}" />
                        </div>
                    </div>


                     <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Body
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <textarea name="policy_body" class="ckeditor form-control col-md-7 col-xs-12" >{!!($data['policy_body'])!!}</textarea>
                        </div>
                    </div>
                    
                          <!-- // WHAT WE DO?-->
                  
                   
                           <!-- // some of our work-->
                   
                    
                     

                    
                  
                    <div class="ln_solid"></div>
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
<!-- /page content --> 
    
<script src="{{ asset('js/admin_js/validator/validator.js') }}"></script>
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

    /* FOR DEMO ONLY */
    $('#vfields').change(function () {
        $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function () {
        validator.defaults.alerts = (this.checked) ? false : true;
        if (this.checked)
            $('form .alert').remove();
    }).prop('checked', false);
</script>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
@endsection