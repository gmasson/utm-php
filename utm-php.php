<?php
/**
* UTM PHP
* V. 1.0
* Projeto open source para rastrear UTMs dentro do site usando Google Analytics
* License MIT - https://github.com/gmasson/utm-php/blob/master/LICENSE
*/

# Filtro de parametros GET
function utmPHP_filter( $input, $with_empty = '-' )
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

# Preenche os Cookies que duram 90 dias

# Preenche o utm_source
if ( utmPHP_filter( 'utm_source' ) !== '-' )
{
	setcookie( 'utm_source', utmPHP_filter( 'utm_source' ), time() + ( 90 * 24 * 3600 ) );
}

# Preenche o utm_medium
if ( utmPHP_filter( 'utm_medium' ) !== '-' )
{
	setcookie( 'utm_medium', utmPHP_filter( 'utm_medium' ), time() + ( 90 * 24 * 3600 ) );
}

# Preenche o utm_campaign
if ( utmPHP_filter( 'utm_campaign' ) !== '-' )
{
	setcookie( 'utm_campaign', utmPHP_filter( 'utm_campaign' ), time() + ( 90 * 24 * 3600 ) );
}

# Preenche o utm_term
if ( utmPHP_filter( 'utm_term' ) !== '-' )
{
	setcookie( 'utm_term', utmPHP_filter( 'utm_term' ), time() + ( 90 * 24 * 3600 ) );
}

# Cria a hash
$hashUTM = date( 'dmY' ) . '-' . date( 'H' ) . rand( 1000, 1999 );

# Verifica o cookie utm_content para preenchimento único do ID do usuário
if ( ! isset( $_COOKIE[ 'utm_content' ] ) )
{
	setcookie( 'utm_content', $hashUTM, time() + ( 90 * 24 * 3600 ) );
}

# Exibindo dados dos cookies
function utmPHP_cookie( $input )
{
	global $hashUTM;

	# Verifica se o cookie esta vazio (para acessos diretos)
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
function utmPHP_link( $path, $with_e = '?' )
{
	# Coloca as UTMs em variaveis para serem usadas no código
	$utm_source = 'utm_source=' . utmPHP_cookie( 'utm_source' );
	$utm_medium = 'utm_medium=' . utmPHP_cookie( 'utm_medium' );
	$utm_campaign = 'utm_campaign=' . utmPHP_cookie( 'utm_campaign' );
	$utm_term = 'utm_term=' . utmPHP_cookie( 'utm_term' );
	$utm_content = 'utm_content=' . utmPHP_cookie( 'utm_content' );
	return $path . $with_e . $utm_source . '&' . $utm_medium . '&' . $utm_campaign . '&' . $utm_term . '&' . $utm_content;
}

# Tag para redirecionar a página
function utmPHP_tagRefresh( $url )
{
	if ( utmPHP_filter( 'utm_content' ) == '-' ) {
		return "<meta http-equiv=\"refresh\" content=\"0; url=" . utmPHP_link( 'index.php' ) . "\">";
	} else {
		return "<meta http-equiv=\"refresh\" content=\"0; url=" . $url . "\">";
	}
}
