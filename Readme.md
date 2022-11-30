# news parsing service

news parsing service from a news resource using symfony.

## Built on

- Symfony 5.4
- Php 7.4
- Mysql
- Bootstrap 5.1
- Docker (docker-compose)
- RabbitMQ

## Requirements

- docker
- docker-compose

## Setup

```bash
cd ...service/dir
```

- Start the service

```bash
docker-compose up -d
```

- To populate news run symfony command parsenews

```bash
 docker-compose exec web_service  php  /var/www/project/bin/console Parsenews
```

- Once service is up, open on http://localhost:8000/
  - admin
    - user: admin@test.com  
      password: 12345678
  - non-admin
    - user: moderator@test.com  
      password: 12345678




![Alt text](/docs/landing.png?raw=true "News Landing Page")




## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
