<?php
namespace Sakib;
class OTP
{
	
	public function CreateOTP($email, $otp, $key = "verysecret", $min = 5, $algo = "sha256")
	{
		$expire_after = time() + $min * 60 * 1000; //Expires after in Minutes, converteed to miliseconds
		$data = $email.$otp.$expire_after;
		$hash = hash_hmac($algo, $data, $key); // creating SHA256 hash of the data
		// send email mail("someone@example.com","OTP", "OTP: ".$otp);
		return $hash.".".$expire_after;
	}
	
	public function VerifyOTP($email,$otp,$hash,$key="verysecret", $algo = "sha256")
	{
		// Hash should have at least one dot
		if (strpos($hash, '.') !== false) {
			// Seperate Hash value and expires from the hash returned from the user
			$hashdata = explode (".", $hash); 
			// Check if expiry time has passed
			if(time() > $hashdata[1] ){
				return false;
				}
			// Calculate new hash with the same key and the same algorithm
			$data = $email.$otp.$hashdata[1];
			$newHash = hash_hmac($algo, $data, $key); 
			// Match the hashes
			if($newHash == $hashdata[0]){
				return true;
			}
			} else {
				return false;
			}
	}
	
	public function generateRandomString($length = 6)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
}
