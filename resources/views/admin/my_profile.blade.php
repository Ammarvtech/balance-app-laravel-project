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
                <form method="post" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Full Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:9px;">
                            {{ ucwords($profile->name) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:8px;">
                            {{ $profile->email }}
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
            <!-- /page content -->
@endsection