<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

pest()->use(RefreshDatabase::class);

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('basic check', function () {
    $response = $this->postJson('/check/', [
        'odometer_current' => '0',
        'odometer_previous' => '0',
        'date_previous' => '2000-01-01',
    ]);

    $this->assertDatabaseHas('cars', [
        'odometer_current' => 0,
        'odometer_previous' => 0,
        'date_previous' => '2000-01-01 00:00:00',
    ]);

    $this->assertDatabaseCount('cars', 1);
});

test('odometers cant be negative', function () {
    $response = $this->postJson('/check/', [
        'odometer_current' => '-1',
        'odometer_previous' => '-1',
        'date_previous' => '2000-01-01',
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('can use a past date', function () {
    $this->travel(-1)->days();
    $date = now();
    $this->travel(1)->days();

    $response = $this->postJson('/check/', [
        'odometer_current' => '1',
        'odometer_previous' => '1',
        'date_previous' => $date,
    ]);

    $this->assertDatabaseCount('cars', 1);
});

test('cant use a future date', function () {
    $this->travel(1)->days();
    $date = now();
    $this->travel(-1)->days();

    $response = $this->postJson('/check/', [
        'odometer_current' => '1',
        'odometer_previous' => '1',
        'date_previous' => $date,
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('current cant be smaller than previous', function () {
    $this->travel(-1)->days();
    $date = now();
    $this->travel(1)->days();

    $response = $this->postJson('/check/', [
        'odometer_current' => '1',
        'odometer_previous' => '2',
        'date_previous' => $date,
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('current odometer is required', function () {
    $this->travel(-1)->days();
    $date = now();
    $this->travel(1)->days();

    $response = $this->postJson('/check/', [
        'odometer_previous' => '2',
        'date_previous' => $date,
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('previous odometer is required', function () {
    $this->travel(-1)->days();
    $date = now();
    $this->travel(1)->days();

    $response = $this->postJson('/check/', [
        'odometer_current' => '2',
        'date_previous' => $date,
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('date is required', function () {

    $response = $this->postJson('/check/', [
        'odometer_current' => '2',
        'odometer_previous' => '1',
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('date must be valid', function () {

    $response = $this->postJson('/check/', [
        'odometer_current' => '2',
        'odometer_previous' => '1',
        'date' => 'h',
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('current odometer must be valid', function () {

    $response = $this->postJson('/check/', [
        'odometer_current' => 'h',
        'odometer_previous' => '1',
        'date' => '2000-01-01',
    ]);

    $this->assertDatabaseCount('cars', 0);
});

test('previous odometer must be valid', function () {

    $response = $this->postJson('/check/', [
        'odometer_current' => '2',
        'odometer_previous' => 'h',
        'date' => '2000-01-01',
    ]);

    $this->assertDatabaseCount('cars', 0);
});

// todo: test the oil change criteria?
