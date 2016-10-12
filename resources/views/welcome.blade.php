<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body ng-app="laraApp">

    <h1>New User</h1>
    <ul ng-controller="chatController as ctrl">
        <li ng-repeat="user in ctrl.users">@{{user}}</li>
    </ul>
    {!! Html::script('bower_components/angular/angular.min.js') !!}
    {!! Html::script('bower_components/socket.io-client/socket.io.js') !!}

    <script>
        var socket = io('http://127.0.0.1:3000');

        var app = angular.module('laraApp', []);
        (function(module){
            var chatController = function(){
                var ctrl = this;
                ctrl.users = ['test', 'test2', 'test3'];
                var id = 1;
                socket.on('test-channel' + id + ':App\\Events\\UserSignedUp', function(data) {
                    if(data.data.id == 1) {
                        ctrl.users.push(data.data.username);
                        console.log(ctrl.users);
                    }
                    else {
                        console.log('foo');
                    }
                });
            }
            module.controller('chatController', chatController);

        })(angular.module('laraApp'));
    </script>
    </body>
</html>
