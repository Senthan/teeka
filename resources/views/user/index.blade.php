@extends('layouts.master')
@section('title', 'User')
@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li class="active">User management</li>
    </ul>
    <div class="panel panel-default" data-ng-controller="LibraryUserController">
        <div class="panel-body">
            <div>
                <div data-ui-grid="gridOptions" data-ui-grid-pagination data-ui-grid-selection class="grid"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        app.controller('LibraryUserController', ['$scope', '$http', function ($scope, $http) {
            $scope.moduleUrl = "{{ route('user.index') }}/";
            var columnDefs = [
                { displayName: 'Name', field: 'name'},
                { displayName: 'Email', field: 'email'}
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
                } else {
                    $scope.selected = null;
                }
            };
        }]);
    </script>
@endsection