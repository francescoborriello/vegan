<?php

/**
 *
 * @author Francesco Borriello <infoborriello@gmail.com>
 * @company Vegan Solution
 * @package Vegans
 *
 */
namespace Vegans\Controllers\Images;

use Propel\Runtime\Exception\PropelException;
use Vegans\Controllers\Controller;
use Vg\Images;
use VegansException\Error;

class AddImages extends Controller{

    /**
     *
     * execute
     *
     * This is the execute of add images which takes care of creating a directory for storing
     * the images and saving the data information in the database.
     *
     * @return void
     */
    public function execute(){

        if(!(in_array($_FILES['file']['type'], \Vegans\Controllers\Images\Consts::FILETYPES))){
            throw new Error('ERROR during passing parameters');
        }

        $time = strtotime("now");
        $fileName = $this->_storeImages($_FILES,$time);

        if(strlen($fileName) > 0){
            $vars = [
                'filename' => $fileName,
                'path' => \Vegans\Controllers\Images\Consts::IMAGEPATH . $fileName,
                'created_at' => $time
            ];

            $id = $this->_saveData($vars);
        }

        echo json_encode(array_merge(['id' => $id], $vars));
    }

    /**
     *
     * _saveData
     *
     * Function used for save Imgs information in database
     * @param array $vars contains the imgs information to save
     * @return int
     *
     */
    private function _saveData($vars){

        /**
         * @var $images \Vg\Images
         */
        $images = new Images();

        try{
            $images->setName($vars['filename'])
                ->setPath($vars['path'])
                ->setCreatedAt($vars['created_at'])
                ->save();
            return $images->getId();

        }catch(\PropelException $e){
            throw new Error('ERROR: '. $e->getMessage());
        }
    }

    /**
     * _storeImages
     *
     * Function dedicated to saving files in the images directories
     * the file name will consist of the current datetime and original name of the images
     *
     * @param $file
     * @param $time
     * @return string
     * @exception \VegansException\Error
     *
     */
    private function _storeImages($file, $time){

        if(!file_exists(\Vegans\Controllers\Images\Consts::IMAGEPATH)){
            mkdir(\Vegans\Controllers\Images\Consts::IMAGEPATH, 0755);
        }

        $fileName = $time . '_' . $file['file']['name'];
        if(move_uploaded_file($file['file']['tmp_name'], \Vegans\Controllers\Images\Consts::IMAGEPATH . $fileName)){
            return $fileName;
        }else{
            throw new Error('ERROR during store file');
        }

    }
}