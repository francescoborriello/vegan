<?php

/**
 *
 * @author Francesco Borriello <infoborriello@gmail.com>
 * @company Vegan Solution
 * @package Vegans
 *
 */
namespace Vegans\Controllers\Home;

use Vegans\Controllers\Controller;
use Vg\Base\ImagesQuery;

class Index extends Controller{

    /**
     * @var string DESC contains the info for order elements
     */
    const DESC = 'DESC';

    /**
     * @var string $_template contains a name of reference template
     */
    protected $_template = 'items.html.twig';

    /**
     *
     * execute
     *
     * Function used for data image management and index action rendering calls
     *
     * @return void
     *
     */
    public function execute(){

        /**
         * @var $images \Vg\Base\ImagesQuery
         */
        $images = ImagesQuery::create()->orderByCreatedAt(self::DESC);
        $vars = [];

        if($images->count() > 0){
            foreach($images as $image){
                $vars[\Vegans\Controllers\Images\Consts::IMAGES][] = [
                    'id' => $image->getId(),
                    'path' => $image->getPath(),
                    'created_at' => date('d-m-Y, h:i:s', $image->getCreatedAt())
                ];
            }
        }

        $this->render($vars);
    }
}