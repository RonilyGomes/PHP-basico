<?php
/**
 * Classe auxiliadora para tratar dados antes de inserir no banco e formatar nos arquivos de visao
 * @author Ronily
 *
 */
class ConvUtil{
	
	/**
	 * Método usado para limpar o cpf
	 * @param String $cpf
	 * @return String
	 */
	public static function limpaCpf($cpf){
		return str_replace(".", "", str_replace("-", "", $cpf));
	}
	
	/**
	 * Limpa o RG
	 * @param unknown $rg
	 * @return String
	 */
	public static function limpaRg($rg){
		return str_replace(".", "", str_replace("-", "", $rg));
	}
	
	//Método que formata visualmente o $cpf vindo do banco de dados 
	public static function formataCpf($cpf){
		
		//retira formato
		$codigoLimpo = str_replace('.', '', str_replace('-', '', str_replace(' ', '', $cpf)));
		// pega o tamanho da string menos os digitos verificadores
		$tamanho = (strlen($codigoLimpo) -2);
		//verifica se o tamanho do cÃ³digo informado Ã© vÃ¡lido
		if ($tamanho != 9 && $tamanho != 12)
			return false; 
	 
		// seleciona a mÃ¡scara para cpf ou cnpj
		$mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##'; 
	 
		$indice = -1;
		for ($i=0; $i < strlen($mascara); $i++) 
			if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
		
			//retorna o campo formatado
		$retorno = $mascara;
	 
		return $retorno;
	}
	
	//Método que formata visualmente o $dataNascimento vindo do banco de dados
	public static function dateToData($data){
		$dataArr = explode("-", $data);
		return $dataArr[2] . '/' . $dataArr[1] . '/' . $dataArr[0]; 
	}
}