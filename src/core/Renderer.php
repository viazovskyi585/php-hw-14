<?php
namespace Core;

class Renderer
{
	private static function renderLayout(string $pageTitle, $pageContent): void
	{
		include __DIR__ . '/../public/views/layout.php';
	}

	private static function renderView(string $viewName, array $pageData = []): string
	{
		extract($pageData);
		ob_start();
		include __DIR__ . '/../public/views/' . $viewName . '.php';
		return ob_get_clean();
	}
	public static function render(string $viewName, string $title, array $data = []): void
	{
		$pageTitle = $title ?? 'Title';
		$pageContent = self::renderView($viewName, $data);
		self::renderLayout($pageTitle, $pageContent);
	}
}
