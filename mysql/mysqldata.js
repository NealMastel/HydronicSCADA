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

    var connection = mysql.createConnection({multipleStatements: true});

    function intervalChartQueryFunc() {
    
      con.query('UPDATE `temperatures`SET thermocouple = 1, temperature = ROUND((1770 + rand() * 180)/10,1), time = NOW()WHERE thermocouple = 1; UPDATE `temperatures`SET thermocouple = 2, temperature = ROUND((1770 + rand() * 180)/10,1), time = NOW()WHERE thermocouple = 2;' ,[1,2], function (err, result) {
          if (err) throw err;
          console.log("records Updated!")
      });
    };

  setInterval(intervalChartQueryFunc, 5000);

  });