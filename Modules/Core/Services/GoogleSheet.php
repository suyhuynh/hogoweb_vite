<?php
namespace Modules\Core\Services;

class GoogleSheet
{
	public static function insert($data, $sheet_id, $sheet_name) {
		try {
			$client = new \Google_Client();
			$client->setScopes(implode(' ', [\Google_Service_Sheets::SPREADSHEETS]));
			$client->setAuthConfig(env('GOOGLE_CLIENT_SECRET_PATH'));
			$service = new \Google_Service_Sheets($client);
			$options = array('valueInputOption' => 'RAW');
			$body = new \Google_Service_Sheets_ValueRange(['values' => [$data]]);
			$result = $service->spreadsheets_values->append($sheet_id, $sheet_name, $body, $options);
		} catch (\Exception $e) {

		}
	}
}