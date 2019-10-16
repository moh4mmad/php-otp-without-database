# PHP OTP Without Database
## What is it?
This is a simple script written in php to verify One Time Password **(OTP)** without any database. You can read the [blog post here](https://blog.anam.co/otp-verification-without-using-a-database/) to understand the technique and motivation.

## How to install
```
git clone https://github.com/moh4mmad/php-otp-without-database.git
```
or
```
composer require moh4mmad/php-otp-without-database
 ```
## Usage
You need additional tool to send SMS. This module only takes care of the verification part.
## Verification process
OTP verification is done in the following steps:
 - A hash is created with the phone number/email address and then sent to the user.
 - The user also receives the OTP via SMS, email or any other method.
 - The user sends back the hash, OTP and phone/email used in the first request.
 - The server verifies the information and returns true if they match.

## Generating OTP Hash
```
$otp = new OTP;
$email = "test@abc.com";
$code = $otp->generateRandomString(6);
$hash = $otp->CreateOTP($email, $code);
```
You can then send this hash to the user as response.
```
CreateOTP($email, $otp, $key = "verysecret", $min = 5, $algo = "sha256");
```
## Verifying OTP hash
The user should get the hash from the HTTP request and should get the real OTP via SMS or email.
Then when the user sends back the information, they can be verified with the following code:
```
VerifyTOP($email, $otp, $hash, $key="verysecret", $algo = "sha256");
```
This method returns a Boolean. If the verification is successful, it will return true.

## Issues
If you come across any issues please report them [here](github.com/moh4mmad/php-otp-without-database/issues)
