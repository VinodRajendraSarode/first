<div width="100%" style="background: #e8ebf0; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #333;">
	<div style="max-width: 700px; padding: 50px 0; margin: 0px auto; font-size: 14px">
		<div style="padding: 30px; background: #fff;">
			<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
				<tbody>
					<tr>
						<td>
							<h1 style="font-size: 20px;">Dear <?php echo $user->name ?>,</h1>
							<p><strong>Welcome to My Dominion 2.</strong><p>
							<p>You are receiving this email as you have used forget password option. Please click below to reset your password.</p>
							<p> <a href="<?php echo $reset_token_link; ?>" style="display: inline-block; padding: 10px 30px; font-size: 14px; color: #fff; background: #f44236; border-radius: 40px; text-decoration:none;">Reset Password</a></p>
							<p>For any support / query Email us to info@myedirectory.com or Call us on +91 93212 81973</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div> 