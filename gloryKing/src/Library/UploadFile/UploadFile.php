<?php
namespace Library\UploadFile;

use Library\ErrorMessage\ErrorMessage;

/**
 * 文件上传
 *
 * Class UploadFile
 * @package Library\UploadFile
 * @author jiangxianli
 * @created_at 2017-04-20 16:47:27
 */
class UploadFile
{
    /**
     * 文件实体
     *
     * @var
     */
    private $file;

    /**
     * 允许上传的后缀格式
     *
     * @var array
     */
    private $allow_extension = [];

    /**
     * 最大允许上传的大小限制
     *
     * @var int
     */
    private $max_size = 1024;

    /**
     * 上传目录
     *
     * @var string
     */
    private $upload_dir = '';

    /**
     * 保存的文件后缀
     *
     * @var string
     */
    private $file_extension = '';

    /**
     * 保存的文件大小
     *
     * @var int
     */
    private $file_size = 0;

    /**
     * 保存的文件访问路径
     *
     * @var string
     */
    private $file_url = '';

    /**
     * 保存的文件物理路径
     *
     * @var string
     */
    private $file_path = '';

    /**
     * 保存的文件的名称
     *
     * @var string
     */
    private $file_name = '';

    /**
     * 获取保存的文件访问路径
     *
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-20 16:51:10
     */
    public function getFileUrl()
    {
        return $this->file_url;
    }

    /**
     * 获取保存的文件物理路径
     *
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-20 16:51:28
     */
    public function getFilePath()
    {
        return $this->file_url;
    }

    /**
     * 获取保存的文件大小
     *
     * @return int
     * @author jiangxianli
     * @created_at 2017-04-20 16:51:42
     */
    public function getFileSize()
    {
        return $this->file_size;
    }

    /**
     * 获取保存的文件名称
     *
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-20 16:51:59
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * 获取保存的文件的后缀
     *
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-20 16:52:12
     */
    public function getFileExtension()
    {
        return $this->file_extension;
    }

    /**
     * 构造函数
     *
     * UploadFile constructor.
     * @param array $all_extension
     * @param int $max_size
     * @author jiangxianli
     * @created_at 2017-04-20 16:52:12
     */
    public function __construct($all_extension = ['jpg', 'png'], $max_size = 1024)
    {
        $this->allow_extension = array_map(function ($val) {
            return strtolower($val);
        }, $all_extension);
        $this->max_size        = $max_size;
    }

    /**
     * 上传文件
     *
     * @param $file
     * @param $upload_dir
     * @return ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-20 16:52:57
     */
    public function upload($file, $upload_dir)
    {
        //检查文件是否合法
        if (!$file->isValid()) {
            return new ErrorMessage(2000);
        }

        //文件后缀检测
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, $this->allow_extension)) {
            $error   = new ErrorMessage(2001);
            $message = '只能是' . implode(',', $this->allow_extension) . '后缀的文件!';
            $error->setMsg($message);
            return $error;
        }
        $this->file_extension = $extension;

        //文件大小检测
        $file_size = $file->getSize();
        if ($file_size > $this->max_size) {
            return new ErrorMessage(2002);
        }
        $this->file_size = $file_size;

        if (!file_exists(public_path($upload_dir))) {
            mkdir(public_path($upload_dir), 0755, true);
        }

        $file_name = time() . str_random(10) . '.' . $extension;

        $file->move(public_path($upload_dir), $file_name);
        $this->file_url  = str_replace('//', '/', '/' . $upload_dir . '/' . $file_name);
        $this->file_path = public_path($upload_dir . '/' . $file_name);
    }
}
