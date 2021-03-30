<?php
/**
 *
 * @author Francesco Borriello <infoborriello@gmail.com>
 * @company Vegan Solution
 * @package Vegans
 *
 */
namespace Vegans\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller{

    /**
     * @var Environment $_twig Twig configuration and renders templates.
     */
    protected $_twig;

    /**
     * @var $_template reference template from class which extend this abstract Controller
     */
    protected $_template;

    /**
     * @var $_globalVars An array of parameters to pass to the template
     */
    protected $_globalVars;

    /**
     * @var BASE_URL a constant for getting correct base_url
     */
    const BASE_URL = 'BASE_URL';

    /**
     * Controller constructor.
     */
    public function __construct(){
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->_twig = new Environment($loader);
        $this->_globalVars[self::BASE_URL] = getenv(self::BASE_URL);
    }

    /**
     * execute
     *
     * The execute function that will be extented in controllers
     * @return mixed
     */
    abstract public function execute();

    /**
     * Function for Rendering template
     * @param array $vars
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(array $vars = []){
        $vars = array_merge($this->_globalVars, $vars);
        echo $this->_twig->render($this->_template, $vars);
    }
}