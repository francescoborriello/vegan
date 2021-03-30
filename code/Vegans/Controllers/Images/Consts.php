<?php
/**
 *
 * @author Francesco Borriello <infoborriello@gmail.com>
 * @company Vegan Solution
 * @package Vegans
 *
 */
namespace Vegans\Controllers\Images;


class Consts{

    /**
     * @var string IMAGEPATH contains a public path of images fold
     */
    const IMAGEPATHPUB = '../public/img/images/';

    /**
     * @var string IMAGEPATHPUB contains a relative path of images fold
     */
    const IMAGEPATH = 'img/images/';

    /**
     * @var array FILETYPES contains the type allowed for upload
     */
    const FILETYPES = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

    /**
     * @var string PUBPATH contains a relative path of public fold
     */
    const PUBPATH = '../public/';

    /**
     * @var string IMAGES is a constanct for mapping results
     */
    const IMAGES = 'IMAGES';
}