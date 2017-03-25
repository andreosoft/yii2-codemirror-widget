<?php

namespace andreosoft\codemirror;

use yii\helpers\Json;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class Codemirror extends InputWidget {

    public $editorHeight = '800';
    public $editorOptions = [];
    private $defaultOptions = [
        'lineNumbers' => true,
        'matchBrackets' => true,
        'indentUnit' => 4,
        'indentWithTabs' => true,
        'lineWrapping' => true,
        'mode' => 'application/x-httpd-php',
        'extraKeys' => [
            'Ctrl-Space' => 'autocomplete',
            'Alt-F' => 'autoformat'],
    ];

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        CodemirrorAsset::register($this->getView());
        $this->options['id'] = $this->getId();

        $js = "
            CodeMirror.commands.autocomplete = function(cm) {
                CodeMirror.showHint(cm, CodeMirror.htmlHint);
            }
            CodeMirror.commands.autoformat = function(cm) {
                var range = { from: cm.getCursor(true), to: cm.getCursor(false) };
                cm.autoFormatRange(range.from, range.to);
            }
            CodeMirror.commands.save = function(cm) {
                $('#".$this->options['id']."').text(cm.getValue());
            }            
            ";
        $this->getView()->registerJs($js);

        $this->editorOptions = \yii\helpers\ArrayHelper::merge($this->defaultOptions, $this->editorOptions);
        $js = "var editor = CodeMirror.fromTextArea(document.getElementById(\"{$this->options['id']}\")";
//        $js .= '{ extraKeys: {"Ctrl-Space": "autocomplete"} }';
        $js .= empty($this->editorOptions) ? '' : ', ' . (Json::encode($this->editorOptions));
        $js .= ");";
        $js .= "editor.setSize(\"100%\", \"{$this->editorHeight}\");";
        $this->getView()->registerJs($js);
    }

    /**
     * @inheritdoc
     */
    public function run() {
        if ($this->hasModel()) {
            $content = Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $content = Html::textarea($this->name, $this->value, $this->options);
        }
        return $content;
    }

}
