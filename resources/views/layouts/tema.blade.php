<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Bootstrap Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="{{ URL::asset('lib/font-awesome/css/font-awesome.css') }}">



    <script src="/lib/jquery-1.11.1.min.js" type="text/javascript"></script>

    <script src="/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>



    <link rel="stylesheet" type="text/css" href="/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="/stylesheets/premium.css">
    <link href="{{ URL::asset('css/complemento.css') }}" rel="stylesheet">

</head>
<body class=" theme-blue">

    <!-- Demo page code -->

    <script type="text/javascript">
        $(function() {
            var match = document.cookie.match(new RegExp('color=([^;]+)'));
            if(match) var color = match[1];
            if(color) {
                $('body').removeClass(function (index, css) {
                    return (css.match (/\btheme-\S+/g) || []).join(' ')
                })
                $('body').addClass('theme-' + color);
            }

            $('[data-popover="true"]').popover({html: true});

        });
    </script>
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover {
            color: #fff;
        }
    </style>

    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!-->

  <!--<![endif]-->

<!-- http://fontawesome.io/icons/ -->

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-thumbs-o-up"></span> Um Vereador de Verdade</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">




          <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <li><a href="{{ url('/login') }}">Login</a></li>
                  <!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
              @else
                  <!-- <li><a href="{{ url('/contatos') }}">Contatos</a></li>
                  <li><a href="{{ url('/cidades') }}">Cidades</a></li>
                  <li><a href="{{ url('/bairros') }}">Bairros</a></li>
                  <li><a href="{{ url('/register') }}">Novo Usuário</a></li> -->
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li>
                              <a href="{{ url('/logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                      </ul>
                  </li>
              @endif
          </ul>



          <!-- <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> Jack Smith
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="./">My Account</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Admin Panel</li>
                <li><a href="./">Users</a></li>
                <li><a href="./">Security</a></li>
                <li><a tabindex="-1" href="./">Payments</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="sign-in.html">Logout</a></li>
              </ul>
            </li>
          </ul> -->




        </div>
      </div>
    </div>


    <div class="sidebar-nav">
    <ul>
      <li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-bars"></i> Menu de Opções<i class="fa fa-collapse"></i></a></li>

      <!-- somente se estiver logado -->
      <li><ul class="dashboard-menu nav nav-list collapse in">
              <li><a href="/contatos"><span class="fa fa-caret-right"></span> Contatos</a></li>
              <li ><a href="/cidades"><span class="fa fa-caret-right"></span> Cidades</a></li>
              <li ><a href="/bairros"><span class="fa fa-caret-right"></span> Bairros</a></li>
              <!-- <li ><a href="media.html"><span class="fa fa-caret-right"></span> Media</a></li>
              <li ><a href="calendar.html"><span class="fa fa-caret-right"></span> Calendar</a></li> -->
          </ul>
      </li>

    <!-- <li data-popover="true"
      data-content="Items in this group require a <strong><a href='http://portnine.com/bootstrap-themes/aircraft' target='blank'>premium license</a><strong>." rel="popover" data-placement="right"><a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-fighter-jet"></i> Premium Features<i class="fa fa-collapse"></i></a>
    </li> -->
        <!-- <li>
          <ul class="premium-menu nav nav-list collapse">
                <li class="visible-xs visible-sm"><a href="#">- Premium features require a license -</a></span>
                <li ><a href="premium-profile.html"><span class="fa fa-caret-right"></span> Enhanced Profile</a></li>
                <li ><a href="premium-blog.html"><span class="fa fa-caret-right"></span> Blog</a></li>
                <li ><a href="premium-blog-item.html"><span class="fa fa-caret-right"></span> Blog Page</a></li>
                <li ><a href="premium-pricing-tables.html"><span class="fa fa-caret-right"></span> Pricing Tables</a></li>
                <li ><a href="premium-upgrade-account.html"><span class="fa fa-caret-right"></span> Upgrade Account</a></li>
                <li ><a href="premium-widgets.html"><span class="fa fa-caret-right"></span> Widgets</a></li>
                <li ><a href="premium-timeline.html"><span class="fa fa-caret-right"></span> Activity Timeline</a></li>
                <li ><a href="premium-users.html"><span class="fa fa-caret-right"></span> Enhanced Users List</a></li>
                <li ><a href="premium-media.html"><span class="fa fa-caret-right"></span> Enhanced Media</a></li>
                <li ><a href="premium-invoice.html"><span class="fa fa-caret-right"></span> Invoice</a></li>
                <li ><a href="premium-build.html"><span class="fa fa-caret-right"></span> Advanced Tools</a></li>
                <li ><a href="premium-colors.html"><span class="fa fa-caret-right"></span> Additional Color Themes</a></li>
              </ul>
              </li> -->

        <li><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse">
          <i class="fa fa-fw fa-key"></i> Acesso
          <!-- <span class="label label-info">+3</span> -->
          </a>
        </li>


        <li><ul class="accounts-menu nav nav-list collapse">
            <li><a href="{{ url('/register') }}"><span class="fa fa-caret-right"></span> Novo Usuário</a></li>
            <li><a href="{{ url('/login') }}"><span class="fa fa-caret-right"></span> Login</a></li>

            <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="fa fa-caret-right"></span> Logout</a></li>

            <li><a href="{{ url('/password/reset') }}"><span class="fa fa-caret-right"></span> Resetar Senha</a></li>
            </ul>
        </li>

        <!-- <li><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Legal<i class="fa fa-collapse"></i></a>
        </li>

        <li><ul class="legal-menu nav nav-list collapse">
            <li ><a href="privacy-policy.html"><span class="fa fa-caret-right"></span> Privacy Policy</a></li>
            <li ><a href="terms-and-conditions.html"><span class="fa fa-caret-right"></span> Terms and Conditions</a></li>
           </ul>
        </li> -->

        <!-- <li><a href="help.html" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Help</a></li>
        <li><a href="faq.html" class="nav-header"><i class="fa fa-fw fa-comment"></i> Faq</a></li>
        <li><a href="http://portnine.com/bootstrap-themes/aircraft" class="nav-header" target="blank"><i class="fa fa-fw fa-heart"></i> Get Premium</a></li> -->
      </ul>
    </div>

    <div class="content">
        @if(isset($titulo))
        <div class="header">
            <!-- <div class="stats">
              <p class="stat"><span class="label label-info">5</span> Tickets</p>
              <p class="stat"><span class="label label-success">27</span> Tasks</p>
              <p class="stat"><span class="label label-danger">15</span> Overdue</p>
            </div> -->
            <h1 class="page-title">{{ isset($titulo) ? $titulo : 'XXXXXXXXX' }}</h1>

            <!-- <ul class="breadcrumb">
              <li><a href="index.html">Home</a> </li>
              <li class="active">Dashboard</li>
            </ul> -->
        </div>
        @endif


      <div class="main-content">

        @if(count($errors) > 0 )
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading no-collapse">Foram encontrados erros</div>
                    <div class="panel-body">
                      <ul>
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @yield('content')

          <!-- Conteúdo Aqui  -->





    <!-- <div class="panel panel-default">
        <a href="#page-stats" class="panel-heading" data-toggle="collapse">Latest Stats</a>
        <div id="page-stats" class="panel-collapse panel-body collapse in">

                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="3000" data-displayPrevious="true" value="2500" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Accounts</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="4500" data-displayPrevious="true" value="3299" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Subscribers</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="2700" data-displayPrevious="true" value="1840" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Pending</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="15000" data-displayPrevious="true" value="10067" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Completed</h3>
                            </div>
                        </div>
                    </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Not Collapsible<span class="label label-warning">+10</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Mark</td>
                  <td>Tompson</td>
                  <td>the_mark7</td>
                </tr>
                <tr>
                  <td>Ashley</td>
                  <td>Jacobs</td>
                  <td>ash11927</td>
                </tr>
                <tr>
                  <td>Audrey</td>
                  <td>Ann</td>
                  <td>audann84</td>
                </tr>
                <tr>
                  <td>John</td>
                  <td>Robinson</td>
                  <td>jr5527</td>
                </tr>
                <tr>
                  <td>Aaron</td>
                  <td>Butler</td>
                  <td>aaron_butler</td>
                </tr>
                <tr>
                  <td>Chris</td>
                  <td>Albert</td>
                  <td>cab79</td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-default">
            <a href="#widget1container" class="panel-heading" data-toggle="collapse">Collapsible </a>
            <div id="widget1container" class="panel-body collapse in">
                <h2>Here's a Tip</h2>
                <p>This template was developed with <a href="http://middlemanapp.com/" target="_blank">Middleman</a> and includes .erb layouts and views.</p>
                <p>All of the views you see here (sign in, sign up, users, etc) are already split up so you don't have to waste your time doing it yourself!</p>
                <p>The layout.erb file includes the header, footer, and side navigation and all of the views are broken out into their own files.</p>
                <p>If you aren't using Ruby, there is also a set of plain HTML files for each page, just like you would expect.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">
                <span class="panel-icon pull-right">
                    <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="fa fa-refresh"></i></a>
                </span>

                Needed to Close
            </div>
            <table class="table list">
              <tbody>
                  <tr>
                      <td>
                          <a href="#"><p class="title">Care Hospital</p></a>
                          <p class="info">Sales Rating: 86%</p>
                      </td>
                      <td>
                          <p>Date: 7/19/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                      <td>
                          <p class="text-danger h3 pull-right" style="margin-top: 12px;">$20,500</p>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <a href="#"><p class="title">Custom Eyesight</p></a>
                          <p class="info">Sales Rating: 58%</p>
                      </td>
                      <td>
                          <p>Date: 7/19/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                      <td>
                          <p class="text-danger h3 pull-right" style="margin-top: 12px;">$12,600</p>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <a href="#"><p class="title">Clear Dental</p></a>
                          <p class="info">Sales Rating: 76%</p>
                      </td>
                      <td>
                          <p>Date: 7/19/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                      <td>
                          <p class="text-danger h3 pull-right" style="margin-top: 12px;">$2,500</p>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <a href="#"><p class="title">Safe Insurance</p></a>
                          <p class="info">Sales Rating: 82%</p>
                      </td>
                      <td>
                          <p>Date: 7/19/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                      <td>
                          <p class="text-danger h3 pull-right" style="margin-top: 12px;">$22,400</p>
                      </td>
                  </tr>

              </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-default">
            <a href="#widget2container" class="panel-heading" data-toggle="collapse">Collapsible </a>
            <div id="widget2container" class="panel-body collapse in">
                <h2>Built with Less</h2>
                <p>The CSS is built with Less. There is a compiled version included if you prefer plain CSS.</p>
                <p>Fava bean jícama seakale beetroot courgette shallot amaranth pea garbanzo carrot radicchio peanut leek pea sprouts arugula brussels sprout green bean. Spring onion broccoli chicory shallot winter purslane pumpkin gumbo cabbage squash beet greens lettuce celery. Gram zucchini swiss chard mustard burdock radish brussels sprout groundnut. Asparagus horseradish beet greens broccoli brussels.</p>
                <p><a class="btn btn-primary">Learn more »</a></p>
            </div>
        </div>
    </div>
</div> -->


<!-- fim do conteúdo-- >

<!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->

            <!-- <footer>
                <hr>
                <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                <p>© 2014 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
            </footer> -->



        </div>
    </div>


    <script src="/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>


</body></html>