<ul>
[?php foreach ($display as $field): ?]
  <li>[?php echo $field ?]
  [?php echo $<?php echo $this->getSingularName() ?>->get($field)?]</li>
[?php endforeach; ?]
</ul>