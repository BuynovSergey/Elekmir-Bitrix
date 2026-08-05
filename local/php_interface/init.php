<?php

CModule::AddAutoloadClasses(
    '', // не указываем имя модуля
    array(
        // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
        'HLBlock' => '/local/php_interface/includes/hlblock.php',
    )
);

$requests_keys = array_keys($_REQUEST);
foreach ($requests_keys as $request_key) {
    if (mb_ereg_match('PAGEN_', $request_key)) {
        global $APPLICATION;
        $APPLICATION->AddHeadString('<link href="https://'.$_SERVER['HTTP_HOST'].strtok($_SERVER['REQUEST_URI'], '?').'" rel="canonical" />',true);
        break;
    }
}

function getCurLang($upper = false) {
    $curLang =  Bitrix\Main\Application::getInstance()->getContext()->getLanguage();

    if ($upper) {
        return strtoupper($curLang);
    }

    return $curLang;
}

function getCurrentProtocol() {
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    return $protocol;
}

function cutByWords($maxlen, $text) {
    $len = (mb_strlen($text) > $maxlen)? mb_strripos(mb_substr($text, 0, $maxlen), ' ') : $maxlen;
    $cutStr = mb_substr($text, 0, $len);
    $temp = (mb_strlen($text) > $maxlen)? $cutStr. '...' : $cutStr;
    return $temp;
}

function siteURL($onlyDomain = false)
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];

    if ($onlyDomain) {
        return $domainName;
    }
    return $protocol.$domainName;
}

function setProtocol($link)
{
    $parsedLink = parse_url($link);
    if (empty($parsedLink['scheme'])) {
        return 'http://' . ltrim($link, '/');
    } else {
        return $link;
    }
}

function record_sort($records, $field, $reverse=false)
{
    $hash = array();

    foreach($records as $record)
    {
        $hash[$record[$field]] = $record;
    }

    ($reverse)? krsort($hash) : ksort($hash);

    $records = array();

    foreach($hash as $record)
    {
        $records []= $record;
    }

    return $records;
}


function getFormattedDateRange($dateFrom = '', $dateTo = '')
{
    if (!$dateFrom) {
        return '';
    }

    $months = Array(
        '01' => 'янв.',
        '02' => 'фев.',
        '03' => 'мар.',
        '04' => 'апр.',
        '05' => 'май.',
        '06' => 'июн.',
        '07' => 'июл.',
        '08' => 'авг.',
        '09' => 'сен.',
        '10' => 'окт.',
        '11' => 'ноя.',
        '12' => 'дек.',
    );

    $dateFromArr = explode('.', $dateFrom);

    if ($dateTo) {
        $dateToArr = explode('.', $dateTo);

        if ($dateFromArr[2] === $dateToArr[2]) {

            if ($dateFromArr[1] === $dateToArr[1]) {
                if ($dateFromArr[0] === $dateToArr[0]) {
                    return $dateFromArr[0] . ' ' . $months[$dateFromArr[1]] . ' ' . $dateFromArr[2];
                }

                return $dateFromArr[0] . '—' . $dateToArr[0] . ' ' . $months[$dateFromArr[1]] . ' ' . $dateFromArr[2];
            }

            return $dateFromArr[0] . ' ' . $months[$dateFromArr[1]] . ' — ' .
                $dateToArr[0] . ' ' . $months[$dateToArr[1]] . ' ' . $dateFromArr[2];

        }

        return $dateFromArr[0] . ' ' . $months[$dateFromArr[1]] . ' ' . $dateFromArr[2] . ' — ' .
            $dateToArr[0] . ' ' . $months[$dateToArr[1]] . ' ' . $dateToArr[2];
    }

    return $dateFromArr[0] . ' ' . $months[$dateFromArr[1]] . ' ' . $dateFromArr[2];
}

function getFormattedDate($date) {
    $months = Array(
        1 => 'янв',
        2 => 'фев',
        3 => 'мар',
        4 => 'апр',
        5 => 'мая',
        6 => 'июн',
        7 => 'июл',
        8 => 'авг',
        9 => 'сент',
        10 => 'окт',
        11 => 'ноя',
        12 => 'дек',
    );

    $exploded = explode('.', $date);

    return intval($exploded[0]) . ' ' . $months[intval($exploded[1])] . ' ' . intval($exploded[2]);
}

