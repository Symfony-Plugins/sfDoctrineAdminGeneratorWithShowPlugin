<table>
  <tbody>
<?php foreach ($this->configuration->getValue('show.display') as $name => $field): ?>
    <tr>
       <th><?php echo $field->getConfig('name', sfInflector::humanize(sfInflector::underscore($name))) ?>:</th>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
<td class="sf_admin_%s sf_admin_list_th_%s">
  [?php echo %s ?]
</td>

EOF
, strtolower($field->getType()), $name, $this->renderField($field)), $field->getConfig()) ?>
<?php endforeach; ?>
    </tr>
  </tbody>
</table>
