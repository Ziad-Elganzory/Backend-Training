<?php

use App\Adapters\TwilioSmsAdapter;
use App\Clients\TwilioClient;

uses(Tests\TestCase::class);

it('returns the Twilio sid as message id',function(){
    $twilio = Mockery::mock(TwilioClient::class);
    $twilio->shouldReceive('messagesCreate')
        ->once()
        ->with('+201001234567',Mockery::on(fn($payload) => $payload['body'] == 'Hi' ))
        ->andReturn(['sid'=>'SM123']);
    
        $adapter = new TwilioSmsAdapter($twilio,'+10000000000');

        expect($adapter->send('+201001234567', 'Hi'))->toBe('SM123');
});
