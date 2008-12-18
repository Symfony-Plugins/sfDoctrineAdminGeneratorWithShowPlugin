<table>
  <tbody>
[?php foreach ($configuration->getFormFields($form, 'show') as $fieldset => $fields): ?]
  [?php foreach ($fields as $name => $field): ?]
  <tr>
    [?php $attributes = $field->getConfig('attributes', array()); ?]
	[?php if ($field->isPartial()): ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
    [?php elseif ($field->isComponent()): ?]
      [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
    [?php else: ?]
       <th>[?php echo $field->getConfig('label') ?]:</th>
	   <td>[?php echo $form->getObject()->get($name) ?]</td>
    [?php endif; ?]
  </tr>
  [?php endforeach; ?]
[?php endforeach; ?]
  </tbody>
</table>
