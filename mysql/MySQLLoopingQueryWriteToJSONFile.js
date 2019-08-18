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
                fs.writeFileSync('mysql/results.json', data);
                // console.log('Results written to JSON file. \n' + 'Queried randomtotemp results: \n' + data + '\n');
        });
    };

    setInterval(intervalQueryFunc, 5000);

    var connection = mysql.createConnection({multipleStatements: true});

    function intervalChartQueryFunc() {
      connection = "SELECT thermocouple, temperature, UNIX_TIMESTAMP(timestamp) FROM `charttemps` WHERE thermocouple BETWEEN 1 AND 5 ORDER BY timestamp DESC, thermocouple ASC LIMIT 7200";
      con.query(connection, function (err, result) {
          if (err) throw err;

        // time array block
         var timearray = [];
          for (i = 0, j = 0; i < result.length; i=i+5, j++) {
              timearray[j] = result[i]['UNIX_TIMESTAMP(timestamp)'];
          };
          // console.log('Timestamp Data \n ' + timearray + '\n');

        // temperature1 array block
        var temperature1 = [];
        for (i = 0, j = 0; i < result.length; i=i+5, j++) {
          temperature1[j] = result[i].temperature;
        };
        // console.log('Thermocouple 1 data: \n' + temperature1 + '\n');  

        // temperature2 array block
        var temperature2 = [];
        for (i = 1, j = 0; i < result.length; i=i+5, j++) {
          temperature2[j] = result[i].temperature;
        };
        // console.log('Thermocouple 2 data: \n' + temperature2 + '\n'); 

        // temperature3 array block
        var temperature3 = [];
        for (i = 2, j = 0; i < result.length; i=i+5, j++) {
          temperature3[j] = result[i].temperature;
        };
        // console.log('Thermocouple 3 data: \n' + temperature3 + '\n');

        // temperature4 array block
        var temperature4 = [];
        for (i = 3, j = 0; i < result.length; i=i+5, j++) {
          temperature4[j] = result[i].temperature;
        };
        // console.log('Thermocouple 4 data: \n' + temperature4 + '\n');

        // temperature5 array block
        var temperature5 = [];
        for (i = 4, j = 0; i < result.length; i=i+5, j++) {
          temperature5[j] = result[i].temperature;
        };
        // console.log('Thermocouple 5 data: \n' + temperature5 + '\n');

        var concatresult = timearray.reduce(function(arr, v, i) {
          return arr.concat(v*1000, temperature1[i],  temperature2[i],  temperature3[i]); 
       }, []);

       let resultdata = JSON.stringify(concatresult);
       fs.writeFileSync('mysql/chartresults.json', resultdata);
        
        console.log(concatresult);

      });
    };
intervalChartQueryFunc();
setInterval(intervalChartQueryFunc, 60000);

  });