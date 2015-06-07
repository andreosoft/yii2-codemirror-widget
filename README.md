# yii2-codemirror-widget

CodeMirror extension for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

php composer.phar require 'andreosoft/yii2-codemirror-widget'

or add

"andreosoft/yii2-codemirror-widget": "*"

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

<?php 

use andreosoft\codemirror\Codemirror; 

?>

<?= $form->field($model, 'content')->widget(Codemirror::className(), [
    'editorOptions' => [
        'lineNumbers' => true,
        'matchBrackets' => true,
        'indentUnit' => 4,
        'indentWithTabs' => true,
        'mode' => 'application/x-httpd-php',
        ], 
    'editorHeight' => 200]) ?>
