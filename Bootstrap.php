<?php
namespace app\modules\friends;

use yii\base\BootstrapInterface;
/**
 * Friends module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // Add module URL rules.
        $app->urlManager->addRules(
            [
                [
                    'pattern' => '<module>/<controller>/<action>/<id:\d+>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => ''
                ]
            ],
            false
        );
        // Add module I18N category.
        if (empty(Yii::$app->i18n->translations['friends'])) {
            Yii::$app->i18n->translations['friends'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@friends/messages',//@friends = Friends->setAliases()
                'forceTranslation' => true,
            ];
        }
    }
}
