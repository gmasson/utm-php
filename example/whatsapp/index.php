<?php
/**
* UTM PHP - Link
* Salva UTMs no Google Analytics e redireciona para o link desejado
*/

include '../../utm-php/core.php';

# Informações para WhatsApp
$whatsapp = "5500000000000";
$text = "Gostaria de saber mais informações";

# Insira aqui a URL de destino (exemplo: Whatsapp API)
$url = "https://api.whatsapp.com/send?phone=" . $whatsapp . "&text=" . $text;

# Aqui é como será renderizado o envio do ID da lead
$url .= "%20(Protocolo%20de%20Atendimento: " . utmPHP_cookie( 'utm_content' ) . ")";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Carregando Link</title>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $id_ga; ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', '<?php echo $id_ga; ?>');
	</script>
	<!-- End Google Analytics -->

	<!-- Tag -->
	<?php echo utmPHP_tagRefresh( $url ); ?>
</head>
<body>
	<p>Carregando...</p>
</body>
</html>
