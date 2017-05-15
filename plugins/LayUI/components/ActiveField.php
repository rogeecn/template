<?php

namespace plugins\LayUI\components;

use yii\helpers\ArrayHelper;

/**
 * A Bootstrap 3 enhanced version of [[\yii\widgets\ActiveField]].
 *
 * This class adds some useful features to [[\yii\widgets\ActiveField|ActiveField]] to render all
 * sorts of Bootstrap 3 form fields in different form layouts:
 *
 * - [[inputTemplate]] is an optional template to render complex inputs, for example input groups
 * - [[horizontalCssClasses]] defines the CSS grid classes to add to label, wrapper, error and hint
 *   in horizontal forms
 * - [[inline]]/[[inline()]] is used to render inline [[checkboxList()]] and [[radioList()]]
 * - [[enableError]] can be set to `false` to disable to the error
 * - [[enableLabel]] can be set to `false` to disable to the label
 * - [[label()]] can be used with a `boolean` argument to enable/disable the label
 *
 * There are also some new placeholders that you can use in the [[template]] configuration:
 *
 * - `{beginLabel}`: the opening label tag
 * - `{labelTitle}`: the label title for use with `{beginLabel}`/`{endLabel}`
 * - `{endLabel}`: the closing label tag
 * - `{beginWrapper}`: the opening wrapper tag
 * - `{endWrapper}`: the closing wrapper tag
 *
 * The wrapper tag is only used for some layouts and form elements.
 *
 * Note that some elements use slightly different defaults for [[template]] and other options.
 * You may want to override those predefined templates for checkboxes, radio buttons, checkboxLists
 * and radioLists in the [[\yii\widgets\ActiveForm::fieldConfig|fieldConfig]] of the
 * [[\yii\widgets\ActiveForm]]:
 *
 * - [[checkboxTemplate]] the template for checkboxes in default layout
 * - [[radioTemplate]] the template for radio buttons in default layout
 * - [[horizontalCheckboxTemplate]] the template for checkboxes in horizontal layout
 * - [[horizontalRadioTemplate]] the template for radio buttons in horizontal layout
 * - [[inlineCheckboxListTemplate]] the template for inline checkboxLists
 * - [[inlineRadioListTemplate]] the template for inline radioLists
 *
 * Example:
 *
 * ```php
 * use yii\bootstrap\ActiveForm;
 *
 * $form = ActiveForm::begin(['layout' => 'horizontal']);
 *
 * // Form field without label
 * echo $form->field($model, 'demo', [
 *     'inputOptions' => [
 *         'placeholder' => $model->getAttributeLabel('demo'),
 *     ],
 * ])->label(false);
 *
 * // Inline radio list
 * echo $form->field($model, 'demo')->inline()->radioList($items);
 *
 * // Control sizing in horizontal mode
 * echo $form->field($model, 'demo', [
 *     'horizontalCssClasses' => [
 *         'wrapper' => 'col-sm-2',
 *     ]
 * ]);
 *
 * // With 'default' layout you would use 'template' to size a specific field:
 * echo $form->field($model, 'demo', [
 *     'template' => '{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div>'
 * ]);
 *
 * // Input group
 * echo $form->field($model, 'demo', [
 *     'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
 * ]);
 *
 * ActiveForm::end();
 * ```
 *
 * @see \yii\bootstrap\ActiveForm
 * @see http://getbootstrap.com/css/#forms
 *
 * @author Michael Härtl <haertl.mike@gmail.com>
 * @since 2.0
 */
class ActiveField extends \yii\widgets\ActiveField
{
    public $options = ['class' => 'layui-form-item'];

    public $inputOptions = ['class' => 'layui-input'];
    /**
     * @var array the default options for the label tags. The parameter passed to [[label()]] will be
     * merged with this property when rendering the label tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $labelOptions = ['class' => 'layui-form-label'];
    /**
     * @var boolean whether to render [[checkboxList()]] and [[radioList()]] inline.
     */
    public $inlineInputWrapperOption = ['class' => "layui-input-inline"];
    public $blockInputWrapperOption  = ['class' => "layui-input-block"];
    /**
     * @var string|null optional template to render the `{input}` placeholder content
     */
    public $inputTemplate;
//    /**
//     * @var array options for the wrapper tag, used in the `{beginWrapper}` placeholder
//     */
    public $wrapperOptions = [];
//    /**
//     * @var null|array CSS grid classes for horizontal layout. This must be an array with these keys:
//     *  - 'offset' the offset grid class to append to the wrapper if no label is rendered
//     *  - 'label' the label grid class
//     *  - 'wrapper' the wrapper grid class
//     *  - 'error' the error grid class
//     *  - 'hint' the hint grid class
//     */
//    public $horizontalCssClasses;
//    /**
//     * @var string the template for checkboxes in default layout
//     */
//    public $checkboxTemplate = "<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>";
//    /**
//     * @var string the template for radios in default layout
//     */
//    public $radioTemplate = "<div class=\"radio\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>";
//    /**
//     * @var string the template for checkboxes in horizontal layout
//     */
//    public $horizontalCheckboxTemplate = "{beginWrapper}\n<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}";
//    /**
//     * @var string the template for radio buttons in horizontal layout
//     */
//    public $horizontalRadioTemplate = "{beginWrapper}\n<div class=\"radio\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}";
//    /**
//     * @var string the template for inline checkboxLists
//     */
//    public $inlineCheckboxListTemplate = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";
//    /**
//     * @var string the template for inline radioLists
//     */
//    public $inlineRadioListTemplate = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";
    /**
     * @var boolean whether to render the error. Default is `true` except for layout `inline`.
     */
    public $enableError = true;
    /**
     * @var boolean whether to render the label. Default is `true`.
     */
    public $enableLabel = true;


    /**
     * @inheritdoc
     */
    public function __construct($config = []) {
        $layoutConfig = $this->createLayoutConfig($config);
        $config       = ArrayHelper::merge($layoutConfig, $config);
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function render($content = null) {
        /*if ($content === null) {
            if (!isset($this->parts['{beginWrapper}'])) {
                $options = $this->wrapperOptions;
                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $this->parts['{beginWrapper}'] = Html::beginTag($tag, $options);
                $this->parts['{endWrapper}'] = Html::endTag($tag);
            }
            if ($this->enableLabel === false) {
                $this->parts['{label}'] = '';
                $this->parts['{beginLabel}'] = '';
                $this->parts['{labelTitle}'] = '';
                $this->parts['{endLabel}'] = '';
            } elseif (!isset($this->parts['{beginLabel}'])) {
                $this->renderLabelParts();
            }
            if ($this->enableError === false) {
                $this->parts['{error}'] = '';
            }
            if ($this->inputTemplate) {
                $input = isset($this->parts['{input}']) ?
                    $this->parts['{input}'] : Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
                $this->parts['{input}'] = strtr($this->inputTemplate, ['{input}' => $input]);
            }
        }*/
        return parent::render($content);
    }

    public function editor($options = []) {
        $this->label(false);
        $this->parts['{input}'] = Html::activeEditor($this->model, $this->attribute, $options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], ['style' => 'margin-right: 5px']);

        return $this;
    }

    public function hiddenInput($options = []) {
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeHiddenInput($this->model, $this->attribute, $options);
        $this->options          = [];

        return $this;
    }

    public function textInput($options = []) {
        parent::textInput($options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], $this->inlineInputWrapperOption);
        return $this;
    }

    public function textarea($options = []) {
        Html::addCssClass($options, ['layui-textarea']);
        parent::textarea($options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], $this->inlineInputWrapperOption);
        return $this;
    }

    public function checkbox($options = [], $enclosedByLabel = true) {
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);

        $options['lay-skin']    = "primary";
        $this->parts['{input}'] = Html::activeCheckbox($this->model, $this->attribute, $options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], $this->inlineInputWrapperOption);

        return $this;
    }

    public function radio($options = [], $enclosedByLabel = true) {
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeRadio($this->model, $this->attribute, $options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], $this->inlineInputWrapperOption);

        return $this;
    }


    public function checkboxList($items, $options = []) {
        parent::checkboxList($items, $options);
        $this->parts['{input}'] = Html::activeCheckboxList($this->model, $this->attribute, $items, $options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], $this->inlineInputWrapperOption);
        return $this;
    }

    public function dropDownList($items, $options = []) {
        parent::dropDownList($items, $options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], $this->inlineInputWrapperOption);

        return $this;
    }

    public function radioList($items, $options = []) {
        parent::radioList($items, $options);
        $this->parts['{input}'] = Html::activeRadioList($this->model, $this->attribute, $items, $options);
        $this->parts['{input}'] = Html::tag("div", $this->parts['{input}'], $this->inlineInputWrapperOption);
        return $this;
    }

    public function label($label = null, $options = []) {
        if (is_bool($label)) {
            $this->enableLabel = $label;
            if ($label === false) {
                $this->parts['{label}'] = "";
                return $this;
            }
        }

        $this->enableLabel = true;
        $this->renderLabelParts($label, $options);
        parent::label($label, $options);
        return $this;
    }


    protected function createLayoutConfig($instanceConfig) {
        $config = [
            'hintOptions'  => [
                'tag'   => 'div',
                'class' => 'layui-form-mid layui-word-aux',
            ],
            'errorOptions' => [
                'tag'   => 'div',
                'class' => 'layui-form-mid layui-word-aux',
            ],
            'inputOptions' => $this->inputOptions,
        ];

        $layout = $instanceConfig['form']->layout;

        if ($layout === 'horizontal') {
            $config['template'] = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";
            $cssClasses         = [
                'offset'  => 'col-sm-offset-3',
                'label'   => 'col-sm-3',
                'wrapper' => 'col-sm-6',
                'error'   => '',
                'hint'    => 'col-sm-3',
            ];
            if (isset($instanceConfig['horizontalCssClasses'])) {
                $cssClasses = ArrayHelper::merge($cssClasses, $instanceConfig['horizontalCssClasses']);
            }
            $config['horizontalCssClasses'] = $cssClasses;
            $config['wrapperOptions']       = ['class' => $cssClasses['wrapper']];
            $config['labelOptions']         = ['class' => 'control-label ' . $cssClasses['label']];
            $config['errorOptions']         = ['class' => 'help-block help-block-error ' . $cssClasses['error']];
            $config['hintOptions']          = ['class' => 'help-block ' . $cssClasses['hint']];
        } elseif ($layout === 'inline') {
            $config['labelOptions'] = ['class' => 'sr-only'];
            $config['enableError']  = false;
        }

        return $config;
    }

    /**
     * @param string|null $label the label or null to use model label
     * @param array       $options the tag options
     */
    protected function renderLabelParts($label = null, $options = []) {
        $options = array_merge($this->labelOptions, $options);
        if ($label === null) {
            if (isset($options['label'])) {
                $label = $options['label'];
                unset($options['label']);
            } else {
                $attribute = Html::getAttributeName($this->attribute);
                $label     = Html::encode($this->model->getAttributeLabel($attribute));
            }
        }
        if (!isset($options['for'])) {
            $options['for'] = Html::getInputId($this->model, $this->attribute);
        }
        $this->parts['{beginLabel}'] = Html::beginTag('label', $options);
        $this->parts['{endLabel}']   = Html::endTag('label');
        if (!isset($this->parts['{labelTitle}'])) {
            $this->parts['{labelTitle}'] = $label;
        }
    }

}