<?php
use Obadaalzidi\TapPhpSdk\Api\BaseApi;
use Obadaalzidi\TapPhpSdk\Responses\BaseResponse;
use GuzzleHttp\Psr7\Response;

class FakeApi extends BaseApi {}

it('creates, retrieves, updates, lists and downloads', function () {
    $http = makeHttpClient([
        new Response(200, [], json_encode(['id' => 'obj_1', 'status' => 'ok', 'amount' => 100, 'currency' => 'KWD'])),
        new Response(200, [], json_encode(['id' => 'obj_1', 'status' => 'ok', 'amount' => 100, 'currency' => 'KWD'])),
        new Response(200, [], json_encode(['id' => 'obj_1', 'status' => 'updated', 'amount' => 150, 'currency' => 'KWD'])),
        new Response(200, [], json_encode(['data' => [['id' => 'obj_1', 'status' => 'ok', 'amount' => 100, 'currency' => 'KWD']]])),
        new Response(200, [], json_encode(['file' => 'binary-data'])),
    ]);

    $api = new FakeApi($http, 'fake', BaseResponse::class);

    $created = $api->create(['amount' => 100]);
    expect($created)->toBeInstanceOf(BaseResponse::class);

    $retrieved = $api->retrieve('obj_1');
    expect($retrieved->id())->toBe('obj_1');

    $updated = $api->update('obj_1', ['amount' => 150]);
    expect($updated->status())->toBe('updated');

    $list = $api->list();
    expect($list)->toHaveCount(1);

    $download = $api->download();
    expect($download)->toHaveKey('file');
});
