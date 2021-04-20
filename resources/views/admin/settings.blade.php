@extends('layouts.adminlayout.admin_design')
@section('content')
    <div role="main">
        <div class="x_content content">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ $page_title }}</h3>
                </div>
            </div>
            <div class="x_content">
                <div class="x_panel">
                <div class="clear"></div>
                <form method="post" id="demo-form2" class="form-horizontal form-label-left" action="{{ url('/admin/update-pwd') }}"  novalidate>{{ csrf_field() }}
                    @if(Session::has('flash_message_success'))
                    <div class="alert alert-success">{!! session('flash_message_success') !!}</div>
                    @endif
                    <div class="clear"></div>
                    @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger">{!! session('flash_message_error') !!}</div>
                    @endif
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Old Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="old_password" name="old_password" required="required" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12" value="" />
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="confirm_password" class="form-control col-md-7 col-xs-12" type="password" name="confirm_password" required="required" value="" />
                        </div>
                    </div>
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
    </div>
    <script src="{{ asset('js/admin_js/validator/validator.js') }}"></script>
    <script type="text/javascript">
        /*$(document).ready(function(){
            $('#password').click(function(){
                var old_pwd = $('#old_password').val();
                if(old_pwd !=""){
                    $.ajax({
                        type:'get',
                        url:'/admin/check-pwd',
                        data:{current_pwd:current_pwd},
                        success:function(resp){
                            //alert(resp);
                            if(resp=="false"){
                                $("#chkPwd").html("<font color='red'>Current Password is Incorrect</font>");
                            }else if(resp=="true"){
                                $("#chkPwd").html("<font color='green'>Current Password is Correct</font>");
                            }
                        },error:function(){
                            alert("Error");
                        }
                    });
                }
            });

        });*/
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
@endsection