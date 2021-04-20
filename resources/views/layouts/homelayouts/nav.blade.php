@php
  $languages=App\Language::get();
  $preferences=App\Preference::first(); 
@endphp

@if(Session::has('language_id'))
   @php
   $language_name=App\Language::where('language_id','=',Session::get('language_id'))->pluck('name')->first();
  // dd($language_name);
   @endphp
@endif

   
<div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="{{url('')}}" class="navbar-brand"><img src="{{ url('images/home/Final-logo.svg')}}"></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mx-auto menu">
                        <ul>
                            <li><a href="{{url('aboutUs')}}" class="nav-item {{ (request()->is('aboutUs')) ? 'active' : '' }} ">@lang('frontend.about_us')</a></li>
                            <li><a href="{{url('features')}}" class="nav-item {{ (request()->is('features')) ? 'active' : '' }}">@lang('frontend.features')</a></li>
                            <li><a href="{{url('security')}}" class="nav-item {{ (request()->is('security')) ? 'active' : '' }}">@lang('frontend.Safety')</a></li>
                            <li><a href="{{url('services')}}" class="nav-item {{ (request()->is('services')) ? 'active' : '' }}">@lang('frontend.customer')</a></li>
                        </ul>
                   </div>            
                <div class="navbar-nav">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">@if(Session::has('language_id')) {{ $language_name }} @else Languages @endif</a>
                        <div class="dropdown-menu">
                            @if(isset($languages))
                                @foreach($languages as $language)
                                <a href="{{url('language/'.$language->language_id)}}" class="dropdown-item">{{$language->name}}</a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>   
    </div>





