const mysql_import = require('mysql-import');
const fs = require('fs');

function intervalRandomToTemp() {
var importer = mysql_import.config({
	host: 'localhost',
	user: 'root',
	password: 'summit800',
	database: 'currenttemp',
	onerror: err=>console.log(err.message)
});

var d = new Date();

importer.import('mysql/randomtotemp.sql').then(()=> {
    console.log('imported randomtotemp SQL file executed!'+d);
});

};

intervalRandomToTemp();
setInterval(intervalRandomToTemp, 5000);