<?php

/**
 *
 * @author Francesco Borriello <infoborriello@gmail.com>
 * @company Vegan Solution
 * @package Vegans
 *
 */

namespace Vegans\Controllers\Images;

use Vg\ImagesQuery;
use VegansException\Error;
use Vegans\Controllers\Controller;

class DeleteImage extends Controller{

    /**
     *
     * execute
     *
     * This is the execute of delete images from database and public images dir
     * @param array ...$params contains the image ID to be deleted
     * @throws \Propel\Runtime\Exception\PropelException|\VegansException\Error
     */
    public function execute(...$params){

        if(!isset($params)){
            throw new Error('ERROR in path: ID is mandatory');
        }

        $id = reset($params);
        $path = $this->_deleteImage($id);
        if(strlen($path) > 0){
            $this->_removeStoredImage($path);
        }else{
            throw new Error('ERROR: image path not valid!');
        }
    }

    /**
     *
     * _deleteImage
     *
     * Find the reference image in the database and delete it
     *
     * @param $id
     * @return string
     * @throws \Propel\Runtime\Exception\PropelException
     */
    private function _deleteImage($id){

        $path = '';

        /**
         * @var $image \Vg\ImagesQuery
         */
        $image = ImagesQuery::create();

        try{
            $elem = $image->findOneById($id);
            if(is_null($elem)){

                throw new Error('ERROR: element not found in DB');
            }
            $path = $elem->getPath();
            $elem->delete();
        }catch(\PropelException $e){
            throw new Error('ERROR: ' . $e->getMessage());
        }

        return $path;
    }

    /**
     *
     * _removeStoredImage
     *
     * Find the reference image in the public directory and delete it
     *
     * @param $path
     */
    private function _removeStoredImage($path){
        if(!unlink(\Vegans\Controllers\Images\Consts::PUBPATH . $path)){
            throw new Error('ERROR during delete file');
        }
    }

}