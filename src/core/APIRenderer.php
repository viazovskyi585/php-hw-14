<?php
namespace Core;

class APIRenderer
{
	public static function renderList(array $data): void
	{
		self::render([
			'total' => $data['total'],
			'filtered' => count($data['list']),
			'data' => $data['list']
		]);
	}

	private static function render($data): void
	{
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
