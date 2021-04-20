@extends('layouts.adminlayout.admin_design')
@section('content')
<div class="" role="main">
    <div class="x_content content">
        <div class="page-title">
            <div class="title_left">
               <h3>Edit Feature</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_content">
            <div class="x_panel">
                <ul class="nav nav-tabs">
                @foreach ($languages as $key => $value)
                    @php 
                        $lang[$key] = " of ".$value->name;
                    @endphp
                    <li @if($key==0) class="active" @endif ><a data-toggle="tab" href="#<?php echo $value->name; ?>">{{($value->name)}}</a></li>
                @endforeach 
                </ul>
                <br/>
                <form method="post" name="frm" action="{{url('edit-feature/'.$id)}}" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                            @php $j = (int) filter_var($error, FILTER_SANITIZE_NUMBER_INT); @endphp
                            {{ str_replace(".".$j, $lang[$j], $error) }} <br>
                          @endforeach
                        </div>
                    @endif
                    <div class="tab-content">
                        @foreach ($features as $key => $v)

                            <div id="{{$v->name}}" class="tab-pane fade  @if($key==0) in active @endif">
                                <input name="language_id[]" type="hidden" value="{{$v->language_id}}">
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Title<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text"  name="title[]" class="form-control col-md-7 col-xs-12" value="{{$v->title}}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <textarea name="description[]" class="ckeditor form-control col-md-7 col-xs-12">{{$v->description}}</textarea>
                                </div>
                            </div>
                            @if($key == 0)
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title"> Image</label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" value="" />
                                    </div>
                                </div>
                                @if(isset($v->image) && ($v->image) !="")
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <img width="100px" height="100px" src="{{ asset('/images/Features/'.$v->image) }}" style="background-color: black;">
                                    </div>
                                </div>
                                @endif
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Status <span class="required">*</span>
                                    </label>
                                       <div class="col-md-7 col-sm-7 col-xs-12">
                                       <select name="isDelete" id="status" class="form-control">
                                            <option value="1"</option>Enable</option>
                                            <option value="0">Disable</option>
                                       </select>
                                   </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Sort Order <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="text" id="sort_order" name="sort_order" class="form-control col-md-7 col-xs-12" value="{{$v->sort_order}}" />
                                    </div>
                                </div>
                                
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
    $(document).ready(function(){
       $("#status").val('{{ $v->isDelete}}'); 
    });
</script>
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