<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Return Policy - TAMOLA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Main.css" rel="stylesheet">
</head>
<?php
include('header.php');
?>
<body>
	<h1>Return Policy</h1>
	<p>At TAMOLA, we stand behind the quality of our products and are committed to providing you with complete satisfaction. If for any reason you are not satisfied with your purchase, you may return it for a refund or exchange within 30 days of the original purchase date.</p>
	<h2>Conditions for Returns and Exchanges</h2>
	<p>To be eligible for a return or exchange, the following conditions must be met:</p>
	<ul>
		<li>The product must be in its original packaging and in the same condition as when it was received</li>
		<li>A proof of purchase, such as a receipt or order confirmation, must be provided</li>
		<li>The product must not have been opened or used</li>
		<li>Return shipping costs are the responsibility of the customer, unless the product was received damaged or defective</li>
	</ul>
	<h2>Refunds and Exchanges</h2>
	<p>Refunds will be processed within 14 business days of receiving the returned product. Refunds will be issued in the same form as the original payment. If you would like to exchange your product for another item, please contact us at returns@tamola.com to initiate the exchange process.</p>
	<h2>Contact Us</h2>
	<p>If you have any questions or concerns about our Return Policy, please contact us at returns@tamola.com.</p>
</body>
<?php
include('footer.php');
?>
</html>