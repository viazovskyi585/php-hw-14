<?php
namespace Core;
use Core\Interfaces\ITableRenderer;

class TableRenderer implements ITableRenderer
{
	static function render(array $data): void
	{
		$table = '<table class="table">';
		$table .= '<thead>';
		$table .= '<tr>';
		foreach ($data[0] as $key => $value) {
			$table .= '<th>' . $key . '</th>';
		}
		$table .= '</tr>';
		$table .= '</thead>';
		$table .= '<tbody>';
		foreach ($data as $row) {
			$table .= '<tr>';
			foreach ($row as $key => $value) {
				$table .= '<td>' . $value . '</td>';
			}
			$table .= '</tr>';
		}
		$table .= '</tbody>';
		$table .= '</table>';
		Renderer::renderHTML('Table', $table);
	}
}
