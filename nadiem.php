  
<?php
#AUTO CLAIM VOC GOJEK no tf RP 1
#Created By Alip Dzikri X Apri AMsyah
#Reedit Arief
#####################################
$secret = '83415d06-ec4e-11e6-a41b-6c40088ab51e';
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-AppVersion: 3.27.0';
$headers[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
$headers[] = 'X-Location: -6.405821,106.064193';
		echo "[+] Masukan nomor loh pantek  : ";
		$number = trim(fgets(STDIN));
		$numbers = $number[0].$number[1];
		$numberx = $number[5];
		if($numbers == "08") { 
			$number = str_replace("08","628",$number);
		} elseif ($numberx == " ") {
			$number = preg_replace("/[^0-9]/", "",$number);
			$number = "1".$number;
		}
		$nama = nama();
		$email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@gmail.com");
		$data1 = '{"name":"' . $nama . '","email":"' . $email . '","phone":"+' . $number . '","signed_up_country":"ID"}';
		$reg = curl('https://api.gojekapi.com/v5/customers', $data1, $headers);
		$regs = json_decode($reg[0]);
		// Verif OTP
		if($regs->success == true) {
			echo "[+] OTP: ";
			$otp = trim(fgets(STDIN));
			$data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				// Claim Voucher
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-accounts.txt";
				$boba = "live-boba.txt";
    // $fopen1 = fopen($live, "a+");
    // $fwrite1 = fwrite($fopen1, "TOKEN => ".$token." \n NOMOR => ".$number." \n");
    // fclose($fopen1);
	// echo "[+] File Token saved in ".$live." \n";
	echo "[-] Token : $token \n";
    echo "[+] Process Redeem GOFOODSANTAI19 \n";
				$data3 = '{"promo_code":"GOFOODSANTAI19"}';
				$claim = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
				$claims = json_decode($claim[0]);
					if($claims->success == TRUE) {
						echo $claims->data->message;
						echo "\n";
						$fopen1 = fopen($boba, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN => ".$token." \nNOMOR => ".$number." \n");
						fclose($fopen1);
						sleep(6);
						echo "[+] Success Save Token in $boba\n";
						echo "[+] Process Redeem COBAINGOJEK \n";
							$data4 = '{"promo_code":"COBAINGOJEK"}';
					$claim1 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data4, $headers);
					$claims1 = json_decode($claim1[0]);
						echo $claims1->data->message."\n";
						sleep(6);
						echo "[+] Process Redeem AYOCOBAGOJEK \n";
						$data5 = '{"promo_code":"AYOCOBAGOJEK"}';
					$claim5 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data5, $headers);
					$claims5 = json_decode($claim5[0]);
						echo $claims5->data->message."\n";
					}else{
						$fopen1 = fopen($live, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN => ".$token." \nNOMOR => ".$number." \n");
						fclose($fopen1);
						echo "[+] Failed Claim Voucher\n";
						echo "[+] Success Save Token in $live\n";
						//redem voc gofood hemat
						sleep(6);
						echo "[+] Process Redeem GOFOODSANTAI11 \n";
							$data4 = '{"promo_code":"GOFOODSANTAI11"}';
					$claim6 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data4, $headers);
					$claims6 = json_decode($claim6[0]);
						echo $claims6->data->message."\n";
						sleep(6);
						//redeem voc goride
						sleep(5);
						echo "[+] Process Redeem GOFOODPRAKTIS08 \n";
						$data4 = '{"promo_code":"GOFOODPRAKTIS08"}';
					$claim1 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data4, $headers);
					$claims1 = json_decode($claim1[0]);
						echo $claims1->data->message."\n";
						sleep(6);
						echo "[+] Process Redeem AYOCOBAGOJEK \n";
						$data5 = '{"promo_code":"AYOCOBAGOJEK"}';
					$claim5 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data5, $headers);
					$claims5 = json_decode($claim5[0]);
						echo $claims5->data->message."\n";
					}
		}else{
			echo "dah gagal ganti lah\n";
		} 
												
							
	}else{
		echo "Pantek Cari nomor lain bangsat\n";
	}
	function nama()
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	// $rand = json_decode($rnd_get, true);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
	return $name[2][mt_rand(0, 14) ];
	}
function curl($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
	}
