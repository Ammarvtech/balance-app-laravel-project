@extends('layouts.adminlayout.admin_design')
@section('content')
<div class="" role="main">
    <div class="x_content content">
        <div class="page-title">
            <div class="title_left">
               <h3>About Us</h3>
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
                            <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Title<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" id="about_title" name="about_title[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->about_title  }}" >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <textarea name="about_description[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->about_description)!!}</textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading1<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" id="about_heading1" name="about_heading1[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->about_heading1 }}" >
                            </div>
                        </div>
                          <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description1<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                              
                                <textarea name="about_description1[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->about_description1)!!}</textarea>
                            </div>
                        </div>
                        @if($key == 0)

                            <div class="item form-group">
                               <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture1</label>
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
                          <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading2<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" id="about_heading2" name="about_heading2[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->about_heading2 }}">
                            </div>
                        </div>
                          <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description2<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                               
                                <textarea name="about_description2[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->about_description2)!!}</textarea>

                            </div>
                        </div>
                        @if($key == 0)                     
                            <div class="item form-group">
                               <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture2</label>
                               <div class="col-md-7 col-sm-7 col-xs-12">
                                   <input type="file" name="about_image2" class="form-control col-md-7 col-xs-12" value="" >
                               </div>
                           </div>
                           @if(isset($v->about_image2) && ($v->about_image2) !="")
                           <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                               <div class="col-md-9 col-sm-9 col-xs-12">
                                   <img width="100px" height="100px" src="{{asset('/images/aboutus/'.$v->about_image2) }}">
                               </div>
                           </div>
                           @endif
                        @endif
                          <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading3<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" id="about_heading3" name="about_heading3[]" required="required" class="form-control col-md-7 col-xs-12" value="{{ $v->about_heading3 }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Description3<span class="required">*</span> </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <textarea name="about_description3[]" class="ckeditor form-control col-md-7 col-xs-12" >{!!($v->about_description3)!!}</textarea>
                            </div>
                        </div>
                    @if($key == 0)

                        <div class="item form-group">
                           <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Picture3</label>
                           <div class="col-md-7 col-sm-7 col-xs-12">
                               <input type="file" name="about_image3" class="form-control col-md-7 col-xs-12" value="" >
                           </div>
                       </div>
                       @if(isset($v->about_image3) && ($v->about_image3) !="")
                       <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <img width="100px" height="100px" src="{{ asset('/images/aboutus/'.$v->about_image3) }}">
                           </div>
                       </div>
                       @endif
                    @endif
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
     </div>
 </div>

</div>
<div class="clear"></div>
</div>
<div class="clear"></div>

<script>
    // initialize the validator function
    validator.message['data'] = 'not a real date';

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