# OneSixty

This package allows you to communicate with the OneSixty API in order to send SMS to belgian phone numbers.

You will need to create an account on [One Sixty](https://oneforthy.be).
Upon registration, you have 10 free SMS in order to test this package. 

## Prerequisites

Composer

## Installation

```composer require quentinrasidy/onesixty```

## How to use

1. Create the recipient(s)
2. Set the content
3. Authenticate with OneSixty API
4. Send the SMS

The recipients should be an array of belgian phone numbers.

### Example

```php
$recipients = [];

array_push($recipients,'0492234222');
array_push($recipients,'0492845355');

try{
    //Create the sms
    $s = new Quentinrasidy\Onesixty\Sms;

    //Set the content; the recipients; authenticate and send
    $sms = new Quentinrasidy\Onesixty\Sms;

    $sms->setRecipients($recipients)
    ->setContent('this is a super sms content')
    ->authenticate('mytoken')
    ->send();
    
}catch(Quentinrasidy\Onesixty\SmsException $e){
      //Treat the exception here
}
```

### Reponse
The send() method will return an array of the handled smss with their respective IDs.

If we take the same code as above and store the send() result into a variable : 

```php

$results = $sms->setRecipients($recipients)
->setContent('this is a super sms content')
->authenticate('mytoken')
->send();
    
foreach($results as $result){
    var_dump($result);
}
```

The var_dump method will display the following result : 
````
{
  ["id"]=>
  int(58)
  ["content"]=>
  string(27) "this is a super sms content"
  ["status"]=>
  int(0)
  ["recipient"]=>
  string(12) "+32492234222"
}
array(4) {
  ["id"]=>
  int(59)
  ["content"]=>
  string(27) "this is a super sms content"
  ["status"]=>
  int(0)
  ["recipient"]=>
  string(12) "+32492845355"
}
```

Therefore, you can store the IDs of the SMS that you have sent. This will allow you to get their status later on, for example. 

Also, you can notice that the numbers have been translated to E.169 format. 
## Authors

[Quentin Rasidy](https://www.linkedin.com/in/quentinrasidy/)