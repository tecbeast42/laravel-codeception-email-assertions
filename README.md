# Installation

```
    composer require tecbeast/laravel-codeception-email-assertions
```

Adapt codeceptions *.suite.yml file.

E.g.
```
class_name: UnitTester
modules:
    enabled:
        - Laravel5 # this is needed before EmailAssertions
        - EmailAssertions # this contains the email assertions
```

## Assertions

All assertions will always look for the last email sent in the current test. The assertions should explain them self :).

```
    $I->seeEmailWasSent();
    $I->seeNoEmailWasSent();
    $I->seeEmailWasSentTo('to@domain.com');
    $I->seeEmailWasNotSentTo('from@domain.com');
    $I->seeEmailWasSentFrom('from@domain.com');
    $I->seeEmailWasNotSentFrom('to@domain.com');
    $I->seeEmailWasNotSentFrom('to@domain.com');
    $I->seeEmailContains('Hello');
    $I->seeEmailContainsNot('Laravel');
```
