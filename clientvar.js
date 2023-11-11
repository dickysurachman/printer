var net = require('net');

var client = new net.Socket();
client.connect(5006, '127.0.0.1', function() {
  console.log('Connected');
  client.write('(90)09214210984902(01)40928048021840(10)B1214(17)010224(21)21098414001');
});

client.on('data', function(data) {
  console.log('Received: ' + data);
  client.destroy(); // kill client after server's response
});

client.on('close', function() {
  console.log('Connection closed');
});