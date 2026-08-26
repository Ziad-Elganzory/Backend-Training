<?php

it('sends an sms through the api', function () {
	$this->postJson('/api/sms/send', [
		'to' => '+201001234567',
		'message' => 'Your order shipped',
	])->assertSuccessful()
		->assertJsonStructure(['message_id', 'status']);
});