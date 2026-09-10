<?php

test('it greets user',function(){
    $response = $this->get('/api/v1/welcome?name=Ziad');
    $response->assertStatus(200)
        ->assertJson(["message" => "Hello, Ziad"]); 
});

test('it greets guest',function(){
    $response = $this->get('/api/v1/welcome');
    $response->assertStatus(200)
        ->assertJson(["message" => "Hello, Guest"]); 
});