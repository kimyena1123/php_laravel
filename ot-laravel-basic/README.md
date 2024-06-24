mysql를 도커가 아닌 brew services start mysql@8.0으로 직접 서버 실행함

그래서 DB_HOST을 mysql이 아닌 127.0.0.1로 수정하고, database username, password, database를 알맞게 연결함.

서버 시작은 vendor/bin/sail로 했을 때, 문제가 발생하고 실행이 안되기에, php artisan serve로 했더니 잘 됨. 
하지만 내가 APP_PORT를 9500으로 지정했는데 해당 포트가 안나오고 8000으로 나오는 문제 발생하지만 에러는 발생하지 않는다. 

그래서  php artisan serve --port=9500 로 했는데, 똑같이 에러 발생하지 않고 잘 됨. 
아직까진  php artisan serve --port=9500로 서버 실행하고, 문제가 발생할 시 수정할 예정임.
