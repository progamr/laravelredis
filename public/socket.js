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
    // data passed from the server contains the id of the user
    // so we will use it to emit to his private channel ex: test-channel1 (message.data.data.id)
    // and on the client we will listen on this private channel
    // using the same user id on the client side
    console.log(channel + message.data.data.id +':' + message.event);
    io.emit(channel + message.data.data.id +':' + message.event, message.data);
});
server.listen(3000);