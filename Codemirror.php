<?php
namespace andreosoft\codemirror;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class Codemirror extends InputWidget{

    public $editorHeight = '800';
    public $editorOptions = [
        'lineNumbers' => true,
        'matchBrackets' => true,
        'indentUnit' => 4,
        'indentWithTabs' => true,
        'extraKeys' => ['Ctrl-Space' => 'autocomplete'],
        'mode' => 'application/x-httpd-php',
        'viewportMargin' => 'Infinity'
    ];
    /**
     * @inheritdoc
     */
    public function init(){
        parent::init();
        CodemirrorAsset::register($this->getView());
        $this->options['id'] = $this->getId();
        $this->getView()->registerJs(
        "var editor = CodeMirror.fromTextArea(document.getElementById(\"{$this->options['id']}\"), {".
            empty($this->editorOptions) ? '' : (Json::encode($this->editorOptions)).          
        "});".
        "editor.setSize(\"100%\", {$editorHeight});"        
         );
    }
    /**
     * @inheritdoc
     */
    public function run(){
        if ($this->hasModel()) {
            $content = Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $content = Html::textarea($this->name, $this->value, $this->options);
        }
        return $content;
    }
}