<?php
/**
* UTM PHP
* V. 1.1.2
* Projeto open source para rastrear UTMs dentro do site usando Google Analytics
* License MIT - https://github.com/gmasson/utm-php/blob/master/LICENSE
*/

# Filtro de parametros GET
function utmPHP_filter( $input, $with_empty = '-' ) {

	if ( isset( $_GET[ $input ] ) ) {
		$input = htmlspecialchars( $_GET[ $input ] );
		$input = trim( $input );
		return $input;
	} else {
		return $with_empty;
	}

}

# Preenche o Cookie 'utm_source' (duração de 12 horas)
if ( ! isset( $_COOKIE[ 'utm_source' ] ) ) {
	setcookie( 'utm_source', utmPHP_filter( 'utm_source' ), time() + ( 12 * 3600 ) );
} else {
	# Se cookie existe, preenche-o novamente, caso o filtro não retornar '-'
	if ( utmPHP_filter( 'utm_source' ) != '-' ) {
		setcookie( 'utm_source', utmPHP_filter( 'utm_source' ), time() + ( 12 * 3600 ) );
	}
}

# Preenche o Cookie 'utm_medium' (duração de 12 horas)
if ( ! isset( $_COOKIE[ 'utm_medium' ] ) ) {
	setcookie( 'utm_medium', utmPHP_filter( 'utm_medium' ), time() + ( 12 * 3600 ) );
} else {
	# Se cookie existe, preenche-o novamente, caso o filtro não retornar '-'
	if ( utmPHP_filter( 'utm_medium' ) != '-' ) {
		setcookie( 'utm_medium', utmPHP_filter( 'utm_medium' ), time() + ( 12 * 3600 ) );
	}
}

# Preenche o Cookie 'utm_campaign' (duração de 12 horas)
if ( ! isset( $_COOKIE[ 'utm_campaign' ] ) ) {
	setcookie( 'utm_campaign', utmPHP_filter( 'utm_campaign' ), time() + ( 12 * 3600 ) );
} else {
	# Se cookie existe, preenche-o novamente, caso o filtro não retornar '-'
	if ( utmPHP_filter( 'utm_campaign' ) != '-' ) {
		setcookie( 'utm_campaign', utmPHP_filter( 'utm_campaign' ), time() + ( 12 * 3600 ) );
	}
}

# Preenche o Cookie 'utm_term' (duração de 12 horas)
if ( ! isset( $_COOKIE[ 'utm_term' ] ) ) {
	setcookie( 'utm_term', utmPHP_filter( 'utm_term' ), time() + ( 12 * 3600 ) );
} else {
	# Se cookie existe, preenche-o novamente, caso o filtro não retornar '-'
	if ( utmPHP_filter( 'utm_term' ) != '-' ) {
		setcookie( 'utm_term', utmPHP_filter( 'utm_term' ), time() + ( 12 * 3600 ) );
	}
}

# Cria a hash
$hashUTM = date( 'dmY' ) . '-' . date( 'H' ) . rand( 1000, 1999 );

# Verifica o cookie utm_content para preenchimento único do ID do usuário
if ( ! isset( $_COOKIE[ 'utm_content' ] ) ) {
	# Preenche o Cookie 'utm_content' (duração de 90 dias)
	setcookie( 'utm_content', $hashUTM, time() + ( 90 * 24 * 3600 ) );
}

# Exibindo dados dos cookies
function utmPHP_cookie( $input ) { 
	/*
	No acesso direto ai site, todos os parametros são preenchidos, MUDAR ISSO
	procurar a parte que preenche com o que esta no cookie e dar prioridade para o que vem da url
	*/

	global $hashUTM;

	# Verifica se o cookie esta vazio (para acessos diretos)
	if ( ! isset( $_COOKIE[ $input ] ) ) {
		
		if ( $input == 'utm_content' ) {
			//setcookie( 'utm_content', $hashUTM, time() + ( 90 * 24 * 3600 ) );
			return $hashUTM;
		} else {
			//setcookie( $input, utmPHP_filter( $input ), time() + ( 90 * 24 * 3600 ) );
			return utmPHP_filter( $input );
		}

	} else {
		if ( utmPHP_filter( $input ) != '-' ) {
			return utmPHP_filter( $input );
		} else {
			return $_COOKIE[ $input ];
		}
	}

}

# Recuperar informações dos cookies 
# Nos parentes pode controlar se vai começar com 'interrogação' ou '&' (inicio ou complemento de parametros da URL)
function utmPHP_link( $url = '', $with_e = '?' ) {

	# Coloca as UTMs em variaveis para serem usadas no código
	$utm_source = 'utm_source=' . utmPHP_cookie( 'utm_source' );
	$utm_medium = 'utm_medium=' . utmPHP_cookie( 'utm_medium' );
	$utm_campaign = 'utm_campaign=' . utmPHP_cookie( 'utm_campaign' );
	$utm_term = 'utm_term=' . utmPHP_cookie( 'utm_term' );
	$utm_content = 'utm_content=' . utmPHP_cookie( 'utm_content' );
	return $url . $with_e . $utm_source . '&' . $utm_medium . '&' . $utm_campaign . '&' . $utm_term . '&' . $utm_content;

}

# Gerador da URL de saída
function utmPHP_output( $url, $with_utm = 'n' ) {

	# Adiciona o endereço correto para redirecionar
	if ( utmPHP_filter( 'utm_content' ) == '-' ) {
		# Redirecionamento necessário para o GA capturar as UTMs caso haver acesso direto
		return utmPHP_link( 'index.php' );
	} else {

		# Se for diferente de 'n', adiciona as UTMs na url de destino
		if ( $with_utm != 'n' ) {
			return utmPHP_link( $url );
		} else {
			return $url;
		}
	}

}
