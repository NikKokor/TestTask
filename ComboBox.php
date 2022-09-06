<?php

class Option
{
    private $value = "";
    private $text = "";

    function __construct($value, $text) {
        $this->value = $value;
        $this->text = $text;
    }

    function getValue() {
        return $this->value;
    }

    function getText() {
        return $this->text;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function setText($text) {
        $this->text = $text;
    }
}

class Optgroup
{
    private $options = array();
    private $label = "";

    function __construct($label) {
        $this->label = $label;
    }

    function addOption(Option $option) {
        array_push($this->options, [$option->getValue(), $option->getText()]);
    }

    function getOptions() {
        return $this->options;
    }

    function getLabel() {
        return $this->label;
    }
}

class ComboBox
{
    private $atributs = "";
    private $body = "";

    function addAtrib($atrib) {
        $this->atributs = $this->atributs . $atrib;
    }

    function addOption(Option $options){
        $this->body = $this->body . '<option value="' . $options->getValue() . '">' . $options->getText() . '</option>';
    }

    public function addOptgroup(Optgroup $optgroup){
        $opt = '<optgroup label="' . $optgroup->getLabel() . '">';
        $options = $optgroup->getOptions();
        for ($i = 0; $i < count($options); $i++)
        {
            $opt = $opt . '<option value="' . $options[$i][0] . '">' . $options[$i][1] . '</option>';
        }
        $opt = $opt . "</optgroup>";
        $this->body = $this->body . $opt;
    }

    function __toString() {
        return "<select $this->atributs>$this->body</select>";
    }
}

//example

$combobox = new ComboBox();
$combobox->addAtrib('name = "combo"');

$opt = new Option("text1", "test1");
$opt->setText("text11");
$opt1 = new Option("text2", "test2");
$opt2 = new Option("text3", "test3");

$combobox->addOption($opt);
$combobox->addOption($opt1);

$optG = new Optgroup("group1");
$optG->addOption($opt1);
$optG->addOption($opt);
$optG->addOption($opt2);
$combobox->addOptgroup($optG);

$combobox->addOption($opt2);
echo $combobox;