<?php
/**
* UTM PHP - Link
* Salva UTMs no Google Analytics e redireciona para o link desejado
*/

include '../../utm-php.php';

# Informações para WhatsApp
$whatsapp_numb = "5500000000000";
$text = "Gostaria de saber mais informações";

# Insira aqui a URL de destino (exemplo: Whatsapp API)
$url = "https://api.whatsapp.com/send?phone=" . $whatsapp_numb . "&text=" . $text;

# Aqui é como será renderizado o envio do ID da lead
$url .= " (Protocolo de Atendimento: " . utmPHP_cookie( 'utm_content' ) . ")";

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Carregando Link</title>

	<!--
		ATENÇÃO
		Você precisa adicionar o código do Google Analytics ou Google Tag Manager
		neste arquivo, no lugar do código de exemplo a seguir.
	-->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-00000000-0"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-00000000-0');
	</script>
	<!-- End Google Analytics -->

	<!-- Tag com função 'utmPHP_output' que retorna a URL -->
	<meta http-equiv="refresh" content="0; url=<?php echo utmPHP_output( $url ); ?>">
</head>
<body>
	<p>Aguarde, carregando...</p>
</body>
</html>