function getFormattedDateWithoutYear ($date) {
    $months = Array(
        1 => 'янв',
        2 => 'фев',
        3 => 'мар',
        4 => 'апр',
        5 => 'мая',
        6 => 'июн',
        7 => 'июл',
        8 => 'авг',
        9 => 'сент',
        10 => 'окт',
        11 => 'ноя',
        12 => 'дек',
    );
    $exploded = explode('.', $date);
    return intval($exploded[0]) . ' ' . $months[intval($exploded[1])];
}

function getIblockElements($iblockId, $props = Array(), $filter = Array())
{
    if (CModule::IncludeModule("iblock")) {
        $result = Array();

        $arSelect = array_merge(Array("ID", "NAME"), $props);
        $arFilter = Array("IBLOCK_ID" => $iblockId, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $arFilter = array_merge($arFilter, $filter);
        $res = CIBlockElement::GetList(Array("PROPERTY_DATE" => "DESC"), $arFilter, false, Array("nPageSize" => 1000), $arSelect);

        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $result[] = $arFields;
        }

        return $result;
    }
}

function getIblockExtremum($iblockId, $propName, $sectionId)
{
    $values = Array();

    $arSelect = Array("ID", "IBLOCK_SECTION_ID", "NAME", "PROPERTY_" . $propName);
    $arFilter = Array("IBLOCK_ID" => $iblockId, "IBLOCK_SECTION_ID" => $sectionId, "ACTIVE" => "Y");

    $res = CIBlockElement::GetList(Array("PROPERTY_" . $propName => "DESC"), $arFilter, false, Array("nPageSize" => 1000), $arSelect);

    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $values[] = $arFields["PROPERTY_" . $propName . "_VALUE"];
    }

    return Array("MIN" => min($values), "MAX" => max($values));
}

function getSectionList($filter, $select)
{
    if (CModule::IncludeModule("iblock")) {
        $dbSection = CIBlockSection::GetList(
            Array(
                'LEFT_MARGIN' => 'ASC',
            ),
            array_merge(
                Array(
                    'ACTIVE' => 'Y',
                    'GLOBAL_ACTIVE' => 'Y'
                ),
                is_array($filter) ? $filter : Array()
            ),
            false,
            array_merge(
                Array(
                    'ID',
                    'IBLOCK_SECTION_ID'
                ),
                is_array($select) ? $select : Array()
            )
        );

        while ($arSection = $dbSection->GetNext(true, false)) {

            $SID = $arSection['ID'];
            $PSID = (int)$arSection['IBLOCK_SECTION_ID'];

            $arLincs[$PSID]['CHILDS'][$SID] = $arSection;

            $arLincs[$SID] = &$arLincs[$PSID]['CHILDS'][$SID];
        }

        return array_shift($arLincs);
    }
}

function string_sanitize($s)
{
    $result = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($s, ENT_QUOTES));
    return $result;
}

function rus2translit($string)
{
    $converter = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

        'А' => 'A', 'Б' => 'B', 'В' => 'V',
        'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'Y', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
        'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        ' ' => '-',
    );
    return strtr($string, $converter);
}

function str2url($str)
{
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}

function getPropsFromElements($itemsId, $iblockId, $propName)
{
    $result = Array();
    $arSelect = Array("ID", "NAME", $propName);
    $arFilter = Array("ID" => $itemsId, "IBLOCK_ID" => $iblockId, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");

    $res = CIBlockElement::GetList(Array("PROPERTY_DATE" => "DESC"), $arFilter, false, Array("nPageSize" => 50), $arSelect);

    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $result[] = $arFields[$propName . "_VALUE"];
    }

    return array_unique($result);
}

if (!function_exists('mb_ucfirst') && function_exists('mb_substr')) {
    function mb_ucfirst($string)
    {
        $string = mb_ereg_replace("^[\ ]+", "", $string);
        $string = mb_strtoupper(mb_substr($string, 0, 1, "UTF-8"), "UTF-8") . mb_substr($string, 1, mb_strlen($string), "UTF-8");
        return $string;
    }
}

function getCorrectWord($n, $titles)
{
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
}

function pr($array)
{
    global $USER;

    if ($USER->isAdmin()) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    return false;
}

function getDescriptionForMeta($text)
{
    $description = trim(strip_tags(str_replace(array("\r", "\n"), '',htmlspecialcharsBack(htmlspecialchars_decode($text)))));
    $posLastNbsp = mb_strrpos(mb_substr($description,0,200), ' ');
    return mb_substr($description,0,$posLastNbsp);
}

function mb_strtoupper_first($str, $encoding = 'UTF8') {
    return
        mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) .
        mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
}