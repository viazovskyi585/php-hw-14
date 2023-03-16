<?php
namespace Core\Interfaces;

interface ITableRenderer
{
	static function render(array $data): void;
}
