<?php namespace app\modules\friends;

use Yii;

/**
 * friends module definition class
 */
class Friends extends \yii\base\Module
{
    /**
     * @var string Module version
     */
    protected $version = "1.0";
    
    /**
     * @var string Alias for module
     */
    public $alias = "@friends";
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\friends\controllers';
    
    /**
     * Get module version
     * @return String
     */
    public  function getVersion()
    {
        return $this->version;
    }
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        
        
        // set up i8n
        if (empty(Yii::$app->i18n->translations['friends'])) {
            Yii::$app->i18n->translations['friends'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
        
        // set alias
        $this->setAliases([
            $this->alias => __DIR__,
        ]);
        
        // get class name for error messages
        $className = get_called_class();
        
        $userComponent = Yii::$app->get('user', false);
        
        if ( !$userComponent ) {
            throw new InvalidConfigException( $className . ': Yii::$app->user is not set.' );
        }
    }
    
    /*public function createController($route)
    {
        // check valid routes
        $validRoutes  = [$this->defaultRoute, "admin", "copy", "auth"];
        $isValidRoute = false;
        
        foreach ($validRoutes as $validRoute) {
            if (strpos($route, $validRoute) === 0) {
                $isValidRoute = true;
                break;
            }
        }
        
        return ( empty($route) or $isValidRoute )
            ? parent::createController($route)
            : parent::createController("{$this->defaultRoute}/{$route}");
         
    }*/
}
