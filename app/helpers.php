<?php



if(!function_exists('getDayVariant')) {
    /**
     * @param $number
     * @return mixed|string
     */
    function getDayVariant($number)
    {
        $variants = array(' день', ' дня', ' дней');
        if (empty($number) || empty($variants)) {
            return '';
        }
        if (!is_array($variants)) {
            $variants = array();
        }
        while (count($variants) < 3) {
            end($variants);
            $variants[] = current($variants);
        }
        $cases = array(2, 0, 1, 1, 1, 2);
        $index = ($number % 100 > 4 && $number % 100 < 20)
            ? 2
            : $cases[min($number % 10, 5)];
        return $variants[$index];

    }
}
if(!function_exists('prepareUrlForUse')) {
    function prepareUrlForUse($url, $withScheme = false)
    {
        $domain = '';
        $arUrlParts = parse_url($url);
        if(isset($arUrlParts['host'])) {
            $domain = str_replace('www.', '', $arUrlParts['host']);
            if (count(explode('.', $domain)) == 3)
                $domain = preg_replace('/(.*)\./U', '', $domain, 1);
            if ($withScheme)
                $domain = $arUrlParts['scheme'] . '://' . $domain;
        }
        $domain = rtrim($domain, '/');
        return $domain;


    }
}

