<?php

/**
 * Nette Forms & Bootstap v4 rendering example.
 */


if (@!include __DIR__ . '/../vendor/autoload.php') {
	die('Install packages using `composer install`');
}

use Nette\Forms\Form;
use Tracy\Debugger;
use Tracy\Dumper;

Debugger::enable();


function makeBootstrap4(Form $form)
{
	$renderer = $form->getRenderer();
	$renderer->wrappers['controls']['container'] = NULL;
	$renderer->wrappers['pair']['container'] = 'div class="form-group row"';
	$renderer->wrappers['pair']['.error'] = 'has-danger';
	$renderer->wrappers['control']['container'] = 'div class=col-sm-9';
	$renderer->wrappers['label']['container'] = 'div class="col-sm-3 col-form-label"';
	$renderer->wrappers['control']['description'] = 'span class=form-text';
	$renderer->wrappers['control']['errorcontainer'] = 'span class=form-control-feedback';

	$form->onRender[] = function ($form) {
		foreach ($form->getControls() as $control) {
			$type = $control->getOption('type');
			if ($type === 'button') {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-secondary');
				$usedPrimary = TRUE;

			} elseif (in_array($type, ['text', 'textarea', 'select'], TRUE)) {
				$control->getControlPrototype()->addClass('form-control');

			} elseif ($type === 'file') {
				$control->getControlPrototype()->addClass('form-control-file');

			} elseif (in_array($type, ['checkbox', 'radio'], TRUE)) {
				if ($control instanceof Nette\Forms\Controls\Checkbox) {
					$control->getLabelPrototype()->addClass('form-check-label');
				} else {
					$control->getItemLabelPrototype()->addClass('form-check-label');
				}
				$control->getControlPrototype()->addClass('form-check-input');
				$control->getSeparatorPrototype()->setName('div')->addClass('form-check');
			}
		}
	};
}


$form = new Form;
makeBootstrap4($form);

$form->addGroup('Personal data');
$form->addText('name', 'Your name')
	->setRequired('Enter your name');

$form->addRadioList('gender', 'Your gender', [
	'male', 'female',
]);

$form->addCheckboxList('colors', 'Favorite colors', [
	'red', 'green', 'blue',
]);

$form->addSelect('country', 'Country', [
	'Buranda', 'Qumran', 'Saint Georges Island',
]);

$form->addCheckbox('send', 'Ship to address');

$form->addGroup('Your account');
$form->addPassword('password', 'Choose password');
$form->addUpload('avatar', 'Picture');
$form->addTextArea('note', 'Comment');

$form->addGroup();
$form->addSubmit('submit', 'Send');
$form->addSubmit('cancel', 'Cancel');


if ($form->isSuccess()) {
	echo '<h2>Form was submitted and successfully validated</h2>';
	Dumper::dump($form->getValues());
	exit;
}


?>
<!DOCTYPE html>
<meta charset="utf-8">
<title>Nette Forms & Bootstrap v4 rendering example</title>

<link rel="stylesheet" href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css">

<div class="container">
	<h1>Nette Forms & Bootstrap v4 rendering example</h1>

	<?php echo $form ?>
</div>
