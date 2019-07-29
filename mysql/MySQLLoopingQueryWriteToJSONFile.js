var mysql = require('mysql');
const fs = require('fs');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "summit800",
  database: 'currenttemp'
});

    con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");

    function intervalQueryFunc() {
        var sql = "SELECT temperature FROM temperatures";
        con.query(sql, function (err, result) {
            if (err) throw err;
                var newresult = result.map( value => value.temperature);
                let data = JSON.stringify(newresult);
                console.log('Queried JSON Data: \n' + data + '\n');
                fs.writeFileSync('results.json', data);
        });
    };

    setInterval(intervalQueryFunc, 5000);

    var connection = mysql.createConnection({multipleStatements: true});

    function intervalChartQueryFunc() {
      connection = "SELECT thermocouple, temperature, UNIX_TIMESTAMP(timestamp) FROM `charttemps` WHERE thermocouple BETWEEN 1 AND 5 ORDER BY timestamp DESC, thermocouple ASC LIMIT 15";
      con.query(connection, function (err, result) {
          if (err) throw err;
          for (i = 0; i < result.length; i=i+5) {
          // console.log(result.map(value => Math.round(new Date(value.timestamp).getTime()/1000))[i]);
          console.log(result[i].temperature);
          console.log(result[i+1].temperature);
          console.log(result[i+2].temperature);
          console.log(result[i+3].temperature);
          console.log(result[i+4].temperature);
          };
      });
    };

  setInterval(intervalChartQueryFunc, 5000);

  });