<div width="100%" style="background: #e8ebf0; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #333;">
	<div style="max-width: 700px; padding: 50px 0; margin: 0px auto; font-size: 14px">
		<div style="padding: 30px; background: #fff;">
			<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
				<tbody>
					<tr>
						<td>
							<h1 style="font-size: 20px;">Dear <?php echo $receiver ?>,</h1>
							<p><strong>New Message.</strong><p>
							<p>From : <?= $message->from_date ?> - To : <?= $message->to_date ?></p>
							<p><?= $message->message ?></p>
                            <p>Send by. <br> &emsp;<strong> <?= $sender->name ?> <br> </p>
                            <p> Reply To:- &nbsp;<strong> <?= $sender->email ?> </strong></p>
			
							<p>For any support / query Email us to abc@abc.com or Call us on +91 000000000</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>