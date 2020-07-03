<?php
/**
* UTM PHP - Example
*
* Exemplo e instruções de uso
*/

include '../utm-php.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Exemplo implementado em site</title>
	<style type="text/css">
		body {
			margin: 0;
			padding: 2em;
			background-color: #eee;
			font-family: Helvetica, sans-serif;
		}
		section {
			margin: .5em 0;
			padding: .5rem 1rem;
			font-size: 1.2em;
			background-color: #fff;
		}
		header, footer {
			margin: 2em 0;
			padding: .5rem 1rem;
		}
		.cta {
			padding: .7rem;
			font-size: 1.3em;
			background-color: green;
			color: #fff;
			text-decoration: none;
		}
	</style>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-00000000-0"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-00000000-0');
	</script>
	<!-- End Google Analytics -->

</head>
<body>

	<header>
		<h1>Este é o site de exemplo</h1>
		<p>Ao clicar no link a seguir, vai enviar um texto padrão com o ID do usuário, este ID será rastreado no parâmetro "utm_content" e pode ser visualizado no Google Analytics (GA)</p>
	</header>

	<section>
		<h4>Workflow para campanhas:</h4>
		<ul>
			<li>O LEAD clica na campanha</li>
			<li>O LEAD navega pelo site com as UTMs dentro do cookie</li>
			<li>Ao clicar no CTA rastreado, ele será redirecionado e este clique será salvo no GA</li>
			<li>Quando o LEAD fechar a venda, os vendedores poderão saber a origem dessa venda através do ID, dentro do GA</li>
		</ul>
	</section>

	<section>
		<h4>Workflow para vendedores:</h4>
		<ul>
			<li>O LEAD clica na link enviado pelo(a) vendedor(a) (site.com/link-whatsapp?utm_source=NOMEDOVENDEDOR)</li>
			<li>O LEAD navega pelo site com as UTMs dentro do cookie</li>
			<li>Ao clicar no CTA rastreado, ele será redirecionado e este clique será salvo no GA</li>
			<li>Quando o LEAD fechar a venda, os vendedores poderão saber a origem dessa venda através do ID, dentro do GA</li>
		</ul>
	</section>

	<section>
		<h4>Para visualizar os dados de campanhas:</h4>
		<p>Faça login no Google Analytics. Abra a Propriedade do seu site. Em seguida, clique em: "Aquisição" > "Campanhas" > "Todas as Campanhas". Na tela que irá aparecer, selecione o filtro "Dimensão principal: Origem/mídia". A partir dessa tela, você pode visualizar os dados das campanhas.</p>
	</section>

	<section>
		<h4>Para visualizar os dados de usuários que clicaram na página destino:</h4>
		<p>Faça login no Google Analytics. Abra a Propriedade do seu site. Em seguida, clique em: "Aquisição" > "Campanhas" > "Todas as Campanhas". Na tela que irá aparecer, selecione o filtro "Dimensão principal: Outros", no box que irá aparecer, clique em "Aquisição" > "Conteúdo do Anúncio". A partir dessa tela, você poderá visualizar os usuários que chegaram na tela final, e com isso, comparar com os IDs que fecharam a venda.</p>
	</section>

	<section>
		<h4>Observações:</h4>
		<p>O id contido "utm_content" serve para rastrear uma lead através da página destino.</p>
		<p>É de extrema importancia que o "utm_content" seja registrado na URL de destino <br> 
			<i>Exemplo de URL de destino: link para conversas externas, como o WhatsApp API.</i></p>
	</section>

	<br>

	<a class="cta" href="<?php echo utmPHP_link( 'whatsapp' ) ?>" target="_blank">Chega de texto, vamos ver esse link sendo rastreado e redirecionado para o WhatsApp</a>

	<br>

	<footer>
		Desenvolvido por Gabriel Masson | Projeto sob licença MIT | <a href="https://github.com/gmasson/utm-php" target="_blank">https://github.com/gmasson/utm-php</a>
	</footer>

</body>
</html>