<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use upload;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Description of Utils
 * use vendor https://www.verot.net/php_class_upload_samples.htm
 * enter require_once(ROOT . DS.'vendor' . DS  . 'class-upload-php-master' . DS . 'src' . DS . 'class.upload.php');
 * 
 * @author sakorn.s
 */
class UploadImageComponent extends Component {

    public $COVER_UPLOAD = 'img/uploads/';
    public $Images = null;

    public function upload($file = null, $image_x = '', $image_y = '', $path = '') {
        $handle = new upload($file);
        $data = [];
        if ($handle->uploaded) {
            $fullPath = $this->COVER_UPLOAD . $path.DS;

            $dir = new Folder(WWW_ROOT . $fullPath, true, 0755);

            $setNewFileName = time() . "_" . rand(000000, 999999);
            $handle->file_new_name_body = $setNewFileName;
            $handle->image_resize = true;
            $handle->image_ratio_crop = 'L';
            if ($image_x != '' && $image_y != '') {
                $handle->image_y = $image_y;
                $handle->image_x = $image_x;
            }

            $handle->process(WWW_ROOT . $fullPath);
            if ($handle->processed) {
                //$this->log($handle->file_dst_name,'debug');
                $image_id = $this->getSaveImage($handle, '/' . $fullPath);
                $handle->clean();
                $data = [
                    'status' => '200',
                    'image_id' => $image_id
                ];
            } else {
                $this->log($handle->error, 'debug');
                $data = [
                    'status' => '500',
                    'image_id' => null
                ];
            }

            return $data;
        }
    }

    public function uploadCover($file = null) {
        //$this->log($file,'debug');
        $handle = new upload($file);
        $data = [];
        if ($handle->uploaded) {
            $setNewFileName = 'npk-' . time() . "_" . rand(000000, 999999);
            $handle->file_new_name_body = $setNewFileName;
            $handle->image_resize = true;
            $handle->image_ratio_crop = 'L';
            $handle->image_y = 600;
            $handle->image_x = 600;
            $handle->process(WWW_ROOT . $this->COVER_UPLOAD);
            if ($handle->processed) {
                //$this->log($handle->file_dst_name,'debug');
                $image_id = $this->getSaveImage($handle, '/' . $this->COVER_UPLOAD);
                $handle->clean();
                $data = [
                    'status' => '200',
                    'image_id' => $image_id
                ];
            } else {
                $this->log($handle->error, 'debug');
                $data = [
                    'status' => '500',
                    'image_id' => null
                ];
            }

            return $data;
        }
    }

    public function uploadNormal($file = null) {
        //$this->log($file,'debug');
        $handle = new upload($file);
        $data = [];
        if ($handle->uploaded) {
            $setNewFileName = 'knowledge-image-' . time() . "_" . rand(000000, 999999);
            $handle->file_new_name_body = $setNewFileName;
            $handle->image_resize = true;
            $handle->image_ratio_pixels = 500000;
            //$handle->image_ratio_crop = 'L';
            //$handle->image_y = 200;
            //$handle->image_x = 200;
            $handle->process(WWW_ROOT . $this->COVER_UPLOAD);
            if ($handle->processed) {
                $this->log($handle->file_dst_name, 'debug');
                $image_id = $this->getSaveImage($handle, '/' . $this->COVER_UPLOAD);
                $handle->clean();
                $data = [
                    'status' => '200',
                    'image_id' => $image_id
                ];
            } else {
                $this->log($handle->error, 'debug');
                $data = [
                    'status' => '500',
                    'image_id' => null
                ];
            }

            return $data;
        }
    }

    public function uploadSlip($file = null) {
        $handle = new upload($file);
        $fullpath = $this->COVER_UPLOAD.'slips/';
        $data = [];
        if ($handle->uploaded) {
            $setNewFileName = 'slip-image-' . time() . "_" . rand(000000, 999999);
            $handle->file_new_name_body = $setNewFileName;
            $handle->image_resize = true;
            $handle->image_ratio_pixels = 500000;
            $handle->process(WWW_ROOT . $fullpath);
            if ($handle->processed) {
                $image_id = $this->getSaveImage($handle, $fullpath);
                $handle->clean();
                $data = [
                    'status' => '200',
                    'image_id' => $image_id
                ];
            } else {
                $this->log($handle->error, 'debug');
                $data = [
                    'status' => '500',
                    'image_id' => null
                ];
            }

            return $data;
        }
    }

    public function uploadBanner($file = null) {
        $handle = new upload($file);
        $image_info = getimagesize($file);
        $this->log($image_info);
        $fullpath = $this->COVER_UPLOAD.'package_banners/';
        $data = [];
        if ($handle->uploaded) {
            $setNewFileName = 'banner-package-image-' . time() . "_" . rand(000000, 999999);
            $handle->file_new_name_body = $setNewFileName;
            $handle->image_resize = true;
            $handle->image_ratio_pixels = 100000;
            $handle->image_y = 400;
            $handle->image_x = 1500;
            $handle->process(WWW_ROOT . $fullpath);
            if ($handle->processed) {
                $image_id = $this->getSaveImage($handle, $fullpath);
                $handle->clean();
                $data = [
                    'status' => '200',
                    'image_id' => $image_id
                ];
            } else {
                $this->log($handle->error, 'debug');
                $data = [
                    'status' => '500',
                    'image_id' => null
                ];
            }

            return $data;
        }
    }

    private function getSaveImage($handle = null, $path = '') {
        $this->Images = TableRegistry::get('Images');
        $image = $this->Images->newEntity();

        $image->name = $handle->file_dst_name;
        $image->type = $handle->image_src_type;
        $image->path = $path . $handle->file_dst_name;
        $image->fullpath = $handle->file_dst_pathname;
        $image->url = SITE_URL . $path . $handle->file_dst_name;
        $image->description = 'file_src_name:' . $handle->file_src_name . ', resize from:' . $handle->image_src_x . 'X' . $handle->image_src_y;
        //$image->createdby = '0';

        if ($this->Images->save($image)) {
            return $image->id;
        }
        return null;
    }

}
