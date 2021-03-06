@extends('layouts.adminlayout.admin_design')
@section('content')

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
          <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('send-mail') }}" name="frm" id="frm" novalidate="novalidate" >
           {{ csrf_field() }}
              @if($errors->any())
                <div class="alert alert-danger">
                  @foreach($errors->all() as $error)
                    {{ $error }} <br>
                  @endforeach
                </div>
              @endif

               <input type="hidden" name="id" value="{{$user_info->id}}">
               <div class="item form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Body
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="test" name="body" required="required" class="form-control col-md-7 col-xs-12" value="{{ old('body') }}" />

                  </div>
              </div>
         
            </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="clear"></div>                
    </div>
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
    <script>
      $('#start_date').datepicker({
        format : 'mm-dd-yyyy'
      });
      $('#end_date').datepicker({
        format : 'mm-dd-yyyy'
      });
    </script>
    <script>
      function eventCheckBox() {
        let checkboxs = document.getElementsByTagName("input");
        for(let i = 1; i < checkboxs.length ; i++) {
          checkboxs[i].checked = !checkboxs[i].checked;
        }
      }
    </script>
    <script>
      var select_all = document.getElementById("select_all"); //select all checkbox
      var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items
      //select all checkboxes
      select_all.addEventListener("change", function(e){
        for (i = 0; i < checkboxes.length; i++) { 
          checkboxes[i].checked = select_all.checked;
        }
      });
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
          if(this.checked == false){
            select_all.checked = false;
          }
            //check "select all" if all checkbox items are checked
          if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
              select_all.checked = true;
          }
        });
      }
    </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
  
@endsection