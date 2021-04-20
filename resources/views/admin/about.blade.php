@extends('layouts.adminlayout.admin_design')
@section('content')
<div role="main">
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
                <form method="post" action="{{ url('about-create/'.$id) }}" id="demo-form2" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
                    @csrf
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
                    <div class="tab-content">
                        
                        @foreach ($preference as $key => $v)
                            <div id="{{$v->name}}" class="tab-pane fade  @if($key==0) in active @endif">
                                <input name="language_id[]" type="hidden" value="{{$v->language_id}}">
                                <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Main Title<span class="required">*</span> </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="about_title" name="about_title[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->about_title  }}" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Main Description<span class="required">*</span> </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <textarea name="about_description[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->about_description)!!}</textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Sub Heading<span class="required">*</span> </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="about_heading1" name="about_heading1[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->about_heading1 }}" >
                                </div>
                            </div>
                              <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Sub Description<span class="required">*</span> </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                  
                                    <textarea name="about_description1[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->about_description1)!!}</textarea>
                                </div>
                            </div>
                            @if($key == 0)

                                <div class="item form-group">
                                   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Baner Image</label>
                                   <div class="col-md-7 col-sm-7 col-xs-12">
                                       <input type="file" name="about_image1" class="form-control col-md-7 col-xs-12" value="" >
                                   </div>
                               </div>
                               @if(isset($v->about_image1) && $v->about_image1 !="")
                               <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                       <img width="100px" height="100px" src="{{asset('/images/aboutus/'.$v->about_image1)}}">
                                       
                                   </div>
                               </div>
                            
                               @endif
                            @endif
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