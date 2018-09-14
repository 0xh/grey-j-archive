<?php
require dirname(__DIR__).'/vendor/autoload.php';

if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 * @source https://developers.google.com/sheets/api/quickstart/php
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');

    // Load previously authorized credentials from a file.
    $credentialsPath = 'token.json';
    if (file_exists($credentialsPath)) {
        $accessToken = json_decode(file_get_contents($credentialsPath), true);
    } else {
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        printf("Open the following link in your browser:\n%s\n", $authUrl);
        print 'Enter verification code: ';
        $authCode = trim(fgets(STDIN));

        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        // Check to see if there was an error.
        if (array_key_exists('error', $accessToken)) {
            throw new Exception(join(', ', $accessToken));
        }

        // Store the credentials to disk.
        if (!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0700, true);
        }
        file_put_contents($credentialsPath, json_encode($accessToken));
        printf("Credentials saved to %s\n", $credentialsPath);
    }
    $client->setAccessToken($accessToken);

    // Refresh the token if it's expired.
    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

function title_to_model_name($title) {
    static $specific_mappings = [
        'Classes' => 'Class', // I tried doing some es plural handling, but it was false-positiving on Talent Trees.
    ];
    if (isset($specific_mappings[$title])) return $specific_mappings[$title];
    $model_name = preg_replace('/ |s$/', '', $title);
    return $model_name;
}

function col_index_to_col_letter($i) {
    // For spreadsheets with more than 26 columns, this would need to be rewritten, but that's not the case for my source right now.
    return chr(ord('A') + $i);
}

// Do we have a spreadsheet id?
$spreadsheetId = @file_get_contents('google_data.spreadsheet_id');
if (!$spreadsheetId) throw new RuntimeException('Missing or invalid spreadsheet id in google_data.spreadsheet_id file.');

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);

// Load the spreadsheet
$workbook = $service->spreadsheets->get($spreadsheetId);
$sheets = $workbook->getSheets();

// Create output file
$tmpfile = tempnam(__DIR__, 'google_data.');
echo $tmpfile.PHP_EOL;
$outfile = fopen($tmpfile, 'w');

// Open the JSON object
$first_sheet = true;
fwrite($outfile, '{'.PHP_EOL);

foreach ($sheets as $sheet) {
    $sheet_properties = $sheet->getProperties();
    
    // Get model name for out file
    $title = $sheet_properties->getTitle();
    $model = title_to_model_name($title);
    $first_row = true;

    // Get the headers for this sheet
    $range = $title.'!1:1';
    $headers = array_map(
        function($v) { return str_replace(' ', '_', strtolower($v)); },
        $service->spreadsheets_values->get($spreadsheetId, $range)[0]
    );

    // Get the data for this sheet
    $range = $title.'!A2:'.col_index_to_col_letter(count($headers));
    $rows = $service->spreadsheets_values->get($spreadsheetId, $range);
    foreach ($rows as $row) {
        fwrite(
            $outfile,
            $first_row ?
                ($first_sheet ? '' : ',').PHP_EOL."\t".json_encode($model).':['
                : ','
        );
        $first_sheet = $first_row = false;
        $data_row = [];
        foreach ($headers as $header) {
            $data_row[$header] = array_shift($row);
        }
        fwrite($outfile, PHP_EOL."\t\t".json_encode($data_row));
    }
    fwrite($outfile, PHP_EOL."\t".']');
}

// Close the JSON object
fwrite($outfile, PHP_EOL.'}');

// Clear the old output file, if any, and copy the temp file to it.
if (file_exists('google_data.json')) unlink('google_data.json');
fclose($outfile);
copy($tmpfile, 'google_data.json');
unlink($tmpfile);

echo PHP_EOL.'google_data.json '.filesize('google_data.json').PHP_EOL;
