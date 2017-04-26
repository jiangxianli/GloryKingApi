<?php
namespace GloryKing\Handler;

use Illuminate\Pagination\AbstractPaginator;
use Library\ErrorMessage\ErrorMessage;

/**
 * 处理器基础类
 *
 * Class Handler
 * @package GloryKing\Handler
 * @author jiangxianli
 * @created_at 2017-04-20 15:32:38
 */
class Handler
{
    /**
     * Api接口输出
     *
     * @param array $response
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-20 17:53:25
     */
    public static function apiResponse($response = [])
    {
        if (ErrorMessage::isError($response)) {
            return $response->formatError();
        }

        $data = $response;
        if ($response && $response instanceof AbstractPaginator) {
            $data = [
                'total'        => $response->total(),
                'current_page' => $response->currentPage(),
                'per_page'     => $response->perPage(),
                'last_page'    => $response->lastPage(),
                'rows'         => $response->items()
            ];
        }

        return [
            'code' => 0,
            'data' => $data,
            'msg'  => ''
        ];
    }

    /**
     * 分页数据转成数组格式
     *
     * @param $items
     * @param $collection
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-24 17:57:05
     */
    public static function pageData2Array($items, $collection)
    {
        return [
            'total'        => $collection->total(),
            'current_page' => $collection->currentPage(),
            'per_page'     => $collection->perPage(),
            'last_page'    => $collection->lastPage(),
            'rows'         => $items
        ];
    }
}
