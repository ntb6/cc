const AWS = require('aws-sdk');
const querystring = require('querystring');
var mysql = require('mysql');

//connecting to DB
var pool = mysql.createPool({
  host: "icimsproject.c4hdae2hey0k.us-east-1.rds.amazonaws.com",
  user: "nicole",
  password: "Class3027",
  database: "ndl27"
});

/*
pool.getConnection(function(err, connection) {
  const username = 'nlalta';

  var selectSQL = "SELECT * FROM login WHERE username=?";

  connection.query(selectSQL, [username], function(error, results, fields) {
    connection.release();
    if(error) console.log(error);
    Object.keys(results).forEach(function(key) {
      var row = results[key];

      const firstName = row.firstName;
      const lastName = row.lastName;
      const userName = row.username;
      const password = row.password;
      const email = row.email;

      var response = {
        firstname: firstName,
        lastName: lastName,
        userName: userName,
        password: password,
        email: email
      };
      console.log(response);
    });
    //else console.log(results);
  });
});
*/

AWS.config.region = 'us-east-1';

exports.handler = function(evt, context, callback) {
  context.callbackWaitsForEmptyEventLoop = false;

  pool.getConnection(function(err, connection) {
    //parsing raw request body
    const formData = querystring.parse(evt.body);

    const username = formData['userName'];

    //testing
    //const username = 'nlalta';
    var selectSQL = "SELECT * FROM login WHERE username=?";

    //selecting from DB
    connection.query(selectSQL, [username], function(error, results, fields) {
      connection.release();
      if(error) callback(null, error);
      else callback(null, results);
      /*
      Object.keys(results).forEach(function(key) {
        var response = results[key];
        callback(null, response);
      });
      */
    });
  });
};
