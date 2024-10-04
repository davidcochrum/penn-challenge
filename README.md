# David Cochrum's Penn Entertainment Coding Challenge

This repository contains my completed coding challenge which shows off my mad skills to Penn Entertainment. 

## Run the Application
To run the application in development, you can run this command:
```bash
docker-compose up -d
```
After that, open http://localhost:8080 in your browser.

## Run Unit Tests
Run this command in the application directory to run the test suite:

```bash
composer test
```

## TODO

- [ ] Validation: without the ability to pull in any more libraries, the validation of inputs is limited to just query
parameterization.
- [ ] Store point earn/redeem descriptions: the schema described in the instructions didn't include a place to store the
descriptions of point earning or redemption. I would recommend a `point_history` table with tracks changes in a user's
points balance over time including the descriptions.

## Conclusion
I trust you're thoroughly impressed and will make me an offer immediately. Maybe we'll just schedule the next interview
stage. Either is fine with me.
