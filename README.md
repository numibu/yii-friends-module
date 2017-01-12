<h1>Yii2 friends module</h1>
<p> This module provide a users  functional  for add friends to your yii2 application. </p>
<h4>Installation</h4>
 - Install Yii 2 using your preferred method.
 
 - Install package via composer:
  - <p>The preferred way to install this extension is through composer.</p>
  <p>Either run:</p>
  <code>php composer.phar require --prefer-dist numibu/yii2-friends-module "*"</code>
  <p>or add</p>
  <code>"numibu/yii2-friends-module": "*"</code>
	<p>to the require section of your composer.json file.</p>

- Update Configuration file.
- Apply migration.

<h4>Configuration</h4>
<p>Add yii2-users-module to module section of each application config:</p>
```php
'modules' => [
	'friends' => [
		'class' => 'numibu\friends\Module'	
		]
	]
```
<h4>Run migration file</h4>
```php 
php yii migrate --migrationPath=@vendor/numibu/yii2-friends-module/migrations
```
In the presentation file adding line:
```php 
var_dump( \Yii::$app->getModule('friends') );
```
or add a link to the module in 'view/index.php'
```php
echo \yii\helpers\Html::a( 'FriendsModuleLink', yii\helpers\Url::toRoute( 'friends/default' ));
```
The application must have a "User" class (or similar), as well as having multiple users to check the operation of the module.
Go to your application in your browser:
	```http://localhost/pathtoapp/web/friends/index```
	
**Usage:**
<p>Set a line </p>
```php 
echo FriendsList::widget();
``` 
<p>in your view file:</p>
![Image of Module](https://cloud.githubusercontent.com/assets/13916692/21888744/42be8382-d8ce-11e6-92ab-b6b8fe0e2be0.png)


**License**
Friends.Module is published under the Apache 2.0 license.

