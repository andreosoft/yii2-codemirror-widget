<?php
namespace andreosoft\codemirror;

use yii\helpers\Json;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class Codemirror extends InputWidget{

    public $editorHeight = '800';
    public $editorOptions = [
        lineNumbers => true,
        matchBrackets => true,
        indentUnit => 4,
        indentWithTabs => true,
        mode => 'application/x-httpd-php',
    ];
    /**
     * @inheritdoc
     */
    public function init(){
        parent::init();
        CodemirrorAsset::register($this->getView());
        $this->options['id'] = $this->getId();
        $js  =  "var editor = CodeMirror.fromTextArea(document.getElementById(\"{$this->options['id']}\")";
        $js .=  empty($this->editorOptions) ? '' : ', '.(Json::encode($this->editorOptions));
        $js .=  ");";
        $js .=  "editor.setSize(\"100%\", {$this->editorHeight});";
        $this->getView()->registerJs($js);
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