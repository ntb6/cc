const AWS = require('aws-sdk');
const querystring = require('querystring');
var mysql = require('mysql');

//connecting to db
var pool = mysql.createPool({
	host: "icimsproject.c4hdae2hey0k.us-east-1.rds.amazonaws.com",
	user: "nicole",
	password: "Class3027",
	database: "ndl27"
});

// Set this to the region you upload the Lambda function to.
AWS.config.region = 'us-east-1';

exports.handler = function(evt, context, callback) {
  //prevent timeout from waiting event loop
  context.callbackWaitsForEmptyEventLoop = false;

  pool.getConnection(function(err, connection) {
    //parsing raw request body
    const formData = querystring.parse(evt.body);
    //separating form data
    const username = formData['username'];
		const skills = formData['skills'];
		const experience = formData['experience'];
		const education = formData['education'];
		const activities = formData['activities'];
		const projects = formData['projects'];

    var insertSQL = "INSERT INTO resume(username, skills, experience, education, activities, projects) VALUES ?";

    var values = [
      [username, skills, experience, education, activities, projects]
    ];

   //insert form data into DB
    connection.query(insertSQL, [values], function(error, results, fields) {
      connection.release();
      if(error) callback(error);
      else callback(null, `<!DOCTYPE html><p>Resume Uploaded!</p></html>`);
    });
  });
/*
    // Our field from the request.
    const my_field = params['my-field'];

    // Generate HTML.
    const html = `<!DOCTYPE html><p>You said: ` + my_field + `</p>`;

    // Return HTML as the result.
    callback(null, html);

*/
};
