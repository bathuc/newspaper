<div class="logo-menu">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="text-success">front</h1>
    {{--<img src="https://audimediacenter-a.akamaihd.net/system/production/media/1282/images/bde751ee18fe149036c6b47d7595f6784f8901f8/AL090142_full.jpg?1495177124" alt="" height="60">--}}
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link btn" href="#">Sign In</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn" href="#">Sign up</a>
      </li>
    </ul>
  </div>
</div>


@php
    $categoryList = App\Models\Category::getCategoryList();
    $routeName = Route::currentRouteName();
    $hiraganaActive = ($routeName =='front.index')? 'active' : '';

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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Katakana</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#">Words</a>
            </li>
            @if(!empty($categoryList))
                @foreach ($categoryList as $categoryItem)
                      <li class="nav-item dropdown">
                          @if(!empty($categoryItem['child']))
                              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">{{ $categoryItem['name'] }}</a>
                              <div class="dropdown-menu">
                                  @foreach ($categoryItem['child'] as $item)
                                    <a class="dropdown-item" href="#">{{ $item['name'] }}</a>
                                  @endforeach
                              </div>
                          @else
                              <a class="nav-link" href="#">{{ $categoryItem['name'] }}</a>
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
  .dropdown-item {
      font-size: 15px;
  }

    .dropdown-item:hover {
        background-color: white !important;
        color: #72bab9 !important;
        font-weight: bold;
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

      $( ".dropdown-menu" ).css('margin-top',0);
      $( ".dropdown" )
      .mouseover(function() {
          $( this ).addClass('show').attr('aria-expanded',"true");
          $( this ).find('.dropdown-menu').addClass('show');
      })
      .mouseout(function() {
          $( this ).removeClass('show').attr('aria-expanded',"false");
          $( this ).find('.dropdown-menu').removeClass('show');
      });

  });
</script>
