<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */

$footerView   = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('Surveys', 'Backend', 'Surveys') ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText('Surveys', 'Backend', 'Status'); ?>
            <td class="wf-100"><?= $this->l11n->getText('Surveys', 'Backend', 'Title'); ?>
            <td><?= $this->l11n->getText('Surveys', 'Backend', 'Created'); ?>
            <td><?= $this->l11n->getText('Surveys', 'Backend', 'Creator'); ?>
        <tfoot>
        <tr>
            <td colspan="4"><?= $footerView->render(); ?>
        <tbody>
        <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
        <?php endforeach; ?>
        <?php if($count === 0) : ?>
        <tr><td colspan="4" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>