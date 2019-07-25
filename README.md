# OneSixty

This package allows you to communicate with the OneSixty API in order to send SMS to belgian phone numbers.

You will need to create an account on [One Sixty](https://oneforthy.be).
Upon registration, you have 10 free SMS in order to test this package. 

## Prerequisites

PHP 7.1
PHP Composer

## Installation

```composer require quentinrasidy/onesixty```

## How to use
1. Create the recipient(s)
2. Set the content
3. Authenticate with OneSixty API
4. Send the SMS

The recipients should be an array, containing a dictionnary with two keys "name" and "phone" :

```php
$recipients = [];

array_push($recipients,'0482234222');
array_push($recipients,'0492845355');

try{
    //Create the sms
    $s = new Quentinrasidy\Onesixty\Sms;

    //Set the content; the recipients; authenticate and send
    $s = $s->setContent('this is a super sms content')->authenticate('n0LPEy1y0GL3nmx7xt2g6xxOLSXqcntiHxCPzjSTgaNEaS9odja2aWYFOVuM')->send();

}catch(Quentinrasidy\Onesixty\SmsException $e){
      //Treat the exception here
}
```

## Authors

[Quentin Rasidy](https://www.linkedin.com/in/quentinrasidy/)