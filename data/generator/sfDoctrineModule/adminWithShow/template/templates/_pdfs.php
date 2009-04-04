[?php foreach($<?php echo $this->getPluralName() ?> as $<?php echo $this->getSingularName()?>): ?]
  [?php include_partial('pdf',array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'display' => $display))?]
[?php endforeach; ?]
