<?php
$jsonUrl = 'https://cdn.renesebastian.com/data/trackrecord.json';
$jsonData = file_get_contents($jsonUrl);
$data = json_decode($jsonData, true);
function displayRecords($type, $records) {    
    $foundRecords = false;

    foreach ($records as $record) {
        if ($record['type'] == $type) {
            if (!$foundRecords) {
                echo "<ul>\n";
                $foundRecords = true;
            }

            echo "<li>\n";
            echo "    <script type=\"application/ld+json\">{";
            echo "\"@context\":\"https://schema.org\",\"@type\":\"CreativeWork\",\"name\":\"{$record['name']}\"";

            if (!empty($record['years'])) {
                echo ",\"dateCreated\":[";
                $yearCount = count($record['years']);
                foreach ($record['years'] as $index => $yearData) {
                    if (!empty($yearData['year'])) {
                        echo "\"{$yearData['year']}\"";
                        if ($index < $yearCount - 1) {
                            echo ",";
                        }
                    }
                }
                echo "]";
            }

            if (!empty($record['commissionedBy'])) {
                echo ",\"producer\":[\"{$record['commissionedBy']}\"]";
            }

            if (!empty($record['functionsEN'])) {
                $roles = [];

                foreach ($record['functionsEN'] as $function) {
                    if ($function === 'editor') {
                        $roles[] = "Editor";
                    } else {
                        $roles[] = $function;
                    }
                }

                if (!empty($roles)) {
                    echo ",\"contributor\":[{\"@type\":\"Person\",\"name\":\"Rene Sebastian\",\"role\":";
                    echo json_encode($roles);
                    echo "}]";
                }
            }

            echo "}</script>\n";
            echo "    <dl>\n";
            echo "        <dt>";
            echo "{$record['name']}";
            
            if (!empty($record['years'])) {
                $yearLinks = [];
                foreach ($record['years'] as $yearData) {
                    if (!empty($yearData['year'])) {
                        if (!empty($yearData['link'])) {
                            $yearLinks[] = "<a href=\"{$yearData['link']}\">{$yearData['year']}</a>";
                        } else {
                            $yearLinks[] = "{$yearData['year']}";
                        }
                    }
                }
                echo " <span>" . implode(" - ", $yearLinks) . "</span>";
            }

            echo "</dt>\n";

            if (!empty($record['functionsEN'])) {
                foreach ($record['functionsEN'] as $function) {
                    echo "        <dd>{$function}</dd>\n";
                }
            }
            
            if (!empty($record['commissionedBy'])) {
                echo "        <dd class=\"misc\">Commissioned by: {$record['commissionedBy']}</dd>\n";
            }
            
            echo "    </dl>\n";
            echo "</li>\n";
        }
    }

    if ($foundRecords) {
        echo "</ul>\n";
    }
}
$allRecords = $data['trackrecord']['record'];
?>