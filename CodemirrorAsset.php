<?php

namespace andreosoft\codemirror;

use yii\web\AssetBundle;

class CodemirrorAsset extends AssetBundle{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/codemirror';
    /**
     * @inheritdoc
     */
    public $js = [
        'lib/codemirror.js',
        'addon/edit/matchbrackets.js',
        'mode/htmlmixed/htmlmixed.js',
        'mode/xml/xml.js',
        'mode/javascript/javascript.js',
        'mode/css/css.js',
        'mode/clike/clike.js',
        'mode/php/php.js',

        
    ];
    public $css = [
        'lib/codemirror.css',
    ];
} 