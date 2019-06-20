<?php
function osAddPush($oneSignalConfig)
{
    if (sizeof($oneSignalConfig)) {
        $notifTitle = html_entity_decode($oneSignalConfig['title'], ENT_QUOTES, 'UTF-8');
        $notifContent = html_entity_decode($oneSignalConfig['brief'], ENT_QUOTES, 'UTF-8');

        $includedSegments = array('All');

        $fields = array(
            'app_id' => $oneSignalConfig['app_id'],
            'headings' => array("en" => $notifTitle),
            'included_segments' => $includedSegments,
            'isAnyWeb' => true,
            'url' => $oneSignalConfig['url'],
            'contents' => array("en" => $notifContent)
        );

        $thumbnailUrl = $oneSignalConfig['image_url'];

        if (!empty($thumbnailUrl)) {
            $fields['chrome_web_image'] = $thumbnailUrl;
        }

        $logoUrl = $oneSignalConfig['logo_url'];

        if (!empty($logoUrl)) {
            $fields['chrome_web_icon'] = $logoUrl;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ' . $oneSignalConfig['app_rest_api_key']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    return null;
} // EO_Fn
