<div class="sf_admin_filter">
  [?php if ($form->hasGlobalErrors()): ?]
    [?php echo $form->renderGlobalErrors() ?]
  [?php endif; ?]

  <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'import')) ?]" method="post" enctype="multipart/form-data">
    <table cellspacing="0">
      <tfoot>
        <tr>
          <td colspan="2">
            [?php echo $form->renderHiddenFields() ?]
            [?php echo link_to(__('Reset', array(), 'sf_admin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'import'), array('query_string' => '_reset', 'method' => 'post')) ?]
            <input type="submit" value="[?php echo __('Import', array(), 'sf_admin') ?]" />
          </td>
        </tr>
      </tfoot>
      <tbody>
        <tr>
          [?php echo $form['file']->renderRow() ?]
        </tr>
      </tbody>
    </table>
  </form>
</div>