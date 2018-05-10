<!DOCTYPE html>
<html lang="en" dir="{{Translatable::getCurrentLocaleDirection()}}">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>{{translate('aktaa_translatable',App::getLocale(),'Aktaa Translatable')}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>--}}
    <link href="{{asset('vendor/translate/css/light-bootstrap-dashboard.css?v=2.0.1')}}" rel="stylesheet"/>
    <link href="{{asset('vendor/translate/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style>
        .page-navigation {
            padding: 0px 40px;
            display: inline-block;
            margin: 21px 0;
            border-radius: 4px;
        }
        
        .page-navigation a {
            margin: 0 2px;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            line-height: 1.33;
            color: #515253;
            background-color: #fff;
            border: 1px solid #eee;
        }
        
        .page-navigation a[data-selected] {
            z-index: 3;
            color: #fff;
            background-color: #5d9cec;
            border-color: #5d9cec;
            cursor: pointer;
        }
        
        .page-navigation a[data-first] {
            border-bottom-left-radius: 6px;
            border-top-left-radius: 6px;
        }
        
        .page-navigation a[data-last] {
            border-bottom-right-radius: 6px;
            border-top-right-radius: 6px;
        }
        
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            border: none !important;
        }
        
        .table > tbody > tr {
            border-top: 1px solid #ddd;
        }
        .card{
            box-shadow: 0px 1px 5px 0px;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="{{asset('vendor/translate/img/sidebar-5.jpg')}}"
         style="background-image: url('../vendor/translate/img/sidebar-5.jpg');direction: ltr">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.aktaa.com" class="simple-text">
                    {{translate('aktaa_translatable',App::getLocale(),'Aktaa Translatable')}}
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{Translatable::localizeURL('translates')}}">
                        <i class="nc-icon nc-notes"></i>
                        <p>{{translate('translate_words',App::getLocale(),'Translate Words')}}</p>
                    </a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="{{Translatable::localizeURL('translates/view')}}">
                        <i class="nc-icon nc-simple-add"></i>
                        <p>{{translate('add_word',App::getLocale(),'Add Word')}}</p>
                    </a>
                </li>
            
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{translate('add_word',App::getLocale(),'Add Word')}}</h4>
                            </div>
                            <div class="card-body">
                                <form class="form" action="{{Translatable::localizeURL('translates')}}" method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="{{is_arabic(translate('word',App::getLocale(),'Word'))?'direction:rtl;text-align:start':''}}">{{translate('word',App::getLocale(),'Word')}}</label>
                                                <input type="text" class="form-control" name="word"
                                                       placeholder="{{translate('word',App::getLocale(),'Word')}}" value="" style="{{is_arabic(translate('word',App::getLocale(),'Word'))?'direction:rtl;text-align:start':''}}">
                                            </div>
                                        </div>
                                        @foreach(Translatable::getSupportedLanguagesKeys() as $locale)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label style="{{is_arabic(translate('text_'.$locale,App::getLocale(),'text_'.$locale))?'direction:rtl;text-align:start':''}}">{{translate('text_'.$locale,App::getLocale(),'text_'.$locale)}}</label>
                                                    @php($name='text_'.$locale)
                                                    <input type="text" class="form-control" name="{{$name}}"
                                                           placeholder="{{translate('text_'.$locale,App::getLocale(),'text_'.$locale)}}"
                                                           value="" style="{{is_arabic(translate('text_'.$locale,App::getLocale(),'text_'.$locale))?'direction:rtl;text-align:start':''}}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit"
                                            class="btn btn-outline-info pull-right">{{translate('save',App::getLocale(),'Save')}}</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav>
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.aktaa.com">{{translate('aktaa_translatable',App::getLocale(),'Aktaa Translatable')}}</a>
                    </p>
                </nav>
            </div>
        </footer>
    </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('vendor/translate/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/translate/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/translate/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/translate/js/plugins/bootstrap-switch.js')}}"></script>
<script src="{{asset('vendor/translate/js/pagination.js')}}"></script>
<script src="{{asset('vendor/translate/js/plugins/bootstrap-notify.js')}}"></script>
<script src="{{asset('vendor/translate/js/demo.js')}}"></script>
<script>
    $(function () {
        $('.form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (data) {
                    demo.showNotification('top', 'right', data.msg);
                    $('.form-control').val('');
                }
            })
        })
    });
    demo.showNotification();
</script>
</html>