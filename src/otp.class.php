<?php
namespace Sakib;

class OTP
{
	/**
	 * Create OTP function
	 *
	 * @param string $email
	 * @param string $otp
	 * @param string $key
	 * @param integer $min
	 * @param string $algo
	 * @return string
	 */	
	public function CreateOTP($email, $otp, $key = "verysecret", $min = 5, $algo = "sha256")
	{
		$expireAfter = time() + $min * 60 * 1000; //Expires after in Minutes, converteed to miliseconds
		$data = $email . $otp . $expireAfter;
		 
		// creating SHA256 hash of the data
		$hash = hash_hmac($algo, $data, $key);
		
		// send email mail("someone@example.com","OTP", "OTP: ".$otp);
		return $hash . "." . $expireAfter;
	}
	
	/**
	 * Verify OTP
	 *
	 * @param string $email
	 * @param string $otp
	 * @param string $hash
	 * @param string $key
	 * @param string $algo
	 * @return boolean
	 */
	public function VerifyOTP($email, $otp, $hash, $key = "verysecret", $algo = "sha256")
	{
		// Hash should have at least one dot
		if (strpos($hash, '.') !== false) {
			// Seperate Hash value and expires from the hash returned from the user
			$hashdata = explode (".", $hash); 
			
			// Check if expiry time has passed
			if (time() > $hashdata[1] ) {
				return false;
			}
			
			// Calculate new hash with the same key and the same algorithm
			$data = $email . $otp . $hashdata[1];
			$newHash = hash_hmac($algo, $data, $key); 
			
			// Match the hashes
			if ($newHash == $hashdata[0]) {
				return true;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * Generate Random String
	 *
	 * @param integer $length
	 * @return string
	 */
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
