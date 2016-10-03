var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');

var redis = new Redis();
console.log('foo');
redis.subscribe('test-channel');
redis.subscribe('broadcast');
redis.subscribe('App.User.1');
redis.subscribe('App.User.*');

redis.on('message', function(channel, message) {
    console.log(channel,message);
    var message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
server.listen(3000);