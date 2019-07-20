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

$recipient1 = array("name" => 'Quentin', "phone" => '0495345512');
$recipient2 = array("name" => 'Baptiste', "phone" => '0497442828');

array_push($recipients,$recipient1);
array_push($recipients,$recipient2);

try{
    //Create the SMS object
    $sms = new Quentinrasidy\Onesixty\Sms;

    //Set the content and the recipients
    $sms = $sms->setContent('my super content')
    ->setRecipients($recipients);

    //Authenticate and send
    $sms->authenticate('monAddresse@something.something','monSuperPassword')
    ->send();
}catch(Quentinrasidy\Onesixty\SmsException $e){
    //Treat the exception here
}
```

## Authors

[Quentin Rasidy](https://www.linkedin.com/in/quentinrasidy/)

## License

This project is licensed under the Apache2 License - see the [LICENSE.md](LICENSE.md) file for details
