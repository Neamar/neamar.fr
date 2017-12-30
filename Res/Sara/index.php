<html>
<head>
	<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery.min.js"></script>

	<script>
	function sendMails()
	{
		var subject = $('#subject').val();
		var from = $('#from').val();
		var to = $('#to').val();
		var message = $('#message').val();
		var number = parseInt($('#number').val());

		if(number > 500 || number < 1 || isNaN(number))
			alert("Number of repetitions must be between 1 and 500.");
		else
		{
			$('#send').hide();

			sendMail(from, to, subject, message, number, true);
		}
	}

	function sendMail(from, to, subject, message, number, use_log)
	{
		$.post(
			'app.php',
			{
				from: from,
				to: to,
				subject: subject,
				message: message,
				use_log: use_log
			},
			function(data) {
				if(data != "OK")
					alert("Sending failed; you sent more than max limit or specified invalid values.");
				else
				{
					$('#progress').html("Left to be sent: <strong>" + number + "</strong>");
					number--;
					if(number > 0)
						sendMail(from, to, subject, message, number, false);
					else
						$('#progress').html("<strong>All mails sent</strong>.");
				}
			}
		);
	}
	</script>
</head>
<body>
<div class="container well">
	<h1 style="text-align:center">Bulk and spoof</h1>

	<form method="post" name="mail_datas">
	<p>
	<label for="subject">Subject :</label>
	<input type="text" name="subject" id="subject" /><br />

	<label for="from">Sender mail :</label>
	<input type="mail" name="from" id="from" /><br />

	<label for="to">Recipient :</label>
	<input type="mail" name="to" id="to" /><br /></p>

	<label for="message">Message :</label><br />
	<textarea id="message" name="message" rows="6" cols="50"></textarea><br />

	<p><label for="number">Repetition :</label>
	<input type="number" name="number" id="number" min="1" max="500" value="5" /></p>

	<input type="button" value="Send mail" onclick="sendMails()" id="send">
	<p id="progress"></p>
</div>

</body>