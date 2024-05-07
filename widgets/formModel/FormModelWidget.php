<?php
  namespace app\widgets\formModel;
  use yii\base\Widget;

// Widget
class FormModelWidget extends Widget
{
  // Parameters Widget
  public $text;             // Text
  public $type;             // Text

  // Init Widget
  public function init() {
    parent::init();
  }

  // Run Widget
  public function run() {
    parent::run();
    return $this->render('template', [
      'type'             => $this->type,
      'text'             => $this->text,
    ]);
  }
}