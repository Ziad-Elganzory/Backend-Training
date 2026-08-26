<?php

namespace App\Adapters;

use App\Clients\LocalSmsClient;
use App\Contracts\SmsSender;
use Override;

class LocalSmsAdapter implements SmsSender
{
	public function __construct(
		private LocalSmsClient $local,
		private string $senderId,
	) {}

    #[Override]
	public function send(string $to, string $message): string
	{
		$result = $this->local->sendSms($to, $message, $this->senderId);

		return $result['message_id'];
	}
}