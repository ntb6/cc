const AWS = require('aws-sdk');
const querystring = require('querystring');
var mysql = require('mysql');
var bodyParser = require('body-parser');
'use strict';

//connecting to db
var pool = mysql.createPool({
	host: "icimsproject.c4hdae2hey0k.us-east-1.rds.amazonaws.com",
	user: "nicole",
	password: "Class3027",
	database: "ndl27",
	multipleStatements: true
});

// Set this to the region you upload the Lambda function to.
AWS.config.region = 'us-east-1';

exports.handler = function(evt, context, callback) {
  //prevent timeout from waiting event loop
  context.callbackWaitsForEmptyEventLoop = false;

  pool.getConnection(function(err, connection) {
    //parsing raw request body
		const request = JSON.parse(JSON.stringify(evt));

    //multiple sql statements
    var sql = "SELECT * FROM job; ";
    sql += "SELECT * FROM skills;";

    //query
    connection.query(sql, function(error, results) {
      connection.release();
      if(results.length == 0) {
        const message = "Query is empty";
        const response = {
          statusCode: 200,
          headers: {
            "Content-Type":"application/json"
          },
          body: {
            message: message
          }
        };
        context.succeed(response);
      }
      else {
        var jobData = results[0];
        var skillsData = results[1];
        const response = {
          statusCode: 200,
          headers: {
            "Content-Type":"application/json"
          },
          body: {
            jobData: jobData,
            skillsData: skillsData
          }
        };
        context.succeed(response);
      }
    });
/*


    const jobSQL = "SELECT * FROM job;";

    //job query
		connection.query(jobSQL, function(error, results) {
			connection.release();
      if(results.length == 0) {
        jobMessage += "No Job found in table";
      }
      else {
        var jobData = results;
      }
		});


    const skillsSQL = "SELECT * FROM skills;";

    //skills query
    connection.query(skillsSQL, function(error, results) {
      connection.release();
      if(results.length == 0) {
        message += "No skills found in table";
      }
      else {
        var skillsData = results;
      }
    });

    const response = {
      statusCode: 200,
      headers: {
        "Content-Type": "application/json"
      },
      body: {
        jobMessage: jobMessage,
        skillsMessage: skillsMessage,
        skillsData: skillsData
      }
    };

    context.succeed(response);

    */

  });
};
