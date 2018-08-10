For JWT Authentication I used:

https://emirkarsiyakali.com/implementing-jwt-authentication-to-your-api-platform-application-885f014d3358

Register a new user:

curl -X POST http://localhost:8000/register -d _username=username -d _password=password

Get a JWT Token:

curl -X POST -H "Content-Type: application/json" http://localhost:8000/login_check -d '{"username":"XXX","password":"XXX"}'

Example of accessing secured routes:

GET Method

curl -X GET -H "Authorization: Bearer [TOKEN]" http://localhost:8000/api/{LeagueId}

DELETE Method

curl -X DELETE -H "Authorization: Bearer [TOKEN]" http://localhost:8000/api/{LeagueId}
