# Refactoring
## Here is the solution of the test task

The task is described in [file](https://github.com/edikbezn/refactoring/blob/master/task.md)

### Instruction

1. Clone repository 
2. Run
```
docker-compose build
docker-compose up -d
```

### Commands

Run tests

```
docker-compose exec php sh -c "phpunit tests"
```

Run app
```
docker-compose exec php sh -c "php testapp.php input.txt"
```
where "input.tst" - file with the list of transactions

Old app (from the description) is in [test.app](https://github.com/edikbezn/refactoring/blob/master/www/app.php)
