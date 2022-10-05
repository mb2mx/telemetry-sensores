<?php
class BaseController
{
    
    /**
     * Get URI elements.
     * 
     * @return array
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
 
        return $uri;
    }
 
    /**
     * Get querystring params.
     * 
     * @return array
     */
    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }
 
    /**
     * Send API output.
     *
     * @param mixed  $data
     * @param string $httpHeader
     */
    protected function sendOutput($data, $httpHeaders=array())
    {
 
        echo $data;
        exit;
    }

    protected function test($array){

        $new = array_filter($array, function ($var) {
            return ($var['created_date']);
        });
        return $new;
    }
    protected function filterByField($rows, ...$keys)
    {
        $groups =$this->groupBy($rows,...$keys);
         return   $groups;
    }
    
    public function groupBy($rows, ...$keys)
    {
        if ($key = array_shift($keys)) {
            $groups = array_reduce($rows, function ($groups, $row) use ($key) {
                $group = is_object($row) ? $row->{$key} : $row[$key]; // object is available too.
                $groups[$group][] = $row;
                return $groups;
            }, []);
            if ($keys) {
                foreach ($groups as $subKey=>$subRows) {
                    $groups[$subKey] = self::groupBy($subRows, ...$keys);
                }
            }
        }
        return $groups;
    }

}