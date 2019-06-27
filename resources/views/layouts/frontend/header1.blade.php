<div class="logo-menu">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="text-success">newspaper</h1>
    {{--<img src="https://audimediacenter-a.akamaihd.net/system/production/media/1282/images/bde751ee18fe149036c6b47d7595f6784f8901f8/AL090142_full.jpg?1495177124" alt="" height="60">--}}
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="btn font-weight-bold" href="/admin">Sign In</a>
      </li>
      <li class="nav-item">
        <a class="btn font-weight-bold" href="#">Sign up</a>
      </li>
    </ul>
  </div>
</div>


@php
    $routeName = Route::currentRouteName();
    $hiraganaActive = ($routeName =='front.index')? 'active' : '';
    $categoryList = App\Models\Category::getCategoryList();
    $currentSlug =  '';
    if(isset($slug)) {
        $currentSlug = $slug;
    }
@endphp
{{--  add active in a.nav-link for active menu  --}}
<div class="navigation-bar">
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-expand-sm d-flex justify-content-between">
        <button class="navbar-toggler" type="button" onclick="menuMobile(this)">
          <span class="bar1"></span>
          <span class="bar2"></span>
          <span class="bar3"></span>
        </button>

        {{--right bar--}}
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
              @if(!empty($categoryList))
                  @foreach ($categoryList as $categoryItem)
                      <li class="nav-item dropdown">
                          @php
                              $linkActive = ($currentSlug == $categoryItem['slug'])? 'active' : '';
                          @endphp
                          @if(!empty($categoryItem['child']))
                              <a class="nav-link dropdown-toggle {{ $linkActive }}" href="{{ route('front.route_name', $categoryItem['slug']) }}" role="button" data-toggle="dropdown">{{ $categoryItem['name'] }}</a>
                              <ul class="dropdown-menu">
                                  @foreach ($categoryItem['child'] as $item)
                                      @if(!empty($item['child']))
                                          {{-- menu level 3--}}
                                          <li class="dropdown-submenu">
                                              <a class="dropdown-item dropdown-toggle" href="{{ route('front.route_name', $item['slug']) }}">{{ $item['name'] }}</a>
                                              <ul class="dropdown-menu">
                                                  @foreach ($item['child'] as $itemLevel3)
                                                      <li><a class="dropdown-item" href="{{ route('front.route_name', $itemLevel3['slug']) }}">{{ $itemLevel3['name'] }}</a></li>
                                                  @endforeach
                                              </ul>
                                          </li>
                                      @else
                                          {{-- menu level 2 --}}
                                          <li><a class="dropdown-item" href="{{ route('front.route_name', $item['slug']) }}">{{ $item['name'] }}</a></li>
                                      @endif
                                  @endforeach
                              </ul>
                          @else
                              <a class="nav-link {{ $linkActive }}" href="{{ route('front.route_name', $categoryItem['slug']) }}">{{ $categoryItem['name'] }}</a>
                          @endif
                      </li>
                  @endforeach
              @endif

          </ul>
        </div>

        {{-- left bar --}}
        <div class="left-bar d-none d-sm-block">
          {{--<i class="fas fa-user"></i>--}}
        </div>
      </nav>
    </div>
  </div>
</div>

<style>
    /* -- subcategory --*/
    .dropdown-menu {
        margin: 0!important;
        padding: 0px;
        /*border: 0px;*/
        box-shadow: 0 0 15px -5px rgba(0,0,0,0.4);
    }
    .navbar-nav li:hover > ul.dropdown-menu {
        display: block;
    }
    .dropdown-submenu {
        position:relative;
    }
    .dropdown-submenu>.dropdown-menu {
        top:0;
        left:100%;
        margin-top:-6px;
    }
    .dropdown-menu > li > a:hover:after {
        text-decoration: underline;
        transform: rotate(-90deg);
    }

    .dropdown-item:hover{
        background-color: white !important;
        color:#5aa0a0 !important;
    }

  /*navigation bar*/
  .navigation-bar {
    background-color: #5aa0a0; /* nav background color */
    width: 100%;
  }

  nav.navbar {
    border: 0;
    border-radius: 0;
    clear: both;
    margin: 0 auto;
    min-height: auto;
    width: 100%;
    padding-left: 0px;
  }

  .navbar-toggler {
    display: none;
  }

  .navbar-nav {
    list-style: none;
    padding-left: 0;
  }

  .navbar-nav li {
    float: none;
    padding: 0px 10px; /* nav item padding */
    display: inline-block;
  }

  .nav-link {
    color: #fff; /* nav item color */
    display: inline-block;
    padding: 8px 25px;
    font-weight: bold;
    line-height: normal;
  }

  .navbar-nav li a:hover, .navbar-nav li a.active {
    background: #72bab9; /* nav hover, active background */
    border-radius: 20px;
    text-decoration: none;
    color:white;
  }

  @media only screen and (max-width: 570px) {
    nav.navbar {
      padding-left: 20px;
    }

    .navbar-toggler, .collapse {
      display: block;
    }

    .collapse {
      display: none;
    }

    .navbar-toggler {
      border-radius: 5px;
      float: right;
      margin-right: 15px;
      border: 1px #fff solid;
      background: transparent;
      padding: 0px 5px;
      outline: none;
    }

    .bar1, .bar2, .bar3 {
      background-color: #fff;
      display: block;
      margin: 6px 0;
      transition: 0.4s;
      width: 30px;
      height: 2px;
    }

    .navbar-collapse {
      background: #5aa0a0;
      position: absolute;
      top: 100%;
      float: left;
      left: 0;
      width: 100%;
      z-index: 99;
    }

    .navbar-nav {
      padding: 0;
      padding-top: 5px;
      margin: 0 auto;
    }

    .navbar-nav li {
      border-top: 1px #fff solid; /* border each item */
      border-radius: 0;
      display: block;
      line-height: normal;
      margin: 0 auto;
      padding: 0px;
      width: 100%;
    }

    .navbar-nav li a:not(.active) {
      display: block;
      padding: 6px 22px;
      margin: 0 auto;
      line-height: 32px;
      text-align: left;
      width: 100%;
      /*background-color: red;*/
    }

    .nav-item:hover{
      background: #72bab9;
      border-radius: 0px;
      text-decoration: none;
    }
    .navbar-nav li a.active {
      background: #72bab9;
      border-radius: 0px;
      text-decoration: none;
      display: block;
      padding: 6px 22px;
      margin: 0 auto;
      line-height: 32px;
      text-align: left;
      width: 100%;
    }
  }
</style>

<script>
  function menuMobile(event) {
    event.classList.toggle("change");
  }
  $(document).ready(function () {
    $(".navbar-toggler").click(function () {
      $(".collapse").slideToggle(300);
    });
  });
  $(document).ready(function () {
      $('.nav-item').click(function(){
          var link = $(this).find('.nav-link').attr('href');
          window.location = link;
      });
  });
</script>
