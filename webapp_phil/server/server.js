// const io = require('socket.io')();

// io.on('connection', client => {
//     client.emit('init', { data: 'Hello Guys!'})
// });

// io.listen(3000);

var express = require('express');
var app = express();

var execPHP = require('./execphp.js')();

execPHP.phpFolder = 'C:\\xamppp\\htdocs\\php_sae\\webapp_phil\\app\\server';

app.use('*.php',function(request,response,next) {
	execPHP.parseFile(request.originalUrl,function(phpResult) {
		response.write(phpResult);
		response.end();
	});
});

app.listen(3000, function () {
	console.log('Node server listening on port 3000!');
});