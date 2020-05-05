<?php
/**
* UTM PHP
* V. 1.0
* Projeto open source para rastrear UTMs dentro do site usando Google Analytics
* License MIT - https://github.com/gmasson/utm-php/blob/master/LICENSE
*/

# Insira aqui o UA do seu Google Analytics
$id_ga = "UA-00000000-0";

# ------------------------------------------
# Não altere nada a partir daqui
# ------------------------------------------

# Filtro de parametros GET
function utmPHP_filter( $input, $with_empty = 'ND' )
{
	if ( isset( $_GET[ $input ] ) )
	{
		$input = htmlspecialchars( $_GET[ $input ] );
		$input = trim( $input );
		return $input;
	} else {
		return $with_empty;
	}
}

# Preenche os Cookies que duram 10 dias
setcookie( 'utm_source', utmPHP_filter( 'utm_source' ), time() + ( 10 * 24 * 3600 ) );
setcookie( 'utm_medium', utmPHP_filter( 'utm_medium' ), time() + ( 10 * 24 * 3600 ) );
setcookie( 'utm_campaign', utmPHP_filter( 'utm_campaign' ), time() + ( 10 * 24 * 3600 ) );
setcookie( 'utm_term', utmPHP_filter( 'utm_term' ), time() + ( 10 * 24 * 3600 ) );

# Cria a hash
$hashUTM = date( 'dmY' ) . '-' . date( 'H' ) . rand( 1000, 1999 );

# Verificação para preenchimento único do ID do usuário
if ( ! isset( $_COOKIE[ 'utm_content' ] ) )
{
	setcookie( 'utm_content', $hashUTM, time() + ( 10 * 24 * 3600 ) );
}

# Exibindo dados dos cookies
function utmPHP_cookie( $input )
{
	global $hashUTM;

	# Verifica se o cookie esta vazio
	if ( ! isset( $_COOKIE[ $input ] ) )
	{
		if ( $input == 'utm_content' )
		{
			# Exibe a hash gerada
			return $hashUTM;
		} else {
			# Exibe o que tem na URL
			return utmPHP_filter( $input );
		}

	} else {
		return $_COOKIE[ $input ];
	}
}

# Recuperar informações dos cookies 
# Nos parentes pode controlar se vai começar com 'interrogação' ou '&' (inicio ou complemento de parametros da URL)
function utmPHP( $with_e = '?' )
{
	# Coloca as UTMs em variaveis para serem usadas no código
	$utm_source = 'utm_source=' . utmPHP_cookie( 'utm_source' );
	$utm_medium = 'utm_medium=' . utmPHP_cookie( 'utm_medium' );
	$utm_campaign = 'utm_campaign=' . utmPHP_cookie( 'utm_campaign' );
	$utm_term = 'utm_term=' . utmPHP_cookie( 'utm_term' );
	$utm_content = 'utm_content=' . utmPHP_cookie( 'utm_content' );
	return $with_e . $utm_source . '&' . $utm_medium . '&' . $utm_campaign . '&' . $utm_term . '&' . $utm_content;
}

# Tag para redirecionar a página
function utmPHP_tagRefresh( $url )
{
	if ( utmPHP_filter( 'utm_content' ) == 'ND' ) {
		return "<meta http-equiv=\"refresh\" content=\"0; url=index.php" . utmPHP() . "\">";
	} else {
		return "<meta http-equiv=\"refresh\" content=\"0; url=" . $url . "\">";
	}
}
