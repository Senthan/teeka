<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teeka Library Management</title>
    <link href="/components/font-awesome/css/font-awesome.min.css" rel='stylesheet'>
    <link href="/components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/components/angular-ui-grid/ui-grid.min.css" rel="styleSheet">
    <link href="/components/ui-select/dist/select.min.css" rel="styleSheet">
    <link href="/components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/components/sweetalert/dist/sweetalert.css" rel="stylesheet">
    <link href="/components/orgchart/dist/css/jquery.orgchart.css" rel="stylesheet">
    <link href="/components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/components/fullcalendar-scheduler/dist/scheduler.css" rel="stylesheet">
    <link href="/components/semantic/dist/semantic.min.css" rel="stylesheet">
    <link href="/components/video.js/dist/video-js.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/components/jquery-ui/themes/start/jquery-ui.min.css">
    <link rel="stylesheet" href="/components/treant-js/Treant.css">
    <link rel="stylesheet" href="/components/angular-xeditable/dist/css/xeditable.css">
    <link rel="stylesheet" href="/components/dropzone/dist/dropzone.css">
    <link rel="stylesheet" href="/components/emojione/assets/css/emojione.min.css">
    <link rel="stylesheet" href="{{ asset('components/handsontable/dist/handsontable.full.css') }}">
    <link rel="stylesheet" href="/components/toastr/toastr.min.css">
    <link rel="stylesheet" href="/components/angular-hotkeys/build/hotkeys.min.css">
    <link rel='stylesheet' href='/assets/styles/data-table-semantic-ui.css'>
    <link rel='stylesheet' href="/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css">
    <link type="text/css" rel="stylesheet" href="/components/lightgallery/dist/css/lightgallery.css" />


    <link href="{{ asset('assets/admin/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/master.css') }}" rel="stylesheet">
    @section('style')
    @show
</head>
<body id="app-layout">
    @include('layouts.header')
    <div id="app" class="container-fluid">

        @yield('content')
    </div>
    @include('layouts.footer')
    @if(auth()->check())
        @include('chat.popup')
    @endif
    <script src="/components/jquery/dist/jquery.min.js"></script>
    <script src="/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/components/angular/angular.js"></script>
    <script src="/components/angular-touch/angular-touch.js"></script>
    <script src="/components/angular-animate/angular-animate.js"></script>
    <script src="/components/angular-ui-grid/ui-grid.min.js"></script>
    <script src="/components/ui-select/dist/select.min.js"></script>
    <script src="/components/angular-sanitize/angular-sanitize.js"></script>
    <script src="/components/moment/min/moment.min.js"></script>
    <script src="/components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/components/chart.js/dist/Chart.min.js"></script>
    <script src="/components/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/components/nestable/jquery.nestable.js"></script>
    <script src="/components/jquery-ui/jquery-ui.min.js"></script>
    <script src="/components/semantic/dist/semantic.min.js"></script>
    <script src="/components/underscore/underscore.js"></script>
    <script src="/components/socket.io-client/socket.io.js"></script>
    <script src="/components/treant-js/vendor/raphael.js"></script>
    <script src="/components/treant-js/Treant.js"></script>
    <script src="/components/emojione/lib/js/emojione.min.js"></script>
    <script src="/components/jquery-textcomplete/dist/jquery.textcomplete.min.js"></script>
    <script src="/components/angular-xeditable/dist/js/xeditable.js"></script>
    <script src="/components/dropzone/dist/dropzone.js"></script>
    <script src="/components/Sortable/Sortable.min.js"></script>
    <script src="/components/angular-cookies/angular-cookies.js"></script>
    <script src="/components/angularUtils-pagination/dirPagination.js"></script>
    <script src="/components/toastr/toastr.min.js"></script>
    <script src="/components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="/components/fullcalendar-scheduler/dist/scheduler.min.js"></script>
    <script src="{{ asset('components/handsontable/dist/handsontable.full.js') }}"></script>
    <script src="{{ asset('components/ngHandsontable/dist/ngHandsontable.min.js') }}"></script>
    <script src="/components/angular-chart.js/dist/angular-chart.min.js"></script>
    <script src="/components/video.js/dist/ie8/videojs-ie8.min.js"></script>
    <script src="/components/video.js/dist/video.min.js"></script>
    <script src="/components/mark.js/dist/jquery.mark.min.js"></script>
    <script src="/components/angular-hotkeys/build/hotkeys.min.js"></script>
    <script src="/components/clipboard/dist/clipboard.min.js"></script>
    <script src="/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/components/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('assets/admin/js/chat.js') }}"></script>

    <script>

        var app = angular.module('app', ['ngTouch', 'ui.grid', 'ui.grid.selection', 'ui.grid.pagination',
            'ui.grid.resizeColumns', 'ui.grid.moveColumns', 'ui.grid.autoResize', 'ui.select', 'ngSanitize',
            'xeditable', 'ngCookies', 'angularUtils.directives.dirPagination', 'ngHandsontable', 'chart.js', 'cfp.hotkeys', 'ui.grid.edit', 'ui.grid.saveState', 'ui.grid.exporter']);
        app.run(['$http', 'editableOptions', function ($http, editableOptions) {
            $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
            $http.defaults.cache = false;
            editableOptions.theme = 'bs3';
        }]).filter('distance', function () {
            return function (input) {
                if (input >= 1000) {
                    return (input/1000).toFixed(0) + 'km';
                } else {
                    return input + 'm';
                }
            }
        }).filter('propsFilter', function() {
            return function(items, props) {
                var out = [];
                if (angular.isArray(items)) {
                    items.forEach(function(item) {
                        var itemMatches = false;
                        var keys = Object.keys(props);
                        for (var i = 0; i < keys.length; i++) {
                            var prop = keys[i];
                            var text = props[prop].toLowerCase();
                            if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                                itemMatches = true;
                                break;
                            }
                        }
                        if (itemMatches) {
                            out.push(item);
                        }
                    });
                } else {
                    out = items;
                }
                return out;
            };
        }).directive('ckEditor', function() {
            return {
                require: '?ngModel',
                link: function(scope, elm, attr, ngModel) {
                    var ck = CKEDITOR.replace(elm[0]);

                    if (!ngModel) return;

                    ck.on('pasteState', function() {
                        scope.$apply(function() {
                            ngModel.$setViewValue(ck.getData());
                        });
                    });

                    ngModel.$render = function(value) {
                        ck.setData(ngModel.$viewValue);
                    };
                }
            };
        });


        var gridOptions = {
            enableSorting: true,
            enableFiltering: true,
            paginationPageSizes: [10, 30, 50, 100],
            paginationPageSize: 30,
            enableRowSelection: true,
            enableSelectAll: true,
            selectionRowHeaderWidth: 35,
            rowHeight: 35,
            multiSelect:false,
            columnDefs: [
            ]
        };

    </script>
    @section('script')

    @show
    @section('chat-script')

    @show

</body>
</html>