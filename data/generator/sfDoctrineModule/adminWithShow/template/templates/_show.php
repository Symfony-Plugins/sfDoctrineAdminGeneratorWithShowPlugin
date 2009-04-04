[?php include_stylesheets_for_form($form) ?]
[?php include_javascripts_for_form($form) ?]

<div class="sf_admin_form">
[?php foreach ($configuration->getFormFields($form, 'show') as $fieldset => $fields): ?]

<fieldset id="sf_fieldset_[?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?]">
  [?php if ('NONE' != $fieldset): ?]
    <h2>[?php echo __($fieldset, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</h2>
  [?php endif; ?]
  
  [?php foreach ($fields as $name => $field): ?]
    
    [?php $attributes = $field->getConfig('attributes', array()); ?]
	[?php if ($field->isPartial()): ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
    [?php elseif ($field->isComponent()): ?]
      [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
    [?php else: ?]
    <div class="sf_admin_form_row">
      <label>[?php echo $field->getConfig('label')? $field->getConfig('label'): $field->getName() ?]:</label>
	    [?php echo $form->getObject()->get($name) ? $form->getObject()->get($name) : "&nbsp;" ?]
    </div>
    [?php endif; ?]
    
  [?php endforeach; ?]
</fieldset>  

[?php endforeach; ?]
</div>
