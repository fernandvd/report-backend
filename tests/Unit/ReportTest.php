<?php


use App\Models\User;
use App\Models\Report;
use Illuminate\Testing\Fluent\AssertableJson;

test('the application return list of all reports', function () {
    $dataUser = [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ];
    $user = User::factory()->create($dataUser);

    $response = $this->actingAs($user)->get(route('reports.index'),);

    $response->assertStatus(200);
});

test('the application return create a report', function () {
    $dataUser = [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ];
    $user = User::factory()->create($dataUser);

    $response = $this->actingAs($user)->post(route('reports.store'),);

    $response->assertStatus(201);
});

test('the application return one report', function () {
    $dataUser = [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ];
    $user = User::factory()->create($dataUser);
    $report = Report::create([
        'user_id' => $user->id,
        'title' => 'demo-report',
        'report_link' => 'https://google.com',
    ]);
    $this->assertDatabaseCount('reports', 1);

    $response = $this->actingAs($user)->get(route('reports.show', $report->id),);

    $response->assertStatus(200);
});


test('the application delete report', function () {
    $dataUser = [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ];
    $user = User::factory()->create($dataUser);
    $report = Report::create([
        'user_id' => $user->id,
        'title' => 'demo-report',
        'report_link' => 'https://google.com',
    ]);
    $this->assertDatabaseCount('reports', 1);

    $response = $this->actingAs($user)->delete(route('reports.destroy', $report->id),);

    $response->assertStatus(204);
    $this->assertDatabaseCount('reports', 0);
});
