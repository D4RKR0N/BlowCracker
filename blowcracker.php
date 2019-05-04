<?php

# BRUTEFORCE BCRYPT !
# By: D4RKR0N
echo ("
>> By: D4RKR0N (twitter: @D4RKR0N)
  ____  _                ____                _             
 | __ )| | _____      __/ ___|_ __ __ _  ___| | _____ _ __ 
 |  _ \| |/ _ \ \ /\ / / |   | '__/ _` |/ __| |/ / _ \ '__|
 | |_) | | (_) \ V  V /| |___| | | (_| | (__|   <  __/ |   
 |____/|_|\___/ \_/\_/  \____|_|  \__,_|\___|_|\_\___|_|   

                                                           
>> Salve: TkaTheGod - Xin0x  - Clandestine - Feist - Plastyne - Charlie BCA - Aj4x - Chacal.

");
echo ">> Lista de hashs: "; $hash = fopen("php://stdin","r"); $listahashs = trim(fgets($hash));
$verificalistahashs = file_exists($listahashs);
while(!($verificalistahashs == 1)){
	echo "[-] a lista informada não existe, informe uma lista existente: "; $hash = fopen("php://stdin","r"); $listahashs = trim(fgets($hash));
	$verificalistahashs = file_exists($listahashs);
}
$hashs = explode("\n",file_get_contents($listahashs));
echo ">> Verificando se as hashs são válidas...\n";
sleep(3);
$validas = array();
foreach($hashs as $hashteste){
	$verificacao = substr($hashteste,0,4);
    if($verificacao == "$2y$"){
    	$validas[] = $hashteste;
    	echo "[+] Válida -> $hashteste\n";
    }else{
    	echo "[-] Não é válida -> $hashteste\n";
    }
}
$contar = count($validas);
if($contar != 0){
	echo "[OK] - $contar hashs são válidas em sua lista, informe sua wordlist:"; $pegar = fopen("php://stdin","r"); $word = trim(fgets($pegar));
	while(!(file_exists($word))){
		echo "[X] - Lista informada não existe, informe uma lista existente: "; $pegar = fopen("php://stdin","r"); $word = trim(fgets($pegar));
	}
	$senhas = explode("\n",file_get_contents($word));
	foreach($senhas as $senha){
		$senha = trim($senha);
		foreach($validas as $hash){
			$hash = trim($hash);
			$verifica = password_verify($senha,$hash);
			if($verifica == 1){
				echo "[+] SUCESSO: $senha:$hash\n";
				$f = fopen("cracked.txt","a");
				fwrite($f, "CRACKED: $senha:$hash\n");
				fclose($f);
				$validas = array_diff($validas, ["$hash"]);
			}else{
				echo "[-] FALHA: $senha:$hash\n";
			}
		}
	}
}else{
	echo "[-] Nenhuma hash de sua lista é bcrypt, execute novamente o script e selecione uma lista válida.\n";
}

?>
