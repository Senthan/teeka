@section('title', 'Notes Management')
@extends('layouts.master')
@section('content')

    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li class="active">Note Management</li>
    </ul>

    <div class="ui segments"  data-ng-controller="NoteController">
        <div class="ui segment clearfix">
            <h2 class="pull-left h2-margin-bottom">
                <span  data-ng-show="selected" data-ng-cloak>@{{ selected.title }}</span>
            </h2>
            <div class="pull-right">
                <a class="ui button green" href="{{ route('note.create') }}">Create</a>
                <a data-ng-show="selected" data-ng-href="@{{ show_url }}" class="ui button teal" data-ng-cloak>Show</a>
                <a data-ng-show="selected" data-ng-href="@{{ edit_url }}" class="ui button blue" data-ng-cloak>Edit</a>
                <a data-ng-show="selected" data-ng-href="@{{ delete_url }}" class="ui button red" data-ng-cloak>Delete</a>
                <a data-ng-show="selected" data-ng-href="@{{ show_url }}/share" class="ui button orange" data-ng-cloak>Share</a>
            </div>
        </div>
        <div class="ui green segment">
            <div data-ui-grid="gridOptions" data-ui-grid-pagination data-ui-grid-selection class="grid"></div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        app.controller('NoteController', ['$scope', '$http', function ($scope, $http) {
            $scope.moduleUrl = "{{ route('note.index') }}/";
            $scope.campaigns = [];
            var columnDefs = [
                { displayName: 'Title', field: 'title'},
                { displayName: 'Created At', field: 'created_at'}
            ];
            gridOptions.columnDefs = columnDefs;
            gridOptions.onRegisterApi = function (gridApi) {
                $scope.gridApi = gridApi;
                gridApi.selection.on.rowSelectionChanged($scope,function(rows){
                    $scope.setSelection(gridApi);
                });
                gridApi.selection.on.rowSelectionChangedBatch($scope,function(rows){
                    $scope.setSelection(gridApi);
                });
            };
            $scope.gridOptions = gridOptions;

            $http.get($scope.moduleUrl + '?ajax=true').success(function (items) {
                $scope.gridOptions.data =  items;
            });
            $scope.setSelection = function(gridApi) {
                $scope.mySelections = gridApi.selection.getSelectedRows();
                if($scope.mySelections.length == 1) {
                    $scope.selected = $scope.mySelections[0];
                    $scope.show_url = $scope.moduleUrl + $scope.selected.id + '';
                    $scope.stats_url = $scope.moduleUrl + $scope.selected.id + '/stats';
                    $scope.edit_url = $scope.moduleUrl + $scope.selected.id + '/edit';
                    $scope.delete_url = $scope.moduleUrl + $scope.selected.id + '/delete';
                } else {
                    $scope.selected = null;
                }
            };
        }]);
    </script>
@endsection