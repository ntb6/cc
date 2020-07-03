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

AWS.config.region = 'us-east-1';

exports.handler = function(evt, context, callback) {
  context.callbackWaitsForEmptyEventLoop = false;

  pool.getConnection(function(err, connection) {
    //request from front
    const request = querystring.parse(evt.body);

    const keyword = '%' + request.keyword + '%';
    const location = request.location;

    var selectSQL = "SELECT * FROM job WHERE title LIKE ?";
    //testing
    //const username = 'nlalta';
    //var selectSQL = "SELECT * FROM job WHERE title LIKE ?";

   //selecting from DB
    connection.query(selectSQL, keyword , function(error, results, fields) {
      connection.release();
      if(error) context.succeed(error);
      if(results.length == 0) {
        const message = 'Job not found';
        context.succeed(message);
      }
      else {
        var response =
          '<html><head><link rel="stylesheet" type="text/css" src="ViewJobs.css"></head><body><table><th>Job Title</th><th>Salary</th><th>Description</th><th>Location</th><th>Years of Experience</th><th>Skill Required</th><th>Select Job</th>';
        Object.keys(results).forEach(function(key) {
          var row = results[key];
          response += '<tr><td>' + row.title + '</td><td>';
          response += row.salary + '</td><td>';
          response += row.description + '</td><td>';
          response += row.location + '</td><td>';
          response += row.yearsexp + '</td><td>';
          response += row.skills + '</td><td>';
          response += '<input type="checkbox" name="check[]" id="Checkbox"></checkbox></tr></table></body</html>';
        });
        context.succeed(response);
      }
    });
  });
};
