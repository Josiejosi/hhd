var app 		= require('http').createServer(handler);
var io 			= require('socket.io')(app);

var Redis 		= require('ioredis');
var redis 		= new Redis();

app.listen(3000, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
    console.log("Got here.") ;
}

io.on('connection', function(socket) {
    //
});

redis.psubscribe('*', function(err, count) {
    console.log(count) ;
});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
    console.log("channel: " + channel + " message: " + message) ;
});