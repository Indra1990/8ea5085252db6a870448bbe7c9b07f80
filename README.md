#Run App
1. cp .env.example .env
2. cd src/  cp .env.example .env 
3. run command "docker-compose up" or if you any update at dockerfile "docker-compose up --build" 
4. run command "composer install"
5. for create table message in file "create-table.txt" 

#Authentication
- curl --location --request POST 'http://localhost:8080/create_token.php' \
  --header 'Content-Type: application/json' \
  --data-raw '{
      "email" :"test@test.com"
  }'
  
- curl --location --request GET 'http://localhost:8080/auth.php' \
  --header 'Authorization: Bearer     eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRlc3RAdGVzdC5jb20iLCJleHAiOjE2NzEzMTM1NjV9.5IDMRllc4QWasHx07e85lNnvv5e9lxi1eTnjQKgIIWk' \
  --data-raw ''


#Queue By Redis
- curl --location --request POST 'http://localhost:8080/publisher.php' \
  --header 'Content-Type: application/json' \
  --data-raw '
          {
              "title" : "title dhfisdnfsdnjkfsdf",
              "desc" : "desc 126546464654"
          }
  '

- curl --location --request GET 'http://localhost:8080/consumer.php'
