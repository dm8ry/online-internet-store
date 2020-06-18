<HTML>
<HEAD>
<TITLE>Test Payment to the PayPal</TITLE>
</HEAD>
<BODY>

<h2>Test Payment to the PayPal</h2>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input TYPE="hidden" name="charset" value="utf-8">
<input type="hidden" name="business" value="dmitrir2006-facilitator@gmail.com">
<input type="hidden" name="currency_code" value="ILS">

<input type="hidden" name="item_number_1" value="Itm #1">
<input type="hidden" name="item_name_1" value="Кольцо Золотое">
<input type="hidden" name="quantity_1" value="2">
<input type="hidden" name="amount_1" value="1.00">

<input type="hidden" name="item_number_2" value="Itm #2">
<input type="hidden" name="item_name_2" value="Кольцо Серебряное">
<input type="hidden" name="quantity_2" value="6">
<input type="hidden" name="amount_2" value="2.00">

<input type="hidden" name="address_override" value="1">

<input type="hidden" name="first_name" value="Джонни">
<input type="hidden" name="last_name" value="Депп">
<input type="hidden" name="address1" value="345 Lark Ave">
<input type="hidden" name="city" value="Тель-Авив">
<input type="hidden" name="state" value="N/A">
<input type="hidden" name="zip" value="127000">
<input type="hidden" name="country" value="Russia">
<input type="submit" value="PayPal">

<input type="hidden" name="return" value="https://crystalsky.co.il/success_order.php">
<input type="hidden" name="cancel_return" value="https://crystalsky.co.il/cancel_order.php">

</form>

</BODY>
</HTML